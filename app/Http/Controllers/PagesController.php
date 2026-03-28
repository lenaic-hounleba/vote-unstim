<?php

namespace App\Http\Controllers;
use FedaPay;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Candidate;
use App\Models\Votess;

class PagesController extends Controller
{
    //

    // Propriété pour stocker le montant
    private $montant;
    private $nomCandidate;
    private $nombreVotes;

    public function __construct()
    {
        FedaPay\FedaPay::setApiKey(config('fedapay.secret_key'));
        FedaPay\FedaPay::setEnvironment(config('fedapay.environment'));
    }

    public function index(){
        $candidates = DB::table('candidates')
            ->get();
        return view('index')->with('candidates', $candidates);
    }

    public function sample(){
        return view('sample');
    }

    public function new(){
        $candidates = DB::table('candidates')
        ->orderBy('nbrVotes', 'desc')
        ->paginate('10');
        return view('new')->with('candidates', $candidates);
    }

    public function vote($name, $id){
        $candidate = Candidate::where(['name' => $name, 'id' => $id])->first();
        return view('vote')->with('candidate', $candidate);
    }

    public function process(Request $request)
    {
        // try {
            $this->nomCandidate = $request->input('nom_candidate');
            session(['nom_candidate' => $this->nomCandidate]);
            
            $this->nbrVotes = $request->input('nombre_votes');
            session(['nombre_votes' => $this->nbrVotes]);

            // Récupérer le montant depuis la requête HTTP et l'assigner à la propriété de classe
            $this->montant = $request->input('montant');

            $transaction = FedaPay\Transaction::create(
                $this->fedapayTransactionData()
            );
            // dd($transaction); ajout dans la table
            $token = $transaction->generateToken(); 

            return redirect()->away($token->url);
        // } catch(\Exception $e) {
        //     return back()->with('error', $e->getMessage());
        // }
    }

    private function fedapayTransactionData()
    {
        

        return [
            'description' => $this->nbrVotes.' Votes MISS SCIENTIFIQUE UNSTIM pour '.$this->nomCandidate,
            'amount' => $this->montant,
            'currency' => ['iso' => 'XOF'],
            'callback_url' => url('callback'),
            // 'customer' => $customer_data
        ];
    }

    public function callback(Request $request) {

            try {
                // dd($request);
                // Récupérer le nom de la candidate depuis la session
                $candidateName = session('nom_candidate');

                // Récupérer la candidate depuis la base de données
                $candidate = Candidate::where('name', $candidateName)->lockForUpdate()->first();

                // Récupérer le nombre de votes la session
                $nombreVotes = session('nombre_votes');

                if (!$candidate) {
                    throw new \Exception("La candidate '$candidateName' n'existe pas.");
                }

                // Récupérer l'identifiant de la transaction depuis la requête
                $transactionId = $request->input('id');

                // Récupérer le statut de la transaction depuis FedaPay
                $transaction = FedaPay\Transaction::retrieve($transactionId); 
                
                $customerInfo = $transaction->metadata->paid_customer;
                dd($transaction);

                $vote = new Votess();
                $vote->candidate_name = $candidateName; // Remplacez $candidateId par l'identifiant du candidat approprié
                $vote->nbrVotesUnitaires = $nombreVotes; // Remplacez $nombreVotes par le nombre de votes approprié
                $vote->firstname = $customerInfo->firstname;
                $vote->lastname = $customerInfo->lastname;
                $vote->email = $customerInfo->email;

                switch($transaction->status) {
                    case 'approved':
                        $message = "Transaction approuvée. Vous avez voté avec succès pour $candidateName.";
                        $candidate->increment('nbrVotes', $nombreVotes);
                        break;
                    case 'canceled':
                        $message = 'Transaction annulée.';
                        break;
                    case 'declined':
                        $message = 'Transaction déclinée.';
                        break;
                    default:
                        $message = 'Statut de transaction inconnu.';
                }

                $vote->save();  

                $candidates = DB::table('candidates')
                ->get();
                return view('index', [
                    'candidates' => $candidates,
                    'message' => $message,
                ]);

            } catch(\Exception $e) {

                // En cas d'erreur, afficher un message d'erreur
                $message = $e->getMessage();
                $candidates = DB::table('candidates')
                ->get();
                return view('index', [
                    'candidates' => $candidates,
                    'message' => $message,
                ]);

            }
        }

        public function admin(){
            $candidates = DB::table('candidates')
                ->get();
            return view('admin')->with('candidates', $candidates);
        }
    
        public function increment(Request $request, $id) {
                // Démarrez une transaction
            DB::beginTransaction();
    
            try {
                // Sélectionnez le candidat correspondant à l'ID avec le verrouillage de ligne pour la mise à jour
                $candidate = Candidate::where('id', $id)->lockForUpdate()->first();
    
                // Vérifiez si le candidat existe
                if (!$candidate) {
                    throw new \Exception("Le candidat n'existe pas.");
                }
    
                // Récupérer le nombre de votes à ajouter depuis la requête HTTP
                $nombreVotes = intval($request->input('nombreVotes'));
    
                $candidate->increment('nbrVotes', $nombreVotes);
    
                // Valider la transaction
                DB::commit();
    
                $vote = new Votess();
                
                $vote->candidate_name = $candidate->name; // Remplacez $candidateId par l'identifiant du candidat approprié
                $vote->nbrVotesUnitaires = $nombreVotes; // Remplacez $nombreVotes par le nombre de votes approprié
                $vote->firstname = 'admin';
                $vote->lastname = 'admin';
                $vote->email = 'admin';
    
                $vote->save(); 
    
                // Rediriger l'utilisateur vers la page précédente avec un message de succès
                return redirect()->back()->with('success', $nombreVotes.' votes ont été incrémentés avec succès pour '.$candidate->name.'.');
            } catch (\Exception $e) {
                // En cas d'erreur, annulez la transaction
                DB::rollBack();
    
                // Rediriger l'utilisateur vers la page précédente avec un message d'erreur
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
}
