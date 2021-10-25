
@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <div id="adminServices">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Orden ID:</p>
                                    <p class="font-weight-bold">Nombre:</p>
                                    <p>Email</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="text-right">{{$orden->id}}</p>
                                    <p class="text-right">{{$orden->id}}</p>
                                    <p class="text-right">{{$orden->id}}</p>
                                </div>
                            </div>
                            
                            <table class="table table-striped">
                                <thead class="">
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Paquete</td>
                                        <td>1</td>
                                        <td>{{$orden->amount}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button class="btn btn-success">Pagar</button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            
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
@endsection
