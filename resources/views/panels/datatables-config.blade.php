@section('page-script')
<script>
    $('.myTable').DataTable({
        responsive: true,
        order: [[ 0, "desc" ]],
    })
</script>

<script>
    $('.myTableOrdenDesc').DataTable({
        responsive: true,
        order: [0, 'desc']
    })
</script>

<script>
    $('.myTable2').DataTable({
        responsive: true,
        order: [[ 0, "desc" ]],
        searching: true,
        bLengthChange: true,
        pageLength: 10,
        language: {
            paginate: {
                next:				">",
                previous:			"<"
            },
        },
        drawCallback: function( settings ) {
            $('ul.pagination li.paginate_button.page-item.active').addClass("custom-pagination-li-active");
            $('ul.pagination li.paginate_button.page-item.active a').addClass("custom-pagination-li-active-a");
            $('ul.pagination li a').addClass("custom-pagination-li-a2");
            $('ul.pagination li.previous, ul.pagination li.next').addClass("custom-pagination-li");
            $('ul.pagination li.previous a, ul.pagination li.next a').addClass("custom-pagination-li-a");
        }
    })
</script>
@endsection
