<?php

namespace App\Policies;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommandePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    public function view(User $user,Commande $commande){
        return $user->id==$commande->user_id;
    }

    public function create(User $user){
        return true;
    }

    public function update(User $user,Commande $commande){
        return $user->id==$commande->user_id;
    }

    public function delete(User $user,Commande $commande){
        return $user->isAdmin() || $user->id==$commande->user_id;
    }
}
