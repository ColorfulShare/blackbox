@push('custom_js')
<script>
    $('.myTable').DataTable({
        order: [[ 0, "desc" ]],
        responsive: true,
        searching: false,
        bLengthChange: true,
        pageLength: 10
    })
</script>
@endpush