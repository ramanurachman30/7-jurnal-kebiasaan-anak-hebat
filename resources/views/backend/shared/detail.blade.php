@extends('skeleton')

@section('breadcrumbs')
    @foreach ($breadcrumbs as $key => $items)
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-600">{{ __(ucwords(str_replace('_', ' ', $items))) }}
    @endforeach
@endsection

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card card-flush h-md-100">
            <div class="card-body pt-6">
                @foreach ($forms as $form)
                    <div class="form-group row mb-8">
                        <div class="col-xl-2 col-lg-2 col-form-label text-start">
                            <label
                                class="{{ isset($form['required']) && $form['required'] == true ? 'required' : '' }} form-label">{{ __($form['label']) }}</label>
                        </div>

                        @component('_forms.' . $form['type'] . '.readonly', ['data' => $form])
                        @endcomponent
                    </div>
                @endforeach
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ url('admin/'. Request::segment(2)) }}" type="button" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('Cancel') }}
                </a>

                @if (!$isTrashed)
                    <div class="d-flex">
                        @if (Auth::allowedUri(Request::segment(2) . '.edit'))
                            <a href="{{ url('admin/'. Request::segment(2) . '/' . Request::segment(3)) . '/edit' }}" type="button"
                                class="btn btn-success me-3">
                                <i class="fas fa-pencil"></i>
                                {{ __('Update') }}
                            </a>
                        @endif
                        @if (Auth::allowedUri(Request::segment(2) . '.trash'))
                            <a data-remote="{{ url('api/admin/' . Request::segment(2) . '/' . Request::segment(3) . '/trash') }}"
                                data-tablename="{{ Request::segment(2) }}"
                                data-message="Are you sure want to delete this data ?" type="button"
                                class="btn btn-danger delete-row">
                                <i class="fas fa-trash"></i>
                                {{ __('Delete') }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
