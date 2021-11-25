@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de banners')

@section('content')

<div class="card p-2">
    <div class="card-header d-flex justify-content-end">
        <a href="{{ route('banner.create') }}" class="btn btn-primary">Crear nuevo banner</a>
    </div>
    <table class="table myTable border rounded">
        <thead>
            <tr class="text-center">
                <th>id</th>
                <th>titulo</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($banner as $item)
            <tr class="text-center">
                <td>N° {{ $item->id}}</td>
                <td>{{ $item->title}}</td>

                @if ($item->status == '1')
                <td> <a class="badge rounded-pill badge-light-success">Activo</a></td>
                @else
                <td> <a class="badge rounded-pill badge-light-danger">Inactivo</a></td>
                @endif

                <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                <td>
                    <a href="{{ route('banner.edit', $item->id) }}" class="item-edit"><i
                            class="text-primary font-medium-3" data-feather='edit'></i></a>
                            
                    <a class="item-edit" onclick="destroy({{ $item->id }})"><i class="text-danger font-medium-3"
                            data-id="{{ $item->id }}" data-feather='trash'></i>
                        <form id="delete_{{ $item->id }}" action="{{ route('banner.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('vendor-script')
<script>
    function destroy(id) {
        form = $('#delete_' + id);
        form.submit();
    };

</script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script>
    //datataables ordenes
$('.myTable').DataTable({
    responsive: true,
    order: [[ 0, "desc" ]],
})
</script>
@endsection
