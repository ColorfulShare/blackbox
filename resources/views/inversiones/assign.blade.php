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
<div class="card">
    <div class="card-body">
        <div class="table-responsive">

            <table class="table w-100 nowrap scroll-horizontal-vertical myTable w-100 ">
                <thead class="">

                    <tr class="text-center text-white bg-purple-alt2">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>billetera</th>
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
                          @if($user->wallet == null)
                            No posee billetera
                          @else 
                            {{$user->wallet}}
                          @endif
                        </td>
                        <td>
                            @if($user->status == 0)
                               Inactivo
                            @elseif($user->status == 1)
                               Activo
                            @elseif($user->status == 2)
                               Eliminado
                            @endif
                        </td>
                        <td>
                           @if($user->wallet == null)
                               no posee billetera
                            @else
                               <a class="btn btn-outline-primary text-bold-600" href="{{ route('inversiones.activation', $user->id) }}">Asignar</a>
                            @endif  
                        </td>
                    </tr>
                    @endforeach
        
                </tbody>
            </table>
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