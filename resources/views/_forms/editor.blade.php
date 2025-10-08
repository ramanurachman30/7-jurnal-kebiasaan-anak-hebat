<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <div>
        <div id="kt_docs_quill_basic_{{ $data['name'] }}" class="quill-editor min-height-250 min-height-200"
            data-name="{{ $data['name'] }}">
            <?php echo !empty($data['value']) ? $data['value'] : old($data['name']); ?>
        </div>
    </div>
    <input type="hidden" name="{{ $data['name'] }}" id="target-editor-{{ $data['name'] }}"
        value="{{ !empty($data['value']) ? $data['value'] : old($data['name']) }}">

    @if (isset($data['info']))
        <div class="form-text">{{ $data['info'] }}</div>
    @endif

    @if ($errors->has($data['name']))
        <small id="form-error-{{ $data['name'] }}" class="form-text text-danger">
            {{ $errors->first($data['name']) }}
        </small>
    @endif
</div>
