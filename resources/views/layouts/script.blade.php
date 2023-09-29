<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "rowCallback": function(row, data) {
                var id = data[
                    0]; // Asumsikan ID ada di kolom pertama, sesuaikan dengan struktur data Anda
                var url = "/barangs/" + id; // Format URL
                $(row).attr("data-href", url);
            }
        });

        $('#example tbody').on('click', 'tr', function() {
            var id = $(this).data('href'); // Ambil nilai 'id' dari atribut 'data-href'
            var kode_barang = $(this).data(
                'kode_barang'); // Ambil nilai 'kode_barang' dari atribut 'data-kode-barang'

            if (id) {
                window.location.href = id; // Arahkan ke rute dengan 'id' saja
            }
        });
    });
</script>
