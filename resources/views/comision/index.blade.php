@extends('layouts/contentLayoutMaster')

@section('title', 'Comisiones')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
  @endsection

@section('content')
<div class="col-12">
    <div class="card bg-lp">
        <div class="card-content">
            <div class="card-body ">
                <div class="table-responsive">
                    <h1><strong >Lista de comisiones</strong></h1>
                    <table class="table nowrap scroll-horizontal-vertical myTable2 table-striped mt-2">
                        <thead>
                            <tr class="text-center ">
                                <th>id</th>
                                <th>fecha</th>
                                <th>usuario</th>
                                <th>referido</th>
                                <th>monto</th>
                                <th>estado</th>
                                <th>nivel</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comision as $item)
	                            <tr class="text-center">
	                              <td>{{$item->id}}</td>
	                              <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
	                              <td>{{$item->getUser->firstname}} {{$item->getUser->lastname}}</td>   
		                            @if($item->getUser->referred_id === 0)
		                              <td>{{$item->getUser->firstname}} {{$item->getUser->lastname}}</td>
		                            @else
		                           	  <td>{{$item->getUser->referred_id}}</td>
		                            @endif
	                              <td>{{$item->amount}}</td>
	                              <td>
                                  <a class=" btn btn-primary text-white text-bold-600">Pagada</a>   
                                </td> 
	                              <td>
	                                @if ($item->level == '0')
                                    <a class=" btn btn-primary text-white text-bold-600">Normal</a>
                                  @else($item->level == '1')
                                    <a class=" btn btn-danger text-white text-bold-600">Admin de red</a>
                                  @endif
	                              </td>  
	                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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

