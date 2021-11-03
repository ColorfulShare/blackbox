
@extends('layouts/contentLayoutMaster')

@section('title', 'Inversiones')

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
                    <div>
                        <table class="table myTable table-striped">

                            <thead class="">

                                <tr class="text-center ">
                                    <th>#</th>
                                    @if(Auth::user()->admin == 1)<th>Correo</th>@endif
                                    <th>Inversion</th>
                                    <th>Ganancia</th>
                                    <th>Capital</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($inversiones as $inversion)

                                <tr class="text-center">
                                    <td>{{$inversion->id}}</td>
                                    @if(Auth::user()->admin == 1)<td>{{$inversion->user->email}}</td>@endif
                                    <td>$ {{number_format($inversion->invested, 2)}}</td>
                                    <td>$ {{number_format($inversion->gain, 2)}}</td>
                                    <td>{{number_format($inversion->capital,2)}} </td>
                                    <td>
                                        @if($inversion->status == 1)
                                            Activo
                                        @elseif($inversion->status == 2)
                                            Inactivo
                                        @endif
                                    </td>
                                    <td>{{$inversion->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
@endsection

{{-- CONFIGURACIÓN DE DATATABLE --}}
@include('panels.datatables-config')

