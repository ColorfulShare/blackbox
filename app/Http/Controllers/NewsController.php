<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

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

            $count = DB::table('news')->orderby('created_at', 'desc')->first();

            return view('news.create', compact('count'));

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
                "description" => ['required'],
                "banner" => ['required'],
                "status" => ['required'],
            ];
    
            $msj = [
                'title.required' => 'El titulo es Requerido',
                'description.required' => 'El contenido es Requerido',
                'banner.required' => 'La foto es Requerida',
                'status.required' => 'El estado es Requerido',
            ];
    
            $this->validate($request, $fields, $msj);
                
            //  guarda el banner
            if ($request->hasFile('banner')) {
                $file = $request->banner;
                $filen = $file->getClientOriginalExtension();
                $name = $request->title.'.'.$filen;
                $file->move(public_path('storage') . '/news-banner', $name);
            // crea el registro
            $news = News::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'banner' => $name,
            ]);
            $news->save();

        } 
            
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
        // try {

          
            $news = News::find($id);

            $fields = [
                "title" => ['required'],
                "description" => ['required'],
                "status" => ['required'],
            ];
    
            $msj = [
                'title.required' => 'El titulo es Requerido',
                'description.required' => 'El contenido es Requerido',
                'status.required' => 'El estado es Requerido',
            ];
    
            $this->validate($request, $fields, $msj);
            // borra el anterior
            if ($request->banner) {

                $news->destroy(public_path('storage').'/news-banner', $news->banner);

                $file = $request->banner;
                $filen = $file->getClientOriginalExtension();
                $name = 'storage/news-banner/'.$request->title.'.'.$filen;
                $file->move(public_path('storage') . '/news-banner', $name);

                // crea el registro
                $news = News::updating([
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->status,
                    'banner' => $name,
                ]);

            }else{
                // crea el registro
                $news->update($request->all());
            }

            return redirect()->route('news.list')->with('success', 'Noticia N°'.$id.' Actualizada ');
            
        // } catch (\Throwable $th) {
        //     Log::error('NewsController - update -> Error: '.$th);
        //     abort(403, "Ocurrio un error, contacte con el administrador");
        // }
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
    
            // eliminar imagen
            $image_path = public_path()."/storage/news-banner/".$news->banner;
            File::delete($image_path);

            $news->delete();
            
            return redirect()->route('news.list')->with('success', 'Noticia N°'.$id.' Eliminada');
        } catch (\Throwable $th) {
            Log::error('NewsController - destroy -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
