<footer>
    <p>&copy; 2024 Management System Asset. All rights reserved.</p>
    <p1 class="powered-by">Powered by IT APP</p1>
</footer>

<!-- Semantic UI JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
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

        // Menampilkan tanggal dan waktu
        document.getElementById('date').textContent = date;
        document.getElementById('time').textContent = time;
    }

    // Panggil saat pertama kali halaman dimuat
    updateDateTime();

    // Update setiap detik
    setInterval(updateDateTime, 1000);
</script>
</body>

</html>