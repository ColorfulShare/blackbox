@extends('layouts/contentLayoutMaster')

@section('title', 'Educacion')

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"/>
@endsection

@section('content')
  <div class="col-12">
    <div class="card bg-lp">
      <div class="card-content">
        <div class="card-header">
          <h1><strong > Lista de educacion</strong></h1>
           <a href="{{route('education.create')}}" class="btn btn-primary  mb-2 waves-effect waves-light">Agregar Nuevo</a>
        </div>
        <div class="card-body ">
          <div class="table-responsive">
            <table class="table nowrap scroll-horizontal-vertical myTable2 table-striped mt-2">  
              <thead class="thead-light text-center">
                <th>id</th>
                <th>descripcion</th>
                <th>imagen</th>
                <th>link</th>
              </thead>
            <tbody class="text-center">
            @foreach ($education as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->description }}</td>
                <td>
                  @if ($item->image  === null)
                    <p>informacion no disponible</p>
                  @else
                    <a href="/storage/education/{{$item->image}}" data-lightbox="image" data-title="Link : {{$item->link}}">
                      <img src="/storage/education/{{$item->image}}" height="40" width="80px" title="ver imagen">
                    </a>
                  @endif
                </td>
                <td>{{ $item->link }}</td>
             @endforeach
          </tbody>
         </table>
      </div>
    </div>
  </div>
@endsection
@section('script')

@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script> 
@endsection

