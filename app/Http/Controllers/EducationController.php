<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->admin == 1){
            $education = Education::orderBY('id', 'desc')->get();

            return view('education.componentAdmin.index', compact('education'));
        }else if (Auth::user()->admin == 0) {
           $education = Education::orderBY('id', 'desc')->get();

           return view('education.componentUser.index', compact('education')); 
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('education.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $education = request()->validate([
           'description' => 'required',
           'link' => 'required|url',
           'image' => 'required|image',
       ]);
       
        $education = new Education();
        $education->description = $request->description;
        $education->link = $request->link;
      
        $image = $request->file('image');
        $name = time() . "." . $image->extension();
        $image->move(public_path('storage') . '/education', $name);
        $education->image = '' . $name;
        

        $education->save();
        
        return redirect(route('education.componentAdmin.index'))->with('msj-success', 'La Educacion fue creada con exito');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
