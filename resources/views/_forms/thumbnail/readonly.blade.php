<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <?php
        $image = asset('assets/media/avatars/blank.png');
        if(!empty(old($data['name']))) {
            $img = json_decode(old($data['name']));
        }
    ?>
    <div class="image-input image-input-empty thumbnail-input" data-kt-image-input="true" style="background-image: url({{$image}})" data-url="{{ url('api/file_upload') }}" data-bucket="avatar" data-path="avatar">
        <div class="image-input-wrapper w-125px h-125px"></div>
        <label
            data-kt-image-input-action="change"
            data-bs-toggle="tooltip"
            data-bs-dismiss="click"
            title="Ganti Foto"
            readonly
        >
            <input type="hidden" name="{{ $data['name'] }}" id="{{ $data['name'] }}" value="{{ $data['value'] }}"/>
        </label>
    </div>

    @if ($errors->has($data['name']))
    <small id="form-error-{{$data['name']}}" class="form-text text-danger">
        {{ $errors->first($data['name']) }}
    </small>
    @endif
</div>

{{-- <div class="d-flex align-items-center">
    <div class="symbol symbol-50px me-3">
        <img src="{{ isset($data['file']) ? $data['file'] : "" }}" class="" alt="">
    </div>
</div> --}}
