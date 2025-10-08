<!-- Mobile Emulator Preview Component -->
<div class="mobile-emulator-container mt-4">
    <div class="d-flex justify-content-center">
        <div class="mobile-device">
            <!-- Device Header -->
            <div class="device-header">
                <div class="device-notch"></div>
            </div>
            
            <!-- Device Screen -->
            <div class="device-screen">
                <iframe id="template-preview-frame" src="{{ url('/template1') }}" frameborder="0" width="100%" height="100%"></iframe>
            </div>
            
            <!-- Device Footer -->
            <div class="device-footer">
                <div class="home-button"></div>
            </div>
        </div>
    </div>
</div>

<!-- CSS untuk mobile emulator -->
<style>
    .mobile-device {
        width: 320px;
        height: 650px;
        background-color: #111;
        border-radius: 40px;
        position: relative;
        overflow: hidden;
        border: 8px solid #111;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
    
    .device-header {
        height: 40px;
        background-color: #111;
        position: relative;
    }
    
    .device-notch {
        width: 150px;
        height: 25px;
        background-color: #111;
        border-radius: 0 0 15px 15px;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .device-screen {
        height: 570px;
        background-color: #fff;
        overflow: hidden;
    }
    
    .device-footer {
        height: 40px;
        background-color: #111;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .home-button {
        width: 40px;
        height: 4px;
        background-color: #333;
        border-radius: 2px;
    }
    
    #template-preview-frame {
        width: 100%;
        height: 100%;
        border: none;
    }
</style>