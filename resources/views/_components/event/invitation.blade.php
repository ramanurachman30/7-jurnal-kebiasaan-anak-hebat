<div class="d-flex flex-column">
    <div class="mx-4 p-3">
        <div class="row mb-4">
            <div class="col-12 mb-4">
                <div class="cs-form">
                    <input type="file" id="excelUpload" accept=".xlsx, .xls" class="form-control" onchange="handleExcelUpload(this)">
                    <label>Upload Daftar Undangan (Excel)</label>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-12">
                <div id="excelPreviewContainer" style="display:none;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Preview Data Undangan</h5>
                        <button type="button" class="btn btn-primary" onclick="showAddModal(); return false;">Tambah Data</button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="excelPreviewTable">
                            <thead>
                                <tr id="tableHeader"></tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12" id="invitationContainer">
                <!-- Invitation data fields will be added dynamically here -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="addEditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditModalLabel">Tambah Data Undangan</h5>
                <button type="button" class="close" onclick="closeModal('addEditModal'); return false;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="formFields">
                    <!-- Form fields will be added dynamically -->
                </div>
                <input type="hidden" id="editingIndex" value="-1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addEditModal'); return false;">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveData(); return false;">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" onclick="closeModal('deleteConfirmModal'); return false;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <input type="hidden" id="deleteIndex" value="-1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('deleteConfirmModal'); return false;">Batal</button>
                <button type="button" class="btn btn-danger" onclick="deleteData(); return false;">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script>
// Variabel global untuk menyimpan data
let tableData = [];
let tableHeaders = [];

// Function to handle modal closing
function closeModal(modalId) {
    $(`#${modalId}`).modal('hide');
    return false;
}

function handleExcelUpload(input) {
    const file = input.files[0];
    if (!file) return;
    
    const reader = new FileReader();
    
    reader.onload = function(e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: 'array' });
        
        // Ambil sheet pertama
        const firstSheetName = workbook.SheetNames[0];
        const worksheet = workbook.Sheets[firstSheetName];
        
        // Konversi ke JSON
        const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });
        
        if (jsonData.length > 0) {
            // Simpan data ke variabel global
            tableHeaders = jsonData[0];
            tableData = jsonData.slice(1).map(row => {
                const rowData = {};
                tableHeaders.forEach((header, index) => {
                    rowData[header] = row[index] || '';
                });
                return rowData;
            });
            
            // Update input fields
            updateInvitationFields();
            
            // Tampilkan preview tabel
            renderTable();
        } else {
            alert('File Excel tidak memiliki data.');
        }
    };
    
    reader.readAsArrayBuffer(file);
}

function renderTable() {
    if (!tableHeaders || tableHeaders.length === 0) return;
    
    // Buat header tabel
    const tableHeader = document.getElementById('tableHeader');
    tableHeader.innerHTML = '';
    
    // Tambahkan header untuk kolom data
    tableHeaders.forEach(header => {
        const th = document.createElement('th');
        th.textContent = header;
        tableHeader.appendChild(th);
    });
    
    // Tambahkan header untuk kolom aksi
    const actionTh = document.createElement('th');
    actionTh.textContent = 'Aksi';
    actionTh.style.width = '120px';
    tableHeader.appendChild(actionTh);
    
    // Buat body tabel
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';
    
    tableData.forEach((row, rowIndex) => {
        const tr = document.createElement('tr');
        
        // Tambahkan sel untuk data
        tableHeaders.forEach(header => {
            const td = document.createElement('td');
            td.textContent = row[header] || '';
            tr.appendChild(td);
        });
        
        // Tambahkan sel untuk tombol aksi
        const actionTd = document.createElement('td');
        actionTd.className = 'd-flex justify-content-between';
        
        const editBtn = document.createElement('button');
        editBtn.className = 'btn btn-sm btn-warning mr-1';
        editBtn.textContent = 'Edit';
        editBtn.type = 'button'; // Tambahkan type button
        editBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah event default
            e.stopPropagation(); // Menghentikan propagasi event
            showEditModal(rowIndex);
            return false;
        });
        
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'btn btn-sm btn-danger';
        deleteBtn.textContent = 'Hapus';
        deleteBtn.type = 'button'; // Tambahkan type button
        deleteBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah event default
            e.stopPropagation(); // Menghentikan propagasi event
            showDeleteConfirm(rowIndex);
            return false;
        });
        
        actionTd.appendChild(editBtn);
        actionTd.appendChild(deleteBtn);
        tr.appendChild(actionTd);
        
        tableBody.appendChild(tr);
    });
    
    // Tampilkan container tabel
    document.getElementById('excelPreviewContainer').style.display = 'block';
}

