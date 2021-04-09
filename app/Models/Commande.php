<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use HasFactory;


    protected $attributes=['statut'=>'envoye'];//La valeur par défaut du champ type

    function user(){
        return $this->belongsTo(User::class);
    }

    function pizzas(){
        return $this->belongsToMany(Pizza::class);
    }
}
