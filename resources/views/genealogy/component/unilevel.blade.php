<div class="card mb-3" id="center" style="max-width: 540px;">
    <div class="art">
        <div class="row g-0">
            <div class="col-md-4 p-2">
                <img id="imagen" class="rounded-circle img-fluid" width="110px" height="110px">
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
                </div>
                </div>


            </div>
            @if (Auth::user()->admin == 1)
            <div class="col-12 d-flex mb-2 justify-content-center text-white">
                <a class="btn-primary w-50" id="ver_arbol"> Ver
                    Arbol</a>
            </div>
            @endif
        </div>

    </div>

</div>
</div>