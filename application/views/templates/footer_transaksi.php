<!-- Semantic UI JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                placement: 'right' // Mengatur posisi tooltip di sebelah kanan
            });
        });
    });
    document.getElementById('transactionForm').addEventListener('submit', function(event) {
        const fields = this.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        fields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('error'); // Menambahkan kelas error untuk styling
                alert('Semua field wajib diisi!');
            } else {
                field.classList.remove('error'); // Menghapus kelas error jika sudah diisi
            }
        });

        if (!isValid) {
            event.preventDefault(); // Mencegah form untuk disubmit jika tidak valid
        }
    });

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Kategori",
            allowClear: false
        });
    });

    $(document).ready(function() {
        $('#table-users').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true
        });
    });

    $(document).ready(function() {
        $('#requestTable').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true
        });
    });

    $(document).ready(function() {
        $('.ui.modal').modal();

        $('#openCreateModal').on('click', function() {
            $('#createTransaksiModal').modal('show');
        });

        $('.menu .item')
            .tab();

        $(document).on('click', '.edit-button', function() {
            var requestId = $(this).data('request-id');
            var topic = $(this).data('request-topic');
            var resource = $(this).data('request-resource');
            var categoryName = $(this).data('category-name');
            var priorityName = $(this).data('priority-name');
            var statusName = $(this).data('status-name');
            var user_id_request = $(this).data('user_id_request');

            $('#editTransaksiModal_' + requestId + ' input[name="topic"]').val(topic);
            $('#editTransaksiModal_' + requestId + ' textarea[name="resource"]').val(resource);
            $('#editTransaksiModal_' + requestId + ' input[name="category_name"]').val(categoryName);
            $('#editTransaksiModal_' + requestId + ' input[name="priority_name"]').val(priorityName);
            $('#editTransaksiModal_' + requestId + ' input[name="status_name"]').val(statusName);
            $('#editTransaksiModal_' + requestId + ' input[name="user_id_request"]').val(user_id_request);
            $('#editTransaksiModal_' + requestId).modal('show');
        });

        $(document).on('click', '.delete-button', function() {
            var requestId = $(this).data('request-id');
            if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                window.location.href = '<?php echo site_url('admin/transaksi/delete/'); ?>' + requestId;
            }
        });
    });

    $('.item[data-tab="second"]').on('click', function() {
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('admin/transaksi/get_transaksi_by_status'); ?>',
            data: {
                status: 'Selesai'
            },
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<tr>';
                    html += '<td>' + value.request_id + '</td>';
                    html += '<td>' + value.category_id + '</td>';
                    html += '<td>' + value.priority_id + '</td>';
                    html += '<td>' + value.topic + '</td>';
                    html += '<td>' + value.description + '</td>';
                    html += '<td>' + value.feedback + '</td>';
                    html += '</tr>';
                });
                $('table[data-tab="second"] tbody').html(html);
            }
        });
    });

    $('.item[data-tab="first"]').on('click', function() {
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('admin/transaksi/get_transaksi_by_status'); ?>',
            data: {
                status: 'Menunggu Antrean'
            },
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<tr>';
                    html += '<td>' + value.request_id + '</td>';
                    html += '<td>' + value.category_id + '</td>';
                    html += '<td>' + value.priority_id + '</td>';
                    html += '<td>' + value.topic + '</td>';
                    html += '<td>' + value.description + '</td>';
                    html += '<td>' + value.feedback + '</td>';
                    html += '</tr>';
                });
                $('#table-menunggu-antrean').html(html);
            }
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('admin/transaksi/get_transaksi_by_status'); ?>',
            data: {
                status: 'Sedang Diproses'
            },
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<tr>';
                    html += '<td>' + value.request_id + '</td>';
                    html += '<td>' + value.category_id + '</td>';
                    html += '<td>' + value.priority_id + '</td>';
                    html += '<td>' + value.topic + '</td>';
                    html += '<td>' + value.description + '</td>';
                    html += '<td>' + value.feedback + '</td>';
                    html += '</tr>';
                });
                $('#table-sedang-diproses').html(html);
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const masterMenu = document.getElementById('master-menu');
        const masterSubmenu = document.getElementById('master-submenu');

        masterMenu.addEventListener('click', function() {
            if (masterSubmenu.style.display === "none" || masterSubmenu.style.display === "") {
                masterSubmenu.style.display = "block";
            } else {
                masterSubmenu.style.display = "none";
            }
        });
    });

    function updateDateTime() {
        const now = new Date();

        // Format tanggal
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const date = now.toLocaleDateString('id-ID', options); // Menggunakan format tanggal Indonesia

        // Format waktu
        const time = now.toLocaleTimeString('id-ID'); // Menggunakan format waktu Indonesia

        // Menampilkan tanggal dan waktu
        document.getElementById('date').textContent = date;
        document.getElementById('time').textContent = time;
    }

    // Panggil saat pertama kali halaman dimuat
    updateDateTime();

    // Update setiap detik
    setInterval(updateDateTime, 1000);

    function confirmLogout(event) {
        event.preventDefault(); // Prevent the default anchor action
        $('#logout-message').fadeIn(); // Show the logout confirmation
    }
    // Panggil fungsi fetchStatistics saat halaman dimuat
    window.onload = function() {
        fetchStatistics();
    };

    // Jika ingin diperbarui secara berkala, gunakan setInterval
    setInterval(fetchStatistics, 5000); // Update setiap 5 detik

    // Perbarui statistik setiap 5 detik
    setInterval(fetchStatistics, 5000);

    // Panggil saat pertama kali halaman dimuat
    fetchStatistics();
</script>
</body>

</html>