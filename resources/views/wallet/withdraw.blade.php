@extends('layouts/contentLayoutMaster')

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

                            <input type="text" id="to" placeholder="Introduce aquí la dirección" name="wallet" onkeyup="press()" class="form-control ">

                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <h5 class="">Red</h5>
                            <p class="">TRX<span>Tron (TRC20)</span></p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="">Saldo en USDT</h5>
                            <p class=""> {{Auth::user()->saldoDisponible()}}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class="">Retiro Minimo</h5>
                            <p class=""> 100 USDT</p>
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
                            <button class="btn btn-block btn-primary" id="show" data-bs-toggle="modal" data-bs-target="#modalInfo" onclick="getValueInput()">
                                Retirar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('wallet.componentes.modalAprobar')
    @include('wallet.componentes.modalInfo')

    <script>
        // Funcion para desaparecer el boton mientras no haya nada en el input
        document.getElementById("show").style.visibility = "hidden";

        function press() {
            document.getElementById("show").style.visibility = "visible";
        }

        //Pasamos el valor del input al modal ModalInfo
        let getValueInput = () => {
            let wallet = document.getElementById("to").value;
            document.getElementById("wallet").innerHTML = wallet;
        };

        //Validamos el envio del email

        let enviar = document.getElementById("Codigo-e").style.display = "none";
        let enviado = document.getElementById("Codigo-s").style.display = "block";


        //Funcion para mandar el codigo al correo al solicitar un retiro
        let sendCodeEmail = () => {
            (async () => {
                try {
                    url = "/wallet/" + document.getElementById("to").value + "/sendcodeemail"
                    let response = await fetch(url, []);
                    if (response.ok) {

                        let datos = await response.json();

                        if (datos > 0) {
                            let enviar = document.getElementById("Codigo-e").style.display = "block";
                            let enviado = document.getElementById("Codigo-s").style.display = "none";
                            idliquidacion = datos;
                            toastr.success("Codigo Enviado, Revise su correo", '¡Genial!', {
                                "progressBar": true
                            });
                        }

                    } else {
                        toastr.error("El monto solicitado es menor al minimo permitido 100$", '¡Error!', {
                            "progressBar": true
                        });
                    }
                } catch (err) {
                    toastr.error("Ocurrio un problema con la solicitud", '¡Error!', {
                        "progressBar": true
                    });
                }
            })();
        }
    </script>

</div>
@endsection