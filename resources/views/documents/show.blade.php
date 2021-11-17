@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de documentos')

@section('content')

<div class="card p-2">
    <table class="table myTable border rounded">
        <thead>
            <tr class="text-center">
                <th>id</th>
                <th>nombre</th>
                <th>tipo de archivo</th>
                <th>Fecha de Subida</th>
                <th>ver archivo</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($documents as $item)
            <tr class="text-center">
                <td>N° {{ $item->id}}</td>
                <td>{{ $item->name}}</td>

                @if ($item->type == 'pdf')
                <td> <a class="badge rounded-pill badge-light-danger">PDF</a></td>
                @else
                <td> <a class="badge rounded-pill badge-light-info">Video</a></td>
                @endif

                <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                <td>
                    @if ($item->type == 'mp4')
                    <a href="#" class="item-edit"
                        onclick="modal({{ $item }}, '{{ asset('storage/documents/'.$item->file) }}')"
                        data-bs-toggle="modal" data-bs-target="#view"><i class="text-primary font-medium-3"
                            data-feather='eye'></i></a>
                    @else
                    <a href="#" class="item-edit iframe" onclick="modal({{ $item }},'{{ route('documents.pdf', $item->id) }}')"><i class="text-primary font-medium-3" data-feather='eye'></i></a>
                    @endif
                </td>
            </tr>

            <div class="modal fade" id="view">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                            <video src="#" controls class="video" width="100%" height="230px"></video>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

@push('js')
<script>
    function modal($data, $url) {

        url = $url
        console.log(url);

        data = $data
        title = $('.modal-title').text(data.name);

        if (data.type == 'pdf') {
            iframe = $('.iframe').attr('href', url);
        }

        if (data.type == 'mp4') {
            video = $('.video').attr('src', url);
        }
    }

</script>

@endpush

@endsection
