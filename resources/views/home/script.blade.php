<script type="text/javascript">
    let calendar;

    $(document).ready(function(){
        // Konfigurasi kalender
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                right   : 'prev,next',
                center  : 'title',
                left    : null,
            },
            locale: 'id',
            initialView: 'dayGridMonth',
            events: [], // Tetapkan event di sini
        });
        calendar.render();

        // Konfigurasi DataTable
        $('.table-schedule').DataTable({
            language: {
                paginate: {
                    next: '<i class="bi bi-arrow-right"></i>',
                    previous: '<i class="bi bi-arrow-left"></i>',
                },
                emptyTable: "Data tidak ditemukan",
            },
        });

        // Trigger tombol edit jadwal
        $('.btn-edit').on('click', function() {
            let id = $(this).data('id');
            // Panggil API untuk mendapatkan data jadwal berdasarkan ID
            $.get("{{ route('event.get-selected-data') }}", { id: id }, function(data) {
                $('#edit_id').val(data.id);
                $('#edit_name').val(data.name);
                $('#edit_start_date').val(data.start_date);
                $('#edit_end_date').val(data.end_date);
            });
        });
    });
</script>
