@extends('layouts.email')

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
<div class="container fluid">
    <div class="mt-2 row">
        <div class="col-12" style="margin: 0 auto">
            <div class="card">

                <div class="card-body text-center">

                    <div class="col-12 text-center logobinari">
                        <img src="{{asset('assets/img/pandora.png')}}" class="mb-2" alt="logo" width="200">
                    </div>

                    <div class="card-text mt-2">
                        <h4 class="text-white card-title">Hola, {{$data['user']}}
                        </h4>
                    </div>
                    <h5 class="card-text mt-2">
                        Su código de verificacion de cuenta
                        <br><br>
                        <h3>{{ $data['code'] }} </h3>
                        <br><br>
                        <strong>Este código caducara en 30 minutos, úselo en la brevedad posible</strong>
                    </h5>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
