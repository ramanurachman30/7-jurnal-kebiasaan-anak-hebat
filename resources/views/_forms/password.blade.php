<div class="col-lg-{{ isset($data['column']) ? $data['column'] : '9' }} col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="input-group">
                {{-- <button class="btn btn-secondary" disabled>
                    <!--begin::Svg Icon | path: assets/media/icons/duotone/Interface/Calendar.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Key.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <polygon fill="currentColor" opacity="0.3" transform="translate(8.885842, 16.114158) rotate(-315.000000) translate(-8.885842, -16.114158) " points="6.89784488 10.6187476 6.76452164 19.4882481 8.88584198 21.6095684 11.0071623 19.4882481 9.59294876 18.0740345 10.9659914 16.7009919 9.55177787 15.2867783 11.0071623 13.8313939 10.8837471 10.6187476"/>
                            <path d="M15.9852814,14.9852814 C12.6715729,14.9852814 9.98528137,12.2989899 9.98528137,8.98528137 C9.98528137,5.67157288 12.6715729,2.98528137 15.9852814,2.98528137 C19.2989899,2.98528137 21.9852814,5.67157288 21.9852814,8.98528137 C21.9852814,12.2989899 19.2989899,14.9852814 15.9852814,14.9852814 Z M16.1776695,9.07106781 C17.0060967,9.07106781 17.6776695,8.39949494 17.6776695,7.57106781 C17.6776695,6.74264069 17.0060967,6.07106781 16.1776695,6.07106781 C15.3492424,6.07106781 14.6776695,6.74264069 14.6776695,7.57106781 C14.6776695,8.39949494 15.3492424,9.07106781 16.1776695,9.07106781 Z" fill="currentColor" transform="translate(15.985281, 8.985281) rotate(-315.000000) translate(-15.985281, -8.985281) "/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    <!--end::Svg Icon-->
                </button> --}}

                <button class="btn btn-secondary" type="button" onclick="togglePassword('{{ $data['name'] }}', this)">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.708zm.344-.707a6 6 0 0 1 2.306-.61V4c0-.55.45-1 1-1s1 .45 1 1v.152a6 6 0 0 1 2.306.61l.708-.708a7 7 0 0 0-1.894-.943C9.863 2.777 8.95 2.5 8 2.5s-1.863.277-2.756.61a7 7 0 0 0-1.894.943z"/>
                            <path d="m10.97 4.97-.02.022L15.99 10l-.02.022"/>
                        </svg>
                    </span>
                </button>
                <input
                type="password"
                name="{{ __($data['name']) }}"
                id="{{ $data['name'] }}"
                class="form-control"
                placeholder="{{ __(isset($data['placeholder']) ? $data['placeholder'] : $data['label']) }}"
                >

            </div>
        </div>
        <div class="col-lg-6 col-xl-6">
            <div class="input-group">
                {{-- <button class="btn btn-secondary" disabled>
                    <!--begin::Svg Icon | path: assets/media/icons/duotone/Interface/Calendar.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Key.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <polygon fill="currentColor" opacity="0.3" transform="translate(8.885842, 16.114158) rotate(-315.000000) translate(-8.885842, -16.114158) " points="6.89784488 10.6187476 6.76452164 19.4882481 8.88584198 21.6095684 11.0071623 19.4882481 9.59294876 18.0740345 10.9659914 16.7009919 9.55177787 15.2867783 11.0071623 13.8313939 10.8837471 10.6187476"/>
                            <path d="M15.9852814,14.9852814 C12.6715729,14.9852814 9.98528137,12.2989899 9.98528137,8.98528137 C9.98528137,5.67157288 12.6715729,2.98528137 15.9852814,2.98528137 C19.2989899,2.98528137 21.9852814,5.67157288 21.9852814,8.98528137 C21.9852814,12.2989899 19.2989899,14.9852814 15.9852814,14.9852814 Z M16.1776695,9.07106781 C17.0060967,9.07106781 17.6776695,8.39949494 17.6776695,7.57106781 C17.6776695,6.74264069 17.0060967,6.07106781 16.1776695,6.07106781 C15.3492424,6.07106781 14.6776695,6.74264069 14.6776695,7.57106781 C14.6776695,8.39949494 15.3492424,9.07106781 16.1776695,9.07106781 Z" fill="currentColor" transform="translate(15.985281, 8.985281) rotate(-315.000000) translate(-15.985281, -8.985281) "/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    <!--end::Svg Icon-->
                </button> --}}
                <button class="btn btn-secondary" type="button" onclick="togglePassword('password_confirmation', this)">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.708zm.344-.707a6 6 0 0 1 2.306-.61V4c0-.55.45-1 1-1s1 .45 1 1v.152a6 6 0 0 1 2.306.61l.708-.708a7 7 0 0 0-1.894-.943C9.863 2.777 8.95 2.5 8 2.5s-1.863.277-2.756.61a7 7 0 0 0-1.894.943z"/>
                            <path d="m10.97 4.97-.02.022L15.99 10l-.02.022"/>
                        </svg>
                    </span>
                </button>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    placeholder="{{ __('Password Confirmation') }}"
                >
            </div>
        </div>
    </div>
    
    @if ($errors->has($data['name']))
    <div class="mt-2">
        <small id="form-error-{{$data['name']}}" class="form-text text-danger">
            {{ $errors->first($data['name']) }}
        </small>
    </div>
    @endif
</div>

<script>
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const svgIcon = button.querySelector('svg');
    
    if (input.type === 'password') {
        // Show password
        input.type = 'text';
        // Change to eye icon (visible)
        svgIcon.innerHTML = `
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
        `;
    } else {
        // Hide password
        input.type = 'password';
        // Change to eye-slash icon (hidden)
        svgIcon.innerHTML = `
            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.708zm.344-.707a6 6 0 0 1 2.306-.61V4c0-.55.45-1 1-1s1 .45 1 1v.152a6 6 0 0 1 2.306.61l.708-.708a7 7 0 0 0-1.894-.943C9.863 2.777 8.95 2.5 8 2.5s-1.863.277-2.756.61a7 7 0 0 0-1.894.943z"/>
            <path d="m10.97 4.97-.02.022L15.99 10l-.02.022"/>
        `;
    }
}
</script>
