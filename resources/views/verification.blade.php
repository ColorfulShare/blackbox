@extends('layouts.email')
@push('custom_css')

<style>

    @media (max-width: 800px) {
        .logobinari img{
            width: 100px;
        }
    }

    @media (min-width: 801px) {
    .card{
            margin: 0 auto;
            width: 40%;
        }
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="mt-2 row">
        <div class="col-12" style="margin: 0 auto">
            <div class="card" style="margin-top:185px;background-color:#283046;">

                <div class="card-body text-center">

                    <div class="col-12 text-center logobinari">
                    <img src="{{asset('img/logo/blackbox.png')}}" style="width: 150px;">
                    </div>

                    <div class="card-text mt-2">
                        {{-- <h4 class="text-white card-title">Hola, {{Auth::user()->name}} --}}
                            <h4 class="text-white card-title">Hola, {{Auth::user()->firstname}}
                        </h4>
                    </div>
                    <h5 class="card-text mt-2 text-white">
                        Acabamos de enviar un código de 6 digitos a tu correo.
                        <br><br>
                        Revisa e ingresalo en el recuadro aqui debajo para poder ingresar a nuestro sistema
                        <br><br><br>
                    </h5>

                     <form action="{{ route('verify-account', Auth::user() )}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="text" placeholder="Pega tu código aquí" class="form-control" name="code"
                                style="color: white; font-weight:bold; background-color: #151c2f;border:none;"
                                >

                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <h5 class="card-text mt-2">
                            <button
                                type="submit"
                                style="padding: 10px 15px;border-radius: 5px; font-weight: 600; line-height: 26px;"
                                class="btn btn-danger">
                                Acceder a tu cuenta
                            </button>
                        </h5>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
