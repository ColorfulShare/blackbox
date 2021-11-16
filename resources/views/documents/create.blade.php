@extends('layouts/contentLayoutMaster')

@section('title', 'Crear documento')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="card col-12">

        <div class="card-header d-flex justify-content-between">
            @if ($count == null)
            <h1>Subir Documento N° 1</h1>
            @else
            <h1>Subir Documento N° {{ $count->id + 1 }}</h1>
            @endif
            <a href="{{ route('documents.list')}}" class="btn btn-secondary mx-1">Volver a la lista</a>
        </div>

        <div class="card-content">
            <div class="card-body">
                <form action="{{route('documents.store')}}" id="validate" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="name"><b>Titulo</b></label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="status"><b>Tipo de documento</b></label>
                                <select name="type" id="theSelect" class="form-select custom-select" required>
                                    <option value="pdf">pdf (solo archivo .pdf)</option>
                                    <option value="mp4">video (solo archivo .mp4)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-2 cont"></div>

                        <div class="col-12 pdf">
                            <input type="file" name="file" id="pdf" onchange="onUpload(this)"
                                class="form-control d-none" accept="application/pdf" required>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <div class=" w-75" id="display-pdf"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-1">Crear documento</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>

    // view pdf
    function onUpload(input) {

        let originalFile = input.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(originalFile);

        $("label[for='" + $(input).attr('id') + "']").text(input.files[0].name);

        // View the original file

        let originalFileURL = URL.createObjectURL(originalFile);
        $('#c_pdf').remove();
        $("#display-pdf").append(`<object data="${originalFileURL}"
        type="application/pdf" id="c_pdf" width="100%" height="850px"></object>`)
     
    };
    
    // select document
    $(document).ready(function () {

        var container = $(".cont");
        var pdf = $(".pdf");

        container.append(
            '<div class="form-group">' +
            '<div class="row d-flex justify-content-center"><div class="col-12 d-flex justify-content-center my-2"><label class="btn btn-primary btn-lg btn-block" for="pdf">Selecciona un PDF</label></div>' +
            '</div>');

        $("#theSelect").change(function () {

            var value = $("#theSelect option:selected").val();
            var container = $(".cont");

            if (value == 'mp4') {
                pdf.empty();

                container.empty();
                container.append(
                    '<div class="form-group">' +
                    '<div class="row d-flex justify-content-center"><div class="col-12 d-flex justify-content-center my-2"><label class="btn btn-primary btn-lg btn-block" for="mp4">Selecciona un video</label></div>' +
                    '<div class="col-12"><input type="file" name="file" id="mp4" class="file_multi_video form-control d-none" accept="video/mp4,video/x-m4v,video/*"></div></div>' +
                    '<div class="row"><div class="col-12 d-flex justify-content-center p-3"><video width="800" muted autoplay controls><source src="#" id="preview_vid">Your browser does not support HTML5 video.</video></div></div>' +
                    '</div>');
            }

            if (value == 'pdf') {
                container.empty();

                $('.pdf').append(
                    '<input type="file" name="file" id="pdf" onchange="onUpload(this)" class="form-control d-none" accept="application/pdf">' +
                    '<div class="row"><div class="col-12 d-flex justify-content-center"><div id="display-pdf"></div></div></div>'
                );

                container.append(
                    '<div class="form-group">' +
                    '<div class="row d-flex justify-content-center"><div class="col-12 d-flex justify-content-center my-2"><label class="btn btn-primary btn-lg btn-block" for="pdf">Selecciona un PDF</label></div>' +
                    '</div>');
            }
        });
    });

</script>
@endpush

@endsection
