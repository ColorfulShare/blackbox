@extends('layouts/contentLayoutMaster')


{{-- permite llamar las librerias montadas --}}
@push('page_js')
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
@endpush

@push('custom_js')
<script src="{{asset('assets/js/withdraw.js')}}"></script>
@endpush

@section('content')
<div id="withdraw">
    <div class=" col-8 offset-md-2">
        <div class="card bg-lp">
            <div class="card-header">
                <h2 class="card-title">Retirar Ganancias</h2>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <h5 class="">Moneda</h5>
                            <p class=""> <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png" alt="" height="24"> USDT <span>TetherUS</span></p>
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <h5 class="">Dirección</h5>
                            <input type="text" id="to" placeholder="Introduce aquí la dirección" name="wallet" v-model="wallet" class="form-control">
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <h5 class="">Red</h5>
                            <p class=""> TRX <span>Tron (TRC20)</span></p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="">Saldo en USDT</h5>
                            <p class=""> {{Auth::user()->saldoDisponible()}}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="">Retiro Minimo</h5>
                            <p class=""> 25 USDT</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="">Fee de Retiro</h5>
                            <p class="">% {{ number_format(Auth::user()->feeRetiro(), 2) }}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="">Monto comision</h5>
                            <p class="">{{ number_format(Auth::user()->getFeeWithdraw(), 2) }}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="">Importe que se recibirá</h5>
                            <p class="">{{ number_format(Auth::user()->totalARetirar(),2) }} USDT</p>

                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <button class="btn btn-block btn-primary d" v-show='wallet != ""' v-on:click='openModalDetails'>Retirar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('wallet.componentes.modalAprobar')
    @include('wallet.componentes.modalInfo')
</div>
@endsection