<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {

            $news = News::all();

            return view('news.list', compact('news'));

        } catch (\Throwable $th) {
            Log::error('NewsController-list -> Error: '.$th);
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

            return view('news.create');

        } catch (\Throwable $th) {
            Log::error('NewsController - create -> Error: '.$th);
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

            $fields = [
                "title" => ['required'],
                "content" => ['required'],
                "photo" => ['required'],
                "status" => ['required'],
            ];
    
            $msj = [
                'title.required' => 'El titulo es Requerido',
                'content.required' => 'El contenido es Requerido',
                'photo.required' => 'La foto es Requerida',
                'status.required' => 'El estado es Requerido',
            ];
    
            $this->validate($request, $fields, $msj);
    
            $news = News::create($request->all());

            //  guarda el photo
            if($request->hasFile('photo')) {
              
              $file = $request->file('photo');
              $name = $news->id.".".$file->getClientOriginalExtension();
              $file->move(public_path('storage') . '/news-photo', $name);
              $news->photo = $name;
            } 
    
            $news->save();
    
            return redirect()->route('news.list')->with('success', 'La noticia se creo Exitosamente');
            
        } catch (\Throwable $th) {
            Log::error('NewsController - store -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

            $news = News::find($id);

            return view('news.edit', compact('news'));

        } catch (\Throwable $th) {
            Log::error('NewsController - edit -> Error: '.$th);
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

            $news = News::find($id);
    
            $fields = [
                "name" => ['required'],
                "price" => ['required'],
                "description" => ['required'],
                "status" => ['required'],
            ];
    
            $msj = [
                'name.required' => 'El titulo del curso es Requerido',
                'price.required' => 'El precio del curso es Requerido',
                'description.required' => 'La descripcion es Requerida',
                'status.required' => 'El estado es Requerido',
            ];
    
            $this->validate($request, $fields, $msj);
    
            $news->update($request->all());
    
            //  guarda el photo
            if($request->hasFile('photo')) {
              //  eliminar el photo anterior
              $news->destroy(public_path('storage') . '/news-photo', $news->name);
              $file = $request->file('photo');
              $name = $news->id.".".$file->getClientOriginalExtension();
              $file->move(public_path('storage') . '/news-photo', $name);
              $news->photo = $name;
            } 

            $news->save();
    
            return redirect()->route('news.list')->with('success', 'Noticia N°'.$id.' Actualizada ');
    
        } catch (\Throwable $th) {
            Log::error('NewsController - update -> Error: '.$th);
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

            $news = News::find($id);
    
            $news->delete();
            
            return redirect()->route('news.list')->with('success', 'Noticia N°'.$id.' Eliminada');
    
        } catch (\Throwable $th) {
            Log::error('NewsController - destroy -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
