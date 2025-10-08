@extends('skeleton')

@section('meta')
@endsection

@section('toolbar')
    <h1>adsfadf</h1>
@endsection

@section('content')
    <div class="card card-flush h-md-100">
        <div class="card-header pt-7">
            <h1>QR Code Scanner</h1>
        </div>
        <div class="card-body pt-6">
            <form method="POST" action="{{ url(Request::segment(1) . '/' . Request::segment(2) .'/' . Request::segment(3) .'/present') }}" id="qrForm">
                @method('PUT')
                @csrf
                
                <!-- Mode Selection Buttons -->
                <div class="mb-4 d-flex justify-content-center">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary active" id="deviceScannerBtn">
                            <i class="fas fa-barcode"></i> Scanner Fisik
                        </button>
                        <button type="button" class="btn btn-secondary" id="manualInputBtn">
                            <i class="fas fa-keyboard"></i> Input Manual
                        </button>
                        <button type="button" class="btn btn-secondary" id="cameraScanBtn">
                            <i class="fas fa-camera"></i> Scan Kamera
                        </button>
                    </div>
                </div>
                
                <!-- Device Scanner Mode (Default) -->
                <div id="deviceScannerMode" class="scan-mode">
                    <div class="text-center mb-4">
                        <img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExZzNtbHZ0YTN6czR2OTc4NjlxbjluYW95ODFqZWUwdDBxcnBseW1sZyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/n7jJHpcyk3YbucKskD/giphy.gif" alt="Scanner Device" 
                              class="img-fluid">
                        <h4 class="mt-3">Scanner Fisik Aktif</h4>
                        <p class="text-muted">Arahkan scanner fisik ke QR code untuk memindai</p>
                    </div>
                    <div class="mb-3" style="opacity:0; position:absolute; left:-9999px;">
                        <input type="text" class="form-control" id="qr_code" name="qr_code" autofocus>
                    </div>
                </div>
                
                <!-- Manual Input Mode -->
                <div id="manualInputMode" class="scan-mode" style="display: none;">
                    <div class="mb-3">
                        <label for="manual_qr_code" class="form-label">Masukkan Kode QR Secara Manual:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="manual_qr_code">
                            <button type="button" class="btn btn-primary" id="submitManualBtn">Submit</button>
                        </div>
                    </div>
                </div>
                
                <!-- Camera Scan Mode -->
                <div id="cameraScanMode" class="scan-mode" style="display: none;">
                    <div class="mb-3">
                        <div id="reader" style="width: 100%; max-width: 500px; margin: 0 auto;"></div>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-danger" id="closeScanner">
                                <i class="fas fa-times"></i> Tutup Scanner
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('customjs')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const form = document.getElementById('qrForm');
            const qrCodeInput = document.getElementById('qr_code');
            const manualQrInput = document.getElementById('manual_qr_code');
            
            // Mode elements
            const deviceScannerMode = document.getElementById('deviceScannerMode');
            const manualInputMode = document.getElementById('manualInputMode');
            const cameraScanMode = document.getElementById('cameraScanMode');
            
            // Buttons
            const deviceScannerBtn = document.getElementById('deviceScannerBtn');
            const manualInputBtn = document.getElementById('manualInputBtn');
            const cameraScanBtn = document.getElementById('cameraScanBtn');
            const submitManualBtn = document.getElementById('submitManualBtn');
            const closeScanner = document.getElementById('closeScanner');
            
            let html5QrCode = null;
            let isScanning = false;
            
            // Function to switch between modes
            function switchMode(mode) {
                // Hide all modes
                deviceScannerMode.style.display = 'none';
                manualInputMode.style.display = 'none';
                cameraScanMode.style.display = 'none';
                
                // Reset active state
                deviceScannerBtn.classList.remove('active', 'btn-primary');
                deviceScannerBtn.classList.add('btn-secondary');
                manualInputBtn.classList.remove('active', 'btn-primary');
                manualInputBtn.classList.add('btn-secondary');
                cameraScanBtn.classList.remove('active', 'btn-primary');
                cameraScanBtn.classList.add('btn-secondary');
                
                // Show selected mode
                if (mode === 'device') {
                    deviceScannerMode.style.display = 'block';
                    deviceScannerBtn.classList.remove('btn-secondary');
                    deviceScannerBtn.classList.add('active', 'btn-primary');
                    qrCodeInput.focus(); // Auto focus for scanner device
                    console.log('masuk sini ', qrCodeInput)
                } else if (mode === 'manual') {
                    manualInputMode.style.display = 'block';
                    manualInputBtn.classList.remove('btn-secondary');
                    manualInputBtn.classList.add('active', 'btn-primary');
                    manualQrInput.focus(); // Auto focus for manual input
                } else if (mode === 'camera') {
                    cameraScanMode.style.display = 'block';
                    cameraScanBtn.classList.remove('btn-secondary');
                    cameraScanBtn.classList.add('active', 'btn-primary');
                    startCameraScanner();
                }
            }
            
            // Initialize HTML5 QR Scanner
            function initQrScanner() {
                if (!html5QrCode) {
                    html5QrCode = new Html5Qrcode("reader");
                }
            }
            
            // Start camera scanner
            function startCameraScanner() {
                initQrScanner();
                
                if (!isScanning) {
                    const qrBoxSize = Math.min(window.innerWidth, 250);
                    
                    html5QrCode.start(
                        { facingMode: "environment" },
                        {
                            fps: 10,
                            qrbox: qrBoxSize
                        },
                        (decodedText) => {
                            qrCodeInput.value = decodedText;
                            stopCameraScanner();
                            form.submit();
                        },
                        (errorMessage) => {
                            console.log(errorMessage);
                        }
                    ).catch((err) => {
                        console.log(`Unable to start scanning: ${err}`);
                    });
                    
                    isScanning = true;
                }
            }
            
            // Stop camera scanner
            function stopCameraScanner() {
                if (isScanning && html5QrCode) {
                    html5QrCode.stop().then(() => {
                        isScanning = false;
                    }).catch((err) => {
                        console.log(`Error stopping scanner: ${err}`);
                    });
                }
            }
            
            // Event Listeners for mode selection
            deviceScannerBtn.addEventListener('click', () => switchMode('device'));
            manualInputBtn.addEventListener('click', () => switchMode('manual'));
            cameraScanBtn.addEventListener('click', () => switchMode('camera'));
            
            // Submit manual input
            submitManualBtn.addEventListener('click', () => {
                qrCodeInput.value = manualQrInput.value;
                if (manualQrInput.value.trim() !== '') {
                    form.submit();
                }
            });
            
            // Close camera scanner
            closeScanner.addEventListener('click', () => {
                stopCameraScanner();
                switchMode('device'); // Return to default mode
            });
            
            // Handle device scanner input
            qrCodeInput.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    form.submit();
                }
            });
            
            // Handle 'Enter' key in manual input
            manualQrInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    qrCodeInput.value = this.value;
                    if (this.value.trim() !== '') {
                        form.submit();
                    }
                }
            });
            
            // Initialize with device scanner mode
            switchMode('device');
        });
    </script>
@endsection