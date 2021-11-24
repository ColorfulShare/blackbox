<div class="card mb-3" id="center" style="max-width: 540px;">
    <div class="art">
        <div class="row g-0">
            <div class="col-md-4 p-2">
                <img src="{{asset('img/logo/blackbox.png')}}" id="imagen" class="rounded-circle img-fluid" width="130px" height="130px">
            </div>

            <div class="col-md-8">
                <div class="card-body">
                <div class="col-12">
                    <div class="">
                        <p><b>Fecha de Ingreso:</b> <span id="fecha_ingreso"></span></p>
                    </div>
                    <div class="">
                        <p><b>Email:</b> <span id="email"></span></p>
                    </div>
                    <div class="">
                        <p><b>Estado:</b> <span id="estado"></span></p>
                    </div>
                    <div class="d-grid">
                        <a class="btn btn-primary d-none" id="ver_arbol"> Ver
                            Arbol</a>
                    </div>
                </div>
                </div>


            </div>
            {{--@if (Auth::user()->admin == 1)--}}
            
            {{--@endif--}}
        </div>

    </div>

</div>
</div>