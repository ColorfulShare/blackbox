@extends('layouts/contentLayoutMaster')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@section('content')
<div id="settlement">
    <div class="col-12">
        <div class="card bg-lp">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <h1 class="">Solicitud de Retiros</h1>
                        <table class="table nowrap scroll-horizontal-vertical myTable table-striped">
                            <thead class="">
                                <tr class="text-center bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    {{--<th>Total</th>̣--}}
                                    <th>Monto</th>
                                    {{--<th>Feed</th>--}}
                                    <th>Hash</th>
                                    <th>Billetera</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>tipo</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liquidaciones as $liqui)
                                <tr class="text-center ">
                                    <td>{{$liqui->id}}</td>
                                    <td>{{$liqui->fullname}}</td>
                                    {{--<td>{{$liqui->total}}</td>--}}
                                    <td>{{$liqui->monto_bruto}}</td>
                                    {{--<td>{{$liqui->feed}}</td>--}}
                                    <td> @if($liqui->hash == NULL)
                                        -
                                        @else
                                        {{$liqui->hash}}
                                        @endif
                                    </td>
                                    <td>{{$liqui->wallet_used}}</td>
                                    <td>
                                        @if($liqui->status == 0)
                                        En Espera
                                        @elseif($liqui->status == 1)
                                        Liquidado
                                        @endif
                                    </td>
                                    <td>{{date('Y-m-d', strtotime($liqui->created_at))}}</td>
                                    <td>{{$liqui->getuser->type}}</td>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-4 ">
                                                    <button class="btn btn-primary ml-2" onclick="vm_liquidation.getDetailComisionLiquidation({{$liqui->id}})">
                                                        <i data-feather='eye'></i>
                                                    </button>
                                                </div>
                                                <div class="col-4">
                                                    <button class="btn btn-success" onclick="vm_liquidation.getDetailComisionLiquidationStatus({{$liqui->id}}, 'aproved')">
                                                        <i data-feather='check'></i>
                                                    </button>
                                                </div>
                                                <div class="col-4">

                                                    <button class="btn btn-danger" onclick="vm_liquidation.getDetailComisionLiquidationStatus({{$liqui->id}}, 'reverse')">
                                                        <i data-feather='repeat'></i>
                                                    </button>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    @include('withdraw.componentes.modalDetalles', ['all' => false])
                    @include('withdraw.componentes.modalAction')

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var vm_liquidation = new Vue({
        el: '#settlement',
        data: function() {
            return {
                seleAllComision: false,
                StatusProcess: '',
                ComisionesDetalles: []
            }
        },
        methods: {
            /**
             * Permite obtener la informacion de las comisiones de un usuario
             * @param {integer} iduser 
             */
            getDetailComision: function(user_id) {
                let url = "/liquidation-show/" + user_id
                this.seleAllComision = false
                axios(url).then((response) => {
                    this.ComisionesDetalles = response.data
                    console.log(response.data);
                    $('#modalModalDetalles').modal('show')
                }).catch(function(error) {
                    toastr.error("Ocurrio un problema con la solicitud", '¡Error!', {
                        "progressBar": true
                    });
                })
            },

            /**
             * Permite obtener la informacion de las comisiones de las liquidaciones
             * @param {integer} iduser 
             */
            getDetailComisionLiquidation: function(user_id) {
                let url = "/liquidation-edit/" + user_id
                this.seleAllComision = false
                axios(url).then((response) => {
                    this.ComisionesDetalles = response.data
                    $('#modalModalDetalles').modal('show')
                }).catch(function(error) {
                    toastr.error("Ocurrio un problema con la solicitud", '¡Error!', {
                        "progressBar": true
                    });
                })
            },

            /**
             * Permite obtener la informacion de las comisiones de las -liquidaciones para aprobar o reversar
             * @param {integer} iduser
             * @param {string} status
             */
            getDetailComisionLiquidationStatus: function(user_id, status) {
                this.StatusProcess = status
                let url = "/liquidation-edit/" + user_id
                this.seleAllComision = false
                axios(url).then((response) => {
                    this.ComisionesDetalles = response.data
                    $('#modalModalAccion').modal('show')
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