<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    @if(isset($data['options']) && is_array($data['options']))
        {{-- Multiple checkboxes readonly --}}
        @foreach ($data['options'] as $key => $option)
            <div class="form-check {{ isset($data['inline']) && $data['inline'] ? 'form-check-inline' : '' }} mb-2">
                <input class="form-check-input" 
                       type="checkbox" 
                       id="{{ $data['name'] }}_{{ $key }}_readonly" 
                       value="{{ $key }}"
                       {{ (isset($data['value']) && is_array($data['value']) && in_array($key, $data['value'])) ? 'checked' : '' }}
                       disabled readonly>
                <label class="form-check-label text-muted" for="{{ $data['name'] }}_{{ $key }}_readonly">
                    {{ __($option) }}
                </label>
            </div>
        @endforeach
    @else
        {{-- Single checkbox readonly --}}
        <div class="form-check form-switch">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="{{ $data['name'] }}_readonly" 
                   value="{{ isset($data['checkbox_value']) ? $data['checkbox_value'] : '1' }}"
                   {{ (isset($data['value']) && $data['value']) ? 'checked' : '' }}
                   disabled readonly>
            <label class="form-check-label text-muted" for="{{ $data['name'] }}_readonly">
                {{ __(isset($data['label_text']) ? $data['label_text'] : $data['label']) }}
            </label>
        </div>
    @endif
    
    @if (isset($data['info']))
        <div class="form-text">{{ __($data['info']) }}</div>
    @endif
</div> 