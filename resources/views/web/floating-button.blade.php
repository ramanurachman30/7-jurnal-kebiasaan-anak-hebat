<div class="floating-container">
    <div class="floating-button bg-blue shadow">
        <img src="{{ asset('assets/frontend/image/sosmed/share.png') }}" alt="" width="24">
    </div>
    <div class="element-container">
        <a href="{{ shareLink('facebook') }}" target="_blank">
            <span class="float-element bg-green shadow">
                <img src="{{ asset('assets/frontend/image/sosmed/facebook.png') }}" alt="" width="24">
            </span>
        </a>
        <a href="{{ shareLink('twitter') }}" target="_blank">
            <span class="float-element bg-green shadow">
                <img src="{{ asset('assets/frontend/image/sosmed/twitter.png') }}" alt="" width="24">
            </span>
        </a>
        <a href="{{ shareLink('linkedin') }}" target="_blank">
            <span class="float-element bg-green shadow">
                <img src="{{ asset('assets/frontend/image/sosmed/linkedin.png') }}" alt="" width="24">
            </span>
        </a>
    </div>
</div>
