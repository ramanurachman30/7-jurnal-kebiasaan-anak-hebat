@php
    $gifts = isset($existingData) && count($existingData) > 0 ? $existingData : [null];
@endphp

<div class="d-flex flex-column">
    <div class="mx-4 p-3">
        <div id="bank-accounts-container">
            @foreach($gifts as $index => $gift)
            <div class="bank-account-form mb-4 border-bottom pb-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold fs-6">Nama Bank</label>
                        <select name="gift[{{ $index }}][bank_id]" class="form-control">
                            <option value="">Pilih Bank</option>
                            @foreach($bankAccounts as $bank)
                                <option value="{{ $bank->id }}" 
                                    {{ $gift['bank_id'] ?? '' == $bank->id ? 'selected' : '' }}>
                                    {{ $bank->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold fs-6">Nama Penerima</label>
                        <input type="text" 
                               name="gift[{{ $index }}][receiver_name]" 
                               class="form-control" 
                               placeholder="Nama Penerima" 
                               value="{{ $gift['receiver_name'] ?? '' }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold fs-6">Nomor Rekening</label>
                        <input type="text" 
                               name="gift[{{ $index }}][no_req]" 
                               class="form-control" 
                               placeholder="Nomor Rekening" 
                               value="{{ $gift['no_req'] ?? '' }}">
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeAccountItem(this)">
                            Hapus Rekening
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-start mt-2">
            <button type="button" id="add-account-btn" class="btn btn-primary btn-sm" {{ count($gifts) >= 2 ? 'style=display:none' : '' }}>
                + Tambah Rekening
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('bank-accounts-container');
    const addBtn = document.getElementById('add-account-btn');
    let accountCount = {{ count($gifts) }};
    const maxAccounts = 2;

    const selectOptions = `{!! $bankAccounts->map(fn($bank) => "<option value='{$bank->id}'>{$bank->name}</option>")->implode('') !!}`;

    const generateForm = (index) => {
        return `
        <div class="bank-account-form mb-4 border-bottom pb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold fs-6">Nama Bank</label>
                    <select name="gift[${index}][bank_id]" class="form-control">
                        <option value="">Pilih Bank</option>
                        ${selectOptions}
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold fs-6">Nama Penerima</label>
                    <input type="text" 
                           name="gift[${index}][receiver_name]" 
                           class="form-control" 
                           placeholder="Nama Penerima">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold fs-6">Nomor Rekening</label>
                    <input type="text" 
                           name="gift[${index}][no_req]" 
                           class="form-control" 
                           placeholder="Nomor Rekening">
                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeAccountItem(this)">
                        Hapus Rekening
                    </button>
                </div>
            </div>
        </div>`;
    };

    addBtn.addEventListener('click', function () {
        if (accountCount < maxAccounts) {
            container.insertAdjacentHTML('beforeend', generateForm(accountCount));
            accountCount++;

            if (accountCount >= maxAccounts) addBtn.style.display = 'none';
        }
    });
});

function removeAccountItem(button) {
    const container = document.getElementById('bank-accounts-container');
    button.closest('.bank-account-form').remove();

    const addBtn = document.getElementById('add-account-btn');
    const accountCount = container.querySelectorAll('.bank-account-form').length;
    if (accountCount < 2) addBtn.style.display = 'inline-block';
}
</script>
