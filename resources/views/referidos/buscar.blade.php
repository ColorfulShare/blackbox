
@extends('layouts/contentLayoutMaster')

@section('title', 'Buscar referidos')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<div id="logs-list">
    <div class="col-12">
        <div class="card bg-lp">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <h1 class="text-center">Ingrese el id del usuario al que desea saber sus referidos</h1>
                    <form action="{{route('referidos.index')}}" method="GET">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-8 col-8">
                            <div class=" white mt-2">
                                <input type="number" placeholder="Ingres el id del usuario" name="id" class="form-control" id="id">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-4">
                            <div class=" white mt-2">
                                <button type="submit" class="btn btn-primary ">Buscar</button>
                        
                            </div>
                        </div>
                    </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
  <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>

@endsection

