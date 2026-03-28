<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votess extends Model
{
    protected $table = 'votess';

    protected $fillable = [
        'candidate_name',
        'nbrVotesUnitaires',
        'firstname',
        'lastname',
        'email',
    ];
}
