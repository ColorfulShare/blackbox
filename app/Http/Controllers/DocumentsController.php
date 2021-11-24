<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

use App\Models\Documents;

class DocumentsController extends Controller
{
    /**
     * Vista de la lista de registros
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {

            $documents = Documents::all();

            return view('admin.interest.documents.list', compact('documents'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController-list -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Vista para crear un registro
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            $count = DB::table('documents')->orderby('created_at', 'desc')->first();

            return view('admin.interest.documents.create', compact('count'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController - create -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Crea un nuevo registro
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {

            //  guarda el archivo
                $file = $request->file;
                $filen = $request->type;
                $name = $request->name.'.'.$filen;
                $file->move(public_path('storage') . '/documents', $name);
            
                // crea el registro
            $documents = Documents::create([
                'name' => $request->name,
                'file' => $name,
                'type' => $request->type,
            ]);
            $documents->save();

        return redirect()->route('documents.list')->with('success', 'La noticia se creo Exitosamente');
            
        // } catch (\Throwable $th) {
        //     Log::error('DocumentsController - store -> Error: '.$th);
        //     abort(403, "Ocurrio un error, contacte con el administrador");
        // }
    }

    /**
     * Ver un registro en especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {

            $documents = Documents::all();

            return view('admin.interest.documents.show', compact('documents'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController-show -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Ver un pdf en especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        try {

            $documents = Documents::find($id);

            return view('admin.interest.documents.pdf', compact('documents'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController-pdf -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Vista para editar un registro
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $documents = Documents::find($id);

            return view('admin.interest.documents.edit', compact('documents'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController - edit -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Actualiza un registro en especifico
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $documents = Documents::find($id);
               
            //  guarda el archivo
            if($request->file){
            $file = $request->file;
            $filen = $documents->type;
            $name = $request->name.'.'.$filen;
            $file->move(public_path('storage') . '/documents', $name);
              
            $documents->update([
                'name' => $request->name,
                'file' => $name,
            ]);
            $documents->save();
        }else{
            $documents->update($request->all());
            $documents->save();
        }


            return redirect()->route('documents.list')->with('success', 'Noticia N°'.$id.' Actualizada ');
            
        } catch (\Throwable $th) {
            Log::error('DocumentsController - update -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Elimina un registro en especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $documents = Documents::find($id);

            // eliminar imagen
            $image_path = public_path()."/storage/documents/".$documents->file;
            File::delete($image_path);

            $documents->delete();
            
            return redirect()->route('documents.list')->with('success', 'Noticia N°'.$id.' Eliminada');
        } catch (\Throwable $th) {
            Log::error('DocumentsController - destroy -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
