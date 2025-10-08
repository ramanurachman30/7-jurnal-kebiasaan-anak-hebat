// Ambil URL saat ini
var currentUrl = window.location.href;

// Daftar tautan menu dropdown
var menuLinks = document.querySelectorAll('.dropdown-item');

// Loop melalui tautan menu
menuLinks.forEach(function (link) {
    // Ambil URL tautan
    var linkUrl = link.getAttribute('href');

    // Periksa apakah URL saat ini mengandung bagian URL tautan
    if (currentUrl.includes(linkUrl)) {
        // Jika mengandung, tambahkan kelas "active-dropdown" pada tautan
        link.classList.add('active-dropdown');
    }
});