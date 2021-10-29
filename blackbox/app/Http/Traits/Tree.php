<?php

namespace App\Http\Traits;

use App\Models\User;

trait Tree{

    /**
     * Permite obtener el arbol del hacia arriba en los referidos
     *
     * @param User $user
     * @param integer $nivel
     * @return boolean
     */
    public function getDataFather(User $user, $nivel)
    {
        $usuarios = collect();

        for ($i=0; $i < $nivel; $i++) { 
            if($user->referred_by != null){
                $user = User::where('id', $user->referred_by)->first();
                
                if(isset($user)){
            
                    $user->nivel = $i + 1;
                    $usuarios->push($user);
                }   
            }
        }

        return $usuarios;
    }
}