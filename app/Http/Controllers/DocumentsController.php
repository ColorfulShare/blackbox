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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {

            $documents = Documents::all();

            return view('documents.list', compact('documents'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController-list -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            $count = DB::table('documents')->orderby('created_at', 'desc')->first();

            return view('documents.create', compact('count'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController - create -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

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
            
        } catch (\Throwable $th) {
            Log::error('DocumentsController - store -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {

            $documents = Documents::all();

            return view('documents.show', compact('documents'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController-show -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        try {

            $documents = Documents::find($id);

            return view('documents.pdf', compact('documents'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController-pdf -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $documents = Documents::find($id);

            return view('documents.edit', compact('documents'));

        } catch (\Throwable $th) {
            Log::error('DocumentsController - edit -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $documents = Documents::find($id);
               
            $documents->update($request->all());
            $documents->save();


            return redirect()->route('documents.list')->with('success', 'Noticia N°'.$id.' Actualizada ');
            
        } catch (\Throwable $th) {
            Log::error('DocumentsController - update -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $documents = Documents::find($id);
    dd($id);
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
