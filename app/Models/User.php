<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden=['mdp'];//Le champs mdp n’est pas accessible dans le modèle User
    protected $fillable=['nom','prenom','login','mdp'];//On peut utiliser un constructeur simplifié indiquant ces champs
    protected $attributes=['type'=>'user'];//La valeur par défaut du champ type

    public function getAuthPassword(){//Indication du champ contenant le mdp
        return $this->mdp;
    }

    public function isAdmin(){
        return $this->type=='admin';
    }

    public function isCook(){
        return $this->type=='cook';
    }

    function commandes(){
        return $this->hasMany(Commande::class);
    }

}
