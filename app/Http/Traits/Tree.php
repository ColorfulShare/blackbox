<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
            if($user->referred_id != null){
                $user = User::where('id', $user->referred_id)->first();
                
                if(isset($user)){
            
                    $user->nivel = $i + 1;
                    $usuarios->push($user);
                }   
            }
        }

        return $usuarios;
    }

    public function getChildrens(User $user, Collection $usuarios , $nivel = 1)
    {       
        if(count($user->referidos) > 0){
            foreach($user->referidos as $referido){
                
                $referido->nivel = $nivel;
                
                $usuarios->push($referido);

                $this->getChildrens($referido, $usuarios, $nivel + 1);
            }
        }

        return $usuarios;
    }
}