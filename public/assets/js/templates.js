/**
 * untuk mengatur tampilan template
 */

let initialHeight = window.innerHeight;
    
function setScreenHeight() {
    const vh = initialHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

setScreenHeight();

window.addEventListener('resize', function() {
    if (Math.abs(window.innerHeight - initialHeight) > 150) {
        initialHeight = window.innerHeight;
        setScreenHeight();
    }
});

/**
 * untuk fungsi salin rekening
 */

function copyToClipboard(elementId) {
            
    console.log(elementId);
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById(elementId).innerHTML);

    console.log(aux);


    document.body.appendChild(aux);

    aux.select();

    document.execCommand("copy");

    document.body.removeChild(aux);

    Swal.fire({
        icon: 'success',
        title: 'Berhasil disalin',
        text: 'Nomor rekening berhasil disalin!',
        showConfirmButton: false,
        timer: 1500,
        toast: true,
        position: 'top-end',
        customClass: {
            popup: 'colored-toast'
        }
    });

}

function log(){
    console.log('---')
}

/**
 * untuk fungsi animasi scroll
 */
AOS.init();


/**
 * funsi untuk menjalankan audio
 */

$('#pushupBtn').on('click', function() {
    var audio = document.getElementById("audio-player");
    audio.loop = true;
    audio.play();
});

/**
 * fungsi untuk transisi push up
 */
// Lock scroll saat overlay tampil
    function lockScroll(lock) {
        if(lock) {
            document.body.classList.add('pushup-lock');
        } else {
            document.body.classList.remove('pushup-lock');
        }
    }
    window.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('pushupOverlay');
        const btn = document.getElementById('pushupBtn');
        lockScroll(true);
        btn.addEventListener('click', function() {
            overlay.classList.add('pushup-hide');
            lockScroll(false);
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 600); // tunggu animasi selesai
        });
    });// Lock scroll saat overlay tampil
    function lockScroll(lock) {
        if(lock) {
            document.body.classList.add('pushup-lock');
        } else {
            document.body.classList.remove('pushup-lock');
        }
    }
    window.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('pushupOverlay');
        const btn = document.getElementById('pushupBtn');
        lockScroll(true);
            btn.addEventListener('click', function() {
            overlay.classList.add('pushup-hide');
            lockScroll(false);
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 600); // tunggu animasi selesai
        });
    });
