<body>
    <div class="top-bar">
        <div class="sidebar-text">Management System Ticketing</div>
        <div class="date-time">
            <p id="date"></p>
            <div class="separator"></div>
            <p id="time"></p>
            <div class="separator"></div>
        </div>
    </div>

    <script>
        function updateDateTime() {
            const now = new Date();

            // Format tanggal
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const date = now.toLocaleDateString('id-ID', options); // Format tanggal Indonesia

            // Format waktu
            const time = now.toLocaleTimeString('id-ID'); // Format waktu Indonesia

            // Menampilkan tanggal dan waktu
            document.getElementById('date').textContent = date;
            document.getElementById('time').textContent = time;
        }

        // Panggil saat pertama kali halaman dimuat
        updateDateTime();

        // Update setiap detik
        setInterval(updateDateTime, 1000);
    </script>