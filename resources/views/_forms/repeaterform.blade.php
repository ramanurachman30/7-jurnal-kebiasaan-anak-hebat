<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <div class="row">
        <!--begin::Repeater-->
<div id="kt_docs_repeater_nested">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="kt_docs_repeater_nested_outer">
            <div data-repeater-item>
                <div class="mb-5 form-group row">
                    <div class="col-md-3">
                        <label class="form-label">Name:</label>
                        <input type="email" class="mb-2 form-control mb-md-0" placeholder="Enter full name" />
                    </div>
                    <div class="col-md-3">
                        <div class="inner-repeater">
                            <div data-repeater-list="kt_docs_repeater_nested_inner" class="mb-5">
                                <div data-repeater-item>
                                    <label class="form-label">Number:</label>
                                    <div class="pb-3 input-group">
                                        <input type="email" class="form-control" placeholder="Enter contact number" />
                                        <button class="border border-secondary btn btn-icon btn-light-danger" data-repeater-delete type="button">
                                            <i class="la la-trash-o fs-3"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                <i class="la la-plus"></i> Add Number
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mt-2 form-check form-check-custom form-check-solid mt-md-11">
                            <input class="form-check-input" type="checkbox" value="" id="form_checkbox" />
                            <label class="form-check-label" for="form_checkbox">
                                Primary
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="javascript:;" data-repeater-delete class="mt-3 btn btn-sm btn-light-danger mt-md-9">
                            <i class="la la-trash-o fs-3"></i>Delete Row
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group">
        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
            <i class="la la-plus"></i>Add Row
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->
    </div>
</div>

{{-- @section('customjs')
<script src="{{ asset('assets/js/custom/components/repeaterForm.js') }}"></script>
@endsection --}}