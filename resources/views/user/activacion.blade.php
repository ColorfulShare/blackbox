
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
<div class="card">
    <div class="card-body">
        <div class="table-responsive">

            <table class="table w-100 nowrap scroll-horizontal-vertical myTable w-100 ">
                <thead class="">

                    <tr class="text-center text-white bg-purple-alt2">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>

                </thead>
                <tbody>
                     @foreach ($user as $user)
                    <tr class="text-center">
                        <td>{{$user->id}}</td>
                        <td>{{$user->fullName()}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->status == 0)
                                <a  class="btn btn-warning">Inactivo</a>
                            @elseif($user->status == 1)
                                <a  class="btn btn-success">Activo</a>
                                @elseif($user->status == 2)
                                <a  class="btn btn-danger">Eliminado</a>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-outline-primary text-bold-600" onclick="establecer_form({{$user->id}})">Activar</a>
                        </td>
                    </tr>
                    @endforeach
        
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalActivacion" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Activar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            <form action="{{ route('user.activar') }}" method="POST">
            @csrf
            <div class="modal-body">

                <input type="hidden" name="id" id="id">
                ¿Desea crear una orden?
                <br>
                <label>Seleccione el paquete</label>
                <select name="paquete" required class="form-control">
                    <option value="">Seleccione un paquete</option>
                    @foreach ($paquetes as $paquete)
                        <option value="{{$paquete->id}}">{{$paquete->name}}</option>
                    @endforeach
                </select>

                <div class="vs-checkbox-con vs-checkbox-success ">
                    <input type="checkbox" name="comision" id="comision">
                    <span class="vs-checkbox ">
                        <span class="vs-checkbox--check">
                            <i class="vs-icon feather icon-check"></i>
                        </span>
                    </span>
                    <label for="comision"><span class="">generar comision</span></label>
                </div>  

            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
  <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script>
        function establecer_form(id){
            $('#id').val(id);
            $('#ModalActivacion').modal('show')
        }
    </script>
@endsection



