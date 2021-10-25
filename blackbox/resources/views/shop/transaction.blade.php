
@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <style>
      .list-group-item-action{
        cursor: pointer;
      }
  </style>
@endsection

@section('content')
    <div id="adminServices">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Orden ID:</p>
                                    <p class="font-weight-bold">Nombre:</p>
                                    <p class="font-weight-bold">Email</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="text-right">{{$orden->id}}</p>
                                    <p class="text-right">{{$user->name}}</p>
                                    <p class="text-right">{{$user->email}}</p>
                                </div>
                            </div>
                            
                            <table class="table table-striped">
                                <thead class="">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$orden->package->name}}</td>
                                        <td>{{$orden->amount}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" id="btn_pagar">
                                    Pagar
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="ModalPagar" tabindex="-1" aria-labelledby="ModalPagarLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="ModalPagarLabel">Pagar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('shop.store')}}" method="POST" enctype="multipart/form-data" class="d-inline">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input type="hidden" id="type_payment" name="type_payment">
                                                        <div class="row justify-content-center">
                                                            <div class="col-5">
                                                                <img id="img_billetera" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--
                                                    <div class="col-12">
                                                        <a type="button" class="btn btn-primary" id="copy_billetera" onclick="getBilletera()">billetera</a>
                                                    </div>
                                                    --}}
                                                    <div class="col-12">
                                                        <label for="comprobante" class="form-label w-100">{{ __('Comprobante de pago:') }}</>
                                                        <input name="comprobante" id="comprobante" type="file" class="w-100 form-control" required accept="image/*"></>
                                                    </div>  
                                                    <div class="col-12">
                                                        <label for="hash" class="form-label w-100">{{ __('Hash:') }}</>
                                                        <input name="hash" id="hash" type="text" class="w-100 form-control" required></>
                                                    </div>   
                                                    <div class="col-12">
                                                        <label for="orden" class="form-label w-100">{{ __('Número de la orden:') }}</>
                                                        <input name="orden" id="orden" type="text" class="w-100 form-control" value="{{$orden->id}}" readonly></>
                                                    </div>  
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger">Finalizar</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <p>Seleccione el metodo de pago:</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card list-group-item list-group-item-action" moneda="BTC">
                                        <div class="card-content">
                                            <div class="card-body card-dashboard">
                                                <img
                                                src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/512/Bitcoin-BTC-icon.png"
                                                alt="" height="24">
                                                BTC 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card list-group-item list-group-item-action" moneda="USDT_ERC20">
                                        <div class="card-content">
                                            <div class="card-body card-dashboard">
                                                <img
                                                src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png"
                                                alt="" height="24">
                                                USDT ERC20
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card list-group-item list-group-item-action" moneda="USDT_TRC20">
                                        <div class="card-content">
                                            <div class="card-body card-dashboard">
                                                <img
                                                src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png"
                                                alt="" height="24">
                                                USDT TRC20
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
    <script>
        $('.list-group-item').click(function(e){

            $('.list-group-item').removeClass('active');
            $(this).addClass('active');
            let moneda = $(this).attr('moneda');
            $('#type_payment').val(moneda);
            $('#img_billetera').attr('src', "{{asset('img/billeteras')}}"+'/'+moneda+'.png')
        })

        $('#btn_pagar').click(function(){
            if($('#type_payment').val() != ''){
                let myModal = new bootstrap.Modal(document.getElementById('ModalPagar'), {
                    keyboard: false
                })

                myModal.show();
            }else{
                toastr['info']('Debe seleccionar un metodo de pago', 'Informacion', {
                  closeButton: true,
                  tapToDismiss: false
                });
            }
                
            
        })

        //$('#copy_billetera').click(getBilletera);

        function getBilletera() {
            var aux = document.createElement("input");
            aux.setAttribute("value", "222");
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);

            toastr['info']('la billetera ah sido copiada exitosamente', 'Copiado', {
                closeButton: true,
                tapToDismiss: false
            });
    }
  </script>
@endsection
