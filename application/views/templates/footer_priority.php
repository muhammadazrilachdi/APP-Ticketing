<footer>
    <p>&copy; 2024 Management System Asset. All rights reserved.</p>
    <p1 class="powered-by">Powered by IT APP</p1>
</footer>

<!-- Semantic UI JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
    $(document).ready(function() {

        $('.ui.modal').modal();

        var deleteBaseUrl = '<?php echo site_url('admin/priority/delete/'); ?>';

        $('#openCreateModal').on('click', function() {
            $('#createTicketModal').modal('show');
        });

        $(document).on('click', '.edit-button', function() {
            var priorityId = $(this).data('priority-id');
            var priorityName = $(this).data('priority-name');

            $('#editTicketModal_' + priorityId + ' input[name="priority_id"]').val(priorityId);
            $('#editTicketModal_' + priorityId + ' input[name="name"]').val(priorityName);
            $('#editTicketModal_' + priorityId).modal('show');
        });
        $(document).on('click', '.delete-button', function() {
            var priorityId = $(this).data('priority-id');
            if (confirm('Apakah Anda yakin ingin menghapus priority ini?')) {
                window.location.href = deleteBaseUrl + priorityId;
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const masterMenu = document.getElementById('master-menu');
        const masterSubmenu = document.getElementById('master-submenu');

        // Toggle submenu visibility when the Master menu is clicked
        masterMenu.addEventListener('click', function() {
            if (masterSubmenu.style.display === "none" || masterSubmenu.style.display === "") {
                masterSubmenu.style.display = "block"; // Show the submenu
            } else {
                masterSubmenu.style.display = "none"; // Hide the submenu
            }
        });
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