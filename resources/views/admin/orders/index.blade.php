@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

@endsection

@section('content')
    <div id="logs-list">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                                <thead class="">

                                    <tr class="text-center">                                
                                        <th>ID</th>
                                        <th>Correo</th>
                                        <th>Monto</th>
                                        <th>Hash</th>
                                        <th>Tipo de moneda</th>
                                        <th>Comprobante</th>
                                        <th>Estado</th>
                                        <th>Fecha de Creación</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    @foreach ($orders as $orden)
                                        <tr class="text-center">
                                            <td>{{$orden->id}}</td>
                                            <td>{{$orden->user->email}}</td>
                                            <td>{{$orden->amount}}</td>
                                            <td>{{$orden->hash}}</td>
                                            <td>{{str_replace('_', ' ', $orden->type_payment)}}</td>
                                            <td>  
                                                @if($orden->comprobante != null)
                                                <a class="btn btn-danger" target="_blank" href="{{asset('/storage/'.$orden->user_id .'/comprobante/'.$orden->comprobante)}}"><i data-feather='file-text'></i></a>
                                                @endif
                                            </td>
                                            <td>
                                            
                                                <button type="button"
                                                    @if(Auth::user()->admin == '1' && $orden->status == '1')
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalStatus{{$orden->id}}"
                                                    @endif
                                                    
                                                    class="@if ($orden->status == '0') btn btn-info text-white text-bold-600  @elseif($orden->status == '1') btn btn-warning text-white text-bold-600 @elseif($orden->status == '2') btn btn-success text-white text-bold-600 @elseif($orden->status == '3') btn btn-danger text-white text-bold-600 @endif">{{$orden->status()}}
                                              </button>
                                            </td>
                                            <td>{{$orden->created_at->format('Y-m-d')}}</td>
                                            @if(Auth::user()->admin == '1' && $orden->status == '1')
                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalStatus{{$orden->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog"> 
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Cambiar estatus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('orders.cambiarStatus') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">

                                                        <input type="hidden" name="id" value="{{$orden->id}}">
                                                        ¿Desea cambiar es estatus de la orden?
                                                        <br>
                                                        <label>Seleccione el estado</label>
                                                        <select name="status" required class="form-control">
                                                            <option value="">Seleccione un estado</option>
                                                            <option value="2">Aprobado</option>
                                                            <option value="3">Rechazado</option>
                                                        </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
 
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