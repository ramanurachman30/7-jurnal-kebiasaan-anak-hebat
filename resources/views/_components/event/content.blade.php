@php
    $existingData = $existingData ?? [];
@endphp

<div class="d-flex flex-column">
    <div class="mx-4 p-3">

        <div class="row mb-3">
            <div class="col-lg-6 mb-3">
                <label class="form-label fw-semibold fs-6">Template</label>
                <select name="content_invitation[template_id]" class="form-control">
                    <option disabled selected>Pilih Template</option>
                    @foreach ($data as $template)
                        <option value="{{ $template->id }}"
                            {{ old('content_invitation.template_id', $existingData['template_id'] ?? '') == $template->id ? 'selected' : '' }}>
                            {{ $template->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="form-label fw-semibold fs-6">Title</label>
                <input type="text" name="content_invitation[title]" class="form-control"
                    placeholder="Masukkan judul undangan"
                    value="{{ old('content_invitation.title', $existingData['title'] ?? '') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Daughter</label>
                    <input type="text" name="content_invitation[daughter]" class="form-control"
                        placeholder="Nama Putri"
                        value="{{ old('content_invitation.daughter', $existingData['daughter'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Bride Father</label>
                    <input type="text" name="content_invitation[bride_father]" class="form-control"
                        placeholder="Nama Ayah Mempelai Wanita"
                        value="{{ old('content_invitation.bride_father', $existingData['bride_father'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Bride Mother</label>
                    <input type="text" name="content_invitation[bride_mother]" class="form-control"
                        placeholder="Nama Ibu Mempelai Wanita"
                        value="{{ old('content_invitation.bride_mother', $existingData['bride_mother'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Bride Date</label>
                    <input type="date" name="content_invitation[bride_date]" class="form-control"
                        value="{{ old('content_invitation.bride_date', $existingData['bride_date'] ?? '') }}">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Son</label>
                    <input type="text" name="content_invitation[son]" class="form-control" placeholder="Nama Putra"
                        value="{{ old('content_invitation.son', $existingData['son'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Groom Father</label>
                    <input type="text" name="content_invitation[groom_father]" class="form-control"
                        placeholder="Nama Ayah Mempelai Pria"
                        value="{{ old('content_invitation.groom_father', $existingData['groom_father'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Groom Mother</label>
                    <input type="text" name="content_invitation[groom_mother]" class="form-control"
                        placeholder="Nama Ibu Mempelai Pria"
                        value="{{ old('content_invitation.groom_mother', $existingData['groom_mother'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Groom Date</label>
                    <input type="date" name="content_invitation[groom_date]" class="form-control"
                        value="{{ old('content_invitation.groom_date', $existingData['groom_date'] ?? '') }}">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6 mb-3">
                <label class="form-label fw-semibold fs-6">Sound</label>
                <input type="file" name="sound" class="form-control fileupload" data-size="5000000" id="sound_file"
                    accept="*">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label class="form-label fw-semibold fs-6">Foreword</label>
                <div class="row mb-3">
                    <div class="col-lg-9 col-xl-9">
                        <div>
                            <div id="kt_docs_quill_basic_foreword" class="quill-editor min-height-250 min-height-200"
                                data-name="content_invitation[foreword]">
                                {!! !empty($existingData['forewords']) ? $existingData['forewords'] : old('content_invitation.foreword') !!}
                            </div>
                        </div>

                        <input type="hidden" name="content_invitation[foreword]" id="target-editor-content_invitation"
                            value="{{ !empty($existingData['forewords']) ? $existingData['forewords'] : old('content_invitation.foreword') }}">

                        @if ($errors->has('content_invitation.foreword'))
                            <small id="form-error-foreword" class="form-text text-danger">
                                {{ $errors->first('content_invitation.foreword') }}
                            </small>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
