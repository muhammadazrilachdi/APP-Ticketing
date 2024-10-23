<!-- Semantic UI JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-users').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true
        });
    });

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Kategori",
            allowClear: false
        });
    });

    // Edit PIC
    $(document).on('click', '.edit-button', function() {
        var category_pic_id = $(this).data('category-pic-id');
        var category_id = $(this).data('category-id');
        var userId = $(this).data('user-id');

        $('#editPicModal input[name="category_pic_id"]').val(category_pic_id);
        $('#editPicModal select[name="category_id"]').val(category_id);
        $('#editPicModal select[name="user_id"]').val(userId);
        $('#editPicModal').modal('show');
    });
    // Delete PIC
    $(document).on('click', '.delete-button', function() {
        var category_pic_id = $(this).data('category-pic-id');
        var category_id = $(this).data('category-id');
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = '<?php echo site_url('admin/category/pic_delete/'); ?>' + category_pic_id + '?category_id=' + category_id;
        }
    });

    // Aktifkan PIC
    $(document).on('click', '.aktifkan-button', function() {
        var category_pic_id = $(this).data('category-pic-id');
        var category_id = $(this).data('category-id');
        window.location.href = '<?php echo site_url('admin/category/aktifkan_pic/'); ?>' + category_pic_id + '?category_id=' + category_id;
    });

    // Nonaktifkan PIC
    $(document).on('click', '.nonaktifkan-button', function() {
        var category_pic_id = $(this).data('category-pic-id');
        var category_id = $(this).data('category-id');
        window.location.href = '<?php echo site_url('admin/category/nonaktifkan_pic/'); ?>' + category_pic_id + '?category_id=' + category_id;
    });

    function fetchStatistics() {
        fetch('<?php echo site_url('dashboard/get_statistics'); ?>')
            .then(response => response.json())
            .then(data => {
                // Update konten dari setiap elemen
                document.getElementById('total-users').textContent = data.total_users;
                document.getElementById('active-tickets').textContent = data.active_tickets;
                document.getElementById('total-reports').textContent = data.total_reports;
                document.getElementById('pending-issues').textContent = data.pending_issues;
            })
            .catch(error => console.error('Error fetching statistics:', error));
    }

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

        document.getElementById('date').textContent = date;
        document.getElementById('time').textContent = time;
    }

    setInterval(updateDateTime, 1000); // Update every second
    updateDateTime(); // Initialize immediately
</script>
</body>

</html>