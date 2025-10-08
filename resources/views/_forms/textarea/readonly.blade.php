<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <textarea class="form-control" cols="30" rows="5" readonly>{{ isset($data['value']) ? $data['value'] : "" }}</textarea>
</div>
