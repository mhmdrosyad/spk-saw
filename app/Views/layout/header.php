<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                <li class="nav-item">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-calendar fs-6"></i>
                        <p id="current-date" class="mb-0 fs-3" style="margin-right: 10px;"></p>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-clock fs-6"></i>
                        <p id="current-time" class="mb-0 fs-3"></p>
                    </div>
                </li>

                <!-- Tambahan item-item lain jika diperlukan -->
            </ul>
        </div>
    </nav>
</header>
<script>
    // Mendapatkan elemen jam dan tanggal
    const currentTimeElement = document.getElementById('current-time');
    const currentDateElement = document.getElementById('current-date');

    // Fungsi untuk mengupdate waktu dan tanggal secara real-time
    function updateClock() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;
        currentTimeElement.textContent = timeString;

        const year = now.getFullYear();
        const month = (now.getMonth() + 1).toString().padStart(2, '0');
        const day = now.getDate().toString().padStart(2, '0');
        const dateString = `${year}-${month}-${day}`;
        currentDateElement.textContent = dateString;
    }

    // Memanggil fungsi untuk pertama kali
    updateClock();

    // Memanggil fungsi secara berkala setiap detik (1000 milidetik)
    setInterval(updateClock, 1000);
</script>