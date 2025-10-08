<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <div class="form-check">
        <input class="form-check-input @if ($errors->has($data['name'])) is-invalid @endif" 
               type="checkbox" 
               name="{{ $data['name'] }}" 
               id="{{ $data['name'] }}" 
               value="{{ isset($data['checkbox_value']) ? $data['checkbox_value'] : '1' }}"
               {{ (isset($data['value']) && $data['value']) || old($data['name']) ? 'checked' : '' }}>
        <label class="form-check-label" for="{{ $data['name'] }}">
            {{ __(isset($data['label_text']) ? $data['label_text'] : $data['label']) }}
        </label>
    </div>
    
    @if ($errors->has($data['name']))
        <small id="form-error-{{ $data['name'] }}" class="form-text text-danger">
            {{ $errors->first($data['name']) }}
        </small>
    @endif
    
    @if (isset($data['info']))
        <div class="form-text">{{ __($data['info']) }}</div>
    @endif
</div> 