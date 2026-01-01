@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {

        let table = $('#datatable-arsip').DataTable({
            pageLength: 10,
            lengthChange: true,
            ordering: true,
            searching: true,
            dom: 'lrtip'
        });

        $('#arsip-search').on('keyup', function() {
            table.search(this.value).draw();
        });

    });
</script>


@endpush