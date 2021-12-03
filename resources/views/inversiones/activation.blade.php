@extends('layouts/contentLayoutMaster')

@section('title', 'Asignar inversion')

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
          <h1 class="text-center">Asignar una inversion</h1>
          <div class="row mt-3 pl-2 pr-2 " style="padding-left: 35%">
            <div class="col-md-4 col-sm-1">
              <div class="project-detail-titles">Usuario :</div>
                <div class="mt-1 project-detail-dates">
                  <span><b>{{ $user->firstname }} {{ $user->lastname }}</b></span>
                </div>
              </div>
              <div class="col-md-5 col-sm-1">
                <div class="project-detail-titles">Billetera :</div>
                  <div class="mt-1 project-detail-dates">
                    @if($user->wallet == null)
                     No posee billetera
                    @else
                     <span><b>{{ $user->wallet }}</b></span>
                    @endif
                  </div>
                </div>
              </div>
          
          <form action="{{ route('inversiones.action') }}" method="POST" novalidate>
            @csrf
            <div class="body">
              <input type="hidden" name="id" id="id">
              <input type="hidden" name="user_id" value="{{$user->id}}">
              <br>
              <div class="form-group">
                <label for="invested" style="float:left;" class="h4"><strong>Monto</strong> :</label>
                <input type="text" name="invested" class="form-control @error('invested') is-invalid @enderror " placeholder="Agregar Monto"/>
                @error('invested')
                  <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="mt-1" style="padding-left: 78%">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
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

