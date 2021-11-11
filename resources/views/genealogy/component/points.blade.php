{{-- el admin no vera puntos pero si vera el de los demas --}}
@if(Auth::user()->admin == 1 && Route::is('genealogy_type_id') )
    <div class="col-md-12 col-sm-12 text-center">
        <div class="row">
            <div class="container">
                <div class="row">
                     <div class="col-md-3 col-sm-12 col-12 ">
                        <div class=" white mt-2">
                            <button class="btn-tree text-left" >Puntos Izquierda: {{$binario['totali']}}</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-8 col-8">
                        <div class=" white mt-2">
                            <form action="{{route('genealogy_type_email', strtolower($type))}}" method="post">
                                         @csrf
                  
                            <input type="email" placeholder="Ingrese Email de Referido" name="email" class="form-control" id="jo">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-4">
                         <div class=" white mt-2">
                                            <button type="submit" class="btn-tree ">Buscar</button>
               
                    </div>
                    </div>
                             </form>
                              
               
                    <div class="col-md-3 col-sm-12 col-12">
                        <div class=" white mt-2">
                            <button class="btn-tree text-left" >Puntos Derecha: {{$binario['totald']}}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif

{{-- el usuario vera sus puntos pero el de los demas no --}}
@if(Auth::user()->admin == 0 && Route::is('genealogy_type') )
    <div class="col-md-12 col-sm-12 col-12  text-center">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-12 ">
                        <div class=" white mt-2">
                            <button class="btn-tree text-left" >Puntos Izquierda: {{$binario['totali']}}</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-8 col-8">
                        <div class=" white mt-2">
                            <form action="{{route('genealogy_type_email', strtolower($type))}}" method="post">
                                         @csrf
                  
                            <input type="email" placeholder="Ingrese Email de Referido" name="email" class="form-control" id="jo">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-4">
                         <div class=" white mt-2">
                                            <button type="submit" class="btn-tree ">Buscar</button>
               
                    </div>
                    </div>
                             </form>
                              
               
                    <div class="col-md-3 col-sm-12 col-12">
                        <div class=" white mt-2">
                            <button class="btn-tree text-left" >Puntos Derecha: {{$binario['totald']}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif