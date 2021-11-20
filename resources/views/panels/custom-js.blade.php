<script>
    // datatable
    $(document).ready(function () {
        $('.myTable').DataTable({
            responsive: true,
            order: [
                [0, "desc"]
            ],
            searching: true,
            bLengthChange: true,
            pageLength: 10,
        });
    });

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

    // preview video
    $(document).on("change", ".file_multi_video, #mp4", function (evt) {
        var $source = $('#preview_vid');
        $source[0].src = URL.createObjectURL(this.files[0]);
        $source.parent()[0].load();
    });

    $("#validate").validate();

</script>
