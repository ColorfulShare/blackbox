@extends('layouts/contentLayoutMaster')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('content')
<div id="settlement">
    <div class="col-12">
        <div class="card bg-lp">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <h1 class="text-white">Retiros </h1>
                        <table class="table nowrap scroll-horizontal-vertical myTable table-striped">
                            <thead class="">
                                <tr class="text-center text-white bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Monto</th>
                                    <th>Feed</th> 
                                    <th>Hash</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liquidaciones as $liqui)
                                    <tr class="text-center text-white">
                                        <td>{{$liqui->id}}</td>
                                        <td>{{$liqui->getUser->firstname}} {{$liqui->getUser->lastname}}</td>
                                        <td>{{$liqui->monto_bruto}}</td>
                                        <td>@if($liqui->feed == '0')
                                                -
                                            @else
                                                {{$liqui->feed}}
                                            @endif   
                                        </td>
                                        <td>@if($liqui->hash === '')
                                                -
                                            @else
                                                {{$liqui->hash}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($liqui->status == 0)
                                            En Espera
                                            @elseif($liqui->status == 1)
                                            Liquidado
                                            @else
                                            Reversado
                                            @endif
                                        </td>
                                        <td>{{date('Y-m-d', strtotime($liqui->created_at))}}</td>
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
@section('page-script')
    <script>
        //datataables ordenes
    $('.myTable').DataTable({
        responsive: true,
        order: [[ 0, "desc" ]],
    })
    </script>
@endsection

