<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Tree;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TreController extends Controller
{
    use Tree;

    public function index()
    {
        try {
            $base = Auth::user();
            $trees = $this->getDataEstructura(Auth::id());
            //dd($trees);
            $base->logoarbol = asset('img/tree/tree.svg');
            return view('genealogy.tree', compact('trees', 'base'));
        } catch (\Throwable $th) {
            Log::error('Tree - index -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function buscar()
    {
        return view('genealogy.buscar');
    }

    public function search(Request $request)
    {
        try {
            // titulo
            $trees = $this->getDataEstructura($request->id);
            //$type = ucfirst($type);
            $base = User::find($request->id);
            $base->logoarbol = asset('assets/img/sistema/favicon.png');
           

            return view('genealogy.tree', compact('trees', 'base'));
        } catch (\Throwable $th) {
            Log::error('Tree - moretree -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function moretree($id)
    {
        try {
            // titulo
            $id = base64_decode($id);
            $trees = $this->getDataEstructura($id);
            //$type = ucfirst($type);
            $base = User::find($id);
            $base->logoarbol = asset('assets/img/sistema/favicon.png');
           
            $type_tm = 0;

            return view('genealogy.tree', compact('trees', 'base'));
        } catch (\Throwable $th) {
            Log::error('Tree - moretree -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    private function getDataEstructura($id)
    {
        try {
            
            $childres = $this->getData($id, 1);
            $trees = $this->getChildren($childres, 2);
            return $trees;
        } catch (\Throwable $th) {
            Log::error('Tree - getDataEstructura -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function getChildren($users, $nivel)
    {
        try {
            if (!empty($users)) {
                foreach ($users as $user) {
                    $user->children = $this->getData($user->id, $nivel);
                    $this->getChildren($user->children, ($nivel+1));
                }
                return $users;
            }else{
                return $users;
            }
        } catch (\Throwable $th) {
            Log::error('Tree - getChildren -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Se trare la informacion de los hijos 
     *
     * @param integer $id - id a buscar hijos
     * @param integer $nivel - nivel en que los hijos se encuentra
     * @param string $typeTree - tipo de arbol a usar
     * @return object
     */
    private function getData($id, $nivel)
    {
        try {
            $resul = User::where('referred_by', $id)->get();
            foreach ($resul as $user) {
                $user->nivel = $nivel;
                $user->logoarbol = asset('assets/img/sistema/favicon.png');
            }
            return $resul;
        } catch (\Throwable $th) {
            Log::error('Tree - getData -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