function updateInvitationFields() {
    const container = document.getElementById('invitationContainer');
    container.innerHTML = '';
    
    tableData.forEach((rowData, index) => {
        Object.keys(rowData).forEach(key => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `invitation[${index}][${key}]`;
            input.value = rowData[key];
            container.appendChild(input);
        });
    });
}

function showAddModal() {
    document.getElementById('addEditModalLabel').textContent = 'Tambah Data Undangan';
    document.getElementById('editingIndex').value = -1;
    
    // Buat form fields berdasarkan headers
    const formFields = document.getElementById('formFields');
    formFields.innerHTML = '';
    
    tableHeaders.forEach(header => {
        const formGroup = document.createElement('div');
        formGroup.className = 'form-group';
        
        const label = document.createElement('label');
        label.setAttribute('for', `field_${header}`);
        label.textContent = header;
        
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.id = `field_${header}`;
        input.name = header;
        
        formGroup.appendChild(label);
        formGroup.appendChild(input);
        formFields.appendChild(formGroup);
    });
    
    // Tampilkan modal
    $('#addEditModal').modal('show');
    return false;
}

function showEditModal(index) {
    document.getElementById('addEditModalLabel').textContent = 'Edit Data Undangan';
    document.getElementById('editingIndex').value = index;
    
    // Buat form fields berdasarkan headers
    const formFields = document.getElementById('formFields');
    formFields.innerHTML = '';
    
    const rowData = tableData[index];
    
    tableHeaders.forEach(header => {
        const formGroup = document.createElement('div');
        formGroup.className = 'form-group';
        
        const label = document.createElement('label');
        label.setAttribute('for', `field_${header}`);
        label.textContent = header;
        
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.id = `field_${header}`;
        input.name = header;
        input.value = rowData[header] || '';
        
        formGroup.appendChild(label);
        formGroup.appendChild(input);
        formFields.appendChild(formGroup);
    });
    
    // Tampilkan modal
    $('#addEditModal').modal('show');
    return false;
}

function saveData() {
    const index = parseInt(document.getElementById('editingIndex').value);
    const formData = {};
    
    // Ambil nilai dari semua field
    tableHeaders.forEach(header => {
        formData[header] = document.getElementById(`field_${header}`).value;
    });
    
    if (index === -1) {
        // Tambah data baru
        tableData.push(formData);
    } else {
        // Update data yang ada
        tableData[index] = formData;
    }
    
    // Update input fields dan render ulang tabel
    updateInvitationFields();
    renderTable();
    
    // Tutup modal
    $('#addEditModal').modal('hide');
    return false;
}

function showDeleteConfirm(index) {
    document.getElementById('deleteIndex').value = index;
    $('#deleteConfirmModal').modal('show');
    return false;
}

function deleteData() {
    const index = parseInt(document.getElementById('deleteIndex').value);
    
    if (index > -1) {
        tableData.splice(index, 1);
        updateInvitationFields();
        renderTable();
    }
    
    $('#deleteConfirmModal').modal('hide');
    return false;
}

// Inisialisasi data jika sudah ada input fields
window.onload = function() {
    // Cek apakah ada input invitation yang sudah ada sebelumnya
    const invitationInputs = document.querySelectorAll('input[name^="invitation["]');
    
    if (invitationInputs.length > 0) {
        // Extract data from existing inputs
        const data = {};
        
        invitationInputs.forEach(input => {
            const nameParts = input.name.match(/invitation\[(\d+)\]\[([^\]]+)\]/);
            if (nameParts && nameParts.length === 3) {
                const index = parseInt(nameParts[1]);
                const field = nameParts[2];
                
                if (!data[index]) {
                    data[index] = {};
                }
                
                data[index][field] = input.value;
            }
        });
        
        // Convert to array
        tableData = Object.values(data);
        
        if (tableData.length > 0) {
            // Extract headers
            tableHeaders = Object.keys(tableData[0]);
            renderTable();
        }
    }
};

// Mencegah form submit pada tombol di dalam tabel
document.addEventListener('DOMContentLoaded', function() {
    // Mencegah tombol dengan class btn dari men-trigger submit
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('btn')) {
            e.preventDefault();
        }
    }, true);
});
</script>