<div class="col-lg-9 col-xl-{{ $data['column'] ?? '9' }}">
    <select
        class="form-select select2ajax"
        data-model="{{ $data['options']['model'] }}"
        data-key="{{ $data['options']['key'] }}"
        data-display="{{ $data['options']['display'] }}"
        data-filter='@json($data["options"]["filter"] ?? [])'
        data-control="select2"
        data-placeholder="{{ __('Select') }} {{ ucwords(str_replace('_', ' ', $data['name'])) }}"
        name="{{ $data['name'] }}"
    >
        @php
            $val = $data['value'] ?? null;
            $key = $data['options']['key'];
            $display = $data['options']['display'];
        @endphp

        {{-- Jika value ada --}}
        @if(!empty($val))
            <option 
                value="{{ is_array($val) ? ($val[$key] ?? '') : $val }}"
                selected>
                {{ 
                    is_array($val) 
                        ? ($val[$display] ?? 'Tidak ditemukan') 
                        : 'Loading...' 
                }}
            </option>
        @endif
    </select>

    {{-- ERROR VALIDATION --}}
    @if ($errors->has($data['name']))
        <small id="form-error-{{$data['name']}}" class="form-text text-danger">
            {{ $errors->first($data['name']) }}
        </small>
    @endif
</div>
