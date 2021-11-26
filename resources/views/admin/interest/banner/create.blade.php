@extends('layouts/contentLayoutMaster')

@section('title', 'Crear banner')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="card col-12">

        <div class="card-header d-flex justify-content-between">
            @if ($count == null)
            <h1>Crear Banner N° 1</h1>
            @else
            <h1>Crear Banner N° {{ $count->id + 1 }}</h1>
            @endif
            <a href="{{ route('banner.list')}}" class="btn btn-secondary mx-1">Volver a la lista</a>
        </div>

        <div class="card-content">
            <div class="card-body">
                <form action="{{route('banner.store')}}" id="validate" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="title"><b>Titulo</b></label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="status"><b>Estado del banner</b></label>
                                <select name="status" class="form-select custom-select" required>
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 d-flex justify-content-center my-2">
                                        <label class="btn btn-primary btn-lg btn-block" for="banner">Selecciona una
                                            imagen</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="file" name="banner" id="banner" class="form-control d-none"
                                            onchange="previewFile(this, 'photo_preview')" accept="image/*">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center p-3">
                                        <img id="photo_preview" class="img-fluid rounded" width="400px" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-1">Crear banner</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('vendor-script')
<script>
    $("#validate").validate();

    // preview imagen
    function previewFile(input, preview_id) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                $("#" + preview_id).attr('src', e.target.result);
                $("#" + preview_id).css('height', '100%');
                $("#" + preview_id).parent().parent().removeClass('d-none');
            }
            $("label[for='" + $(input).attr('id') + "']").text(input.files[0].name);
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewPersistedFile(url, preview_id) {
        $("#" + preview_id).attr('src', url);
        $("#" + preview_id).css('height', '100%');
        $("#" + preview_id).parent().parent().removeClass('d-none');
    }

</script>
@endsection