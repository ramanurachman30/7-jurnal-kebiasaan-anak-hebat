<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang | QR Check-in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }
        
        .welcome-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .welcome-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background-color: #fff;
            position: relative;
        }
        
        .header-section {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            padding: 30px;
            color: white;
            text-align: center;
        }
        
        .guest-name {
            font-size: 48px;
            font-weight: 700;
            margin: 20px 0;
            animation: fadeIn 1s ease-in-out;
        }
        
        .welcome-message {
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .checkmark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            background-color: white;
            border-radius: 50%;
            margin-bottom: 20px;
            animation: scaleIn 0.5s ease-in-out;
        }
        
        .checkmark i {
            color: #4CAF50;
            font-size: 60px;
        }
        
        .info-section {
            padding: 30px;
            text-align: center;
        }
        
        .timestamp {
            color: #6c757d;
            font-size: 16px;
            margin-top: 20px;
        }
        
        .welcome-note {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
            font-style: italic;
            color: #555;
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f00;
            animation: confetti 5s ease-in-out infinite;
            opacity: 0;
        }
        
        .waiting-message {
            padding: 50px 20px;
            text-align: center;
            color: #6c757d;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes scaleIn {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }
        
        @keyframes confetti {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="container welcome-container">
        <div class="welcome-card" id="welcome-card">
            <!-- Tampilan saat menunggu tamu scan -->
            <div id="waiting-display" class="waiting-message">
                <i class="fas fa-qrcode fa-3x mb-3"></i>
                <h3>Menunggu Tamu...</h3>
                <p>Halaman ini akan menampilkan sambutan ketika tamu melakukan scan QR code.</p>
            </div>
            
            <!-- Tampilan setelah tamu scan -->
            <div id="guest-display" style="display: none;">
                <div class="header-section">
                    <div class="checkmark">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="welcome-message">Selamat Datang</div>
                    <div class="guest-name" id="guest-name">Nama Tamu</div>
                </div>
                
                <div class="info-section">
                    <h4>Check-in Berhasil</h4>
                    <p>Terima kasih telah hadir pada acara kami.</p>
                    
                    <div class="welcome-note">
                        Kami sangat senang Anda bergabung dengan kami hari ini. 
                        Semoga Anda menikmati acara yang telah kami siapkan.
                    </div>
                    
                    <div class="timestamp" id="timestamp"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Create confetti effect
        function createConfetti() {
            const confettiCount = 100;
            const colors = ['#f94144', '#f3722c', '#f8961e', '#f9c74f', '#90be6d', '#43aa8b', '#577590'];
            const container = document.querySelector('.welcome-card');
            
            for(let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = -10 + 'px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = Math.random() * 10 + 5 + 'px';
                confetti.style.animationDelay = Math.random() * 3 + 's';
                confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
                container.appendChild(confetti);
            }
        }
        
        // Format timestamp
        function formatDateTime(date) {
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return date.toLocaleDateString('id-ID', options);
        }
        
        // Setup Pusher
        Pusher.logToConsole = true;
        const pusher = new Pusher('f0cd3f8abf6ecb1bbcb2', {
            cluster: 'ap1'
        });
        
        const channel = pusher.subscribe('qr-listerner');
        channel.bind('lutfiganteng123', function(data) {
            console.log('Data diterima:', data);
            
            // Update UI dengan nama tamu
            document.getElementById('guest-name').textContent = data.name || 'Tamu';
            document.getElementById('timestamp').textContent = 'Check-in pada: ' + formatDateTime(new Date());
            
            // Sembunyikan tampilan menunggu, tampilkan tampilan tamu
            document.getElementById('waiting-display').style.display = 'none';
            document.getElementById('guest-display').style.display = 'block';
            
            // Tambahkan efek konfeti
            createConfetti();
            
            // Auto-reset setelah 30 detik
            setTimeout(() => {
                document.getElementById('waiting-display').style.display = 'block';
                document.getElementById('guest-display').style.display = 'none';
                
                // Hapus konfeti
                document.querySelectorAll('.confetti').forEach(el => el.remove());
            }, 30000);
        });
    </script>
</body>
</html>