<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Vista de la lista de registros
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {

            $banner = Banner::where('id', 1)->get();

            return view('admin.interest.banner.list', compact('banner'));

        } catch (\Throwable $th) {
            Log::error('BannerController-list -> Error: '.$th);
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

            $count = DB::table('banner')->orderby('created_at', 'desc')->first();

            return view('admin.interest.banner.create', compact('count'));

        } catch (\Throwable $th) {
            Log::error('BannerController - create -> Error: '.$th);
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

        $fields = [
            "title" => ['required'],
            "banner" => ['required'],
            "status" => ['required'],
        ];
    
        $msj = [
            'title.required' => 'El titulo es Requerido',
            'banner.required' => 'La foto es Requerida',
            'status.required' => 'El estado es Requerido',
        ];
        
        $this->validate($request, $fields, $msj);
        
        //  guarda el banner
        if ($request->hasFile('banner')) {
            $file = $request->banner;
            $filen = $file->getClientOriginalExtension();
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('storage') . '/banner', $name);

            // crea el registro
            $banner = Banner::create([
                'title' => $request->title,
                'status' => $request->status,
                'banner' => $name,
            ]);
            $banner->save();
        } 
        
        return redirect()->route('banner.list')->with('success', 'La noticia se creo Exitosamente');
    }

    /**
     * Ver un registro en especifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

            $banner = Banner::find($id);

            return view('admin.interest.banner.edit', compact('banner'));

        } catch (\Throwable $th) {
            Log::error('BannerController - edit -> Error: '.$th);
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
        // try {

            $banner = Banner::find($id);

            $fields = [
                "title" => ['required'],
                "status" => ['required'],
            ];
    
            $msj = [
                'title.required' => 'El titulo es Requerido',
                'status.required' => 'El estado es Requerido',
            ];
    
            $this->validate($request, $fields, $msj);

            // borra el anterior
            if ($request->banner) {

                $image_path = public_path()."/storage/banner/".$banner->banner;
                File::delete($image_path);

                $file = $request->banner; 
                $filen = $file->getClientOriginalExtension();
                $name = $request->title.'.'.$filen;
                $file->move(public_path('storage') . '/banner', $name);

                // crea el registro
                $banner->update([
                    'title' => $request->title,
                    'status' => $request->status,
                    'banner' => $name,
                ]);
                
            }else{
                // actualiza el registro
                $banner->update($request->all());
            }

            return redirect()->route('banner.list')->with('success', 'Noticia N°'.$id.' Actualizada ');
            
        // } catch (\Throwable $th) {
        //     Log::error('BannerController - update -> Error: '.$th);
        //     abort(403, "Ocurrio un error, contacte con el administrador");
        // }
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

            $banner = Banner::find($id);
    
            // eliminar imagen
            $image_path = public_path()."/storage/banner/".$banner->banner;
            File::delete($image_path);

            $banner->delete();
            
            return redirect()->route('banner.list')->with('success', 'Noticia N°'.$id.' Eliminada');
        } catch (\Throwable $th) {
            Log::error('BannerController - destroy -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
