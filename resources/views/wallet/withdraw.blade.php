@extends('layouts/contentLayoutMaster')

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@section('content')
<div id="withdraw">
    <div class=" col-8 offset-md-2">
        <div class="card bg-lp">
            <div class="card-header">
                <h2 class="card-title text-white">Retirar Ganancias</h2>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <h5 class="text-white">Moneda</h5>
                            <p class="text-white1"> <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png" alt="" height="24"> USDT <span>TetherUS</span></p>
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <h5 class="text-white">Dirección</h5>
                            <input type="text" id="to" placeholder="Introduce aquí la dirección" name="wallet" v-model="wallet" class="form-control">
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <h5 class="text-white">Red</h5>
                            <p class="text-white1"> TRX <span>Tron (TRC20)</span></p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="text-white">Saldo en USDT</h5>
                            <p class="text-white1"> {{Auth::user()->saldoDisponible()}}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="text-white">Retiro Minimo</h5>
                            <p class="text-white1"> 100 USDT</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="text-white">% Fee de Retiro</h5>
                            <p class="text-white1">% {{ number_format(Auth::user()->feeRetiro(), 2) }}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="text-white">Monto comision</h5>
                            <p class="text-white1">{{ number_format(Auth::user()->getFeeWithdraw(), 2) }}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="text-white">Importe que se recibirá</h5>
                            <p class="text-white5">{{ number_format(Auth::user()->totalARetirar(),2) }} USDT</p>

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

<script>
    var vm_withdraw = new Vue({
        el: '#withdraw',
        data: function() {
            return {
                wallet: '',
                idliquidacion: 0
            }
        },

        methods: {
            /**
             * Permite abrir la modal de Detalle de informacion
             */
            openModalDetails: function() {
                $('#modalInfo').modal('show');
            },

            /**
             * Permite abrir la modal de Detalle de informacion
             */
            openModalAprobar: function() {
                $('#modalInfo').modal('hide');
                $('#modalModalAprobar').modal('show');
            },

            /**
             * Permite enviar el codigo de correo para aprobar liquidacion
             */
            sendCodeEmail: function() {
                let url = "/wallet/" + this.wallet + "/sendcodeemail";
                axios.get(url, []).then((response) => {
                    if (response.data > 0) {
                        this.idliquidacion = response.data
                        toastr.success("Codigo Enviado, Revise su correo", '¡Genial!', {
                            "progressBar": true
                        });
                    } else {
                        toastr.error("El monto solicitado es menor al minimo permitido 100$", '¡Error!', {
                            "progressBar": true
                        });
                    }
                }).catch(function(error) {
                    toastr.error("Ocurrio un problema con la solicitud", '¡Error!', {
                        "progressBar": true
                    });
                })
            }
        }
    })
</script>
@endsection