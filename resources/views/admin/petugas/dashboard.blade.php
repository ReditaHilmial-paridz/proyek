@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Data Petugas</h4>
    <div class="mb-3">
        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addPetugasModal">Tambah</button>
        <form action="{{ route('petugas.template') }}" method="GET" style="display: inline;">
        </form>
    </div>
    
    <div class="mb-3 d-flex justify-content-between">
        <input type="text" id="searchInput" class="form-control w-auto" placeholder="Search...">
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>id</th>
                    <th>nama</th>
                    <th>jabatan</th>
                    <th>kontak</th>
                    <th>email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="petugasTableBody">
                @foreach($petugas as $item)
                <tr id="row_{{ $item->id }}">
                    <td data-label="ID">{{ $loop->iteration }}</td>
                    <td data-label="Nama">{{ $item->nama }}</td>
                    <td data-label="Jabatan">{{ $item->jabatan }}</td>
                    <td data-label="Kontak">{{ $item->kontak }}</td>
                    <td data-label="Email">{{ $item->email ?? '-' }}</td>
                    <td data-label="Action">
                        <button class="btn btn-primary btn-sm me-1 edit-btn" 
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-jabatan="{{ $item->jabatan }}"
                                data-kontak="{{ $item->kontak }}"
                                data-email="{{ $item->email }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#editPetugasModal">✏️</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}">🗑️</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data Petugas -->
<div class="modal fade" id="addPetugasModal" tabindex="-1" aria-labelledby="addPetugasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0d47a1; color: white;">
                <h5 class="modal-title" id="addPetugasModalLabel">Tambah Data Petugas</h5>
            </div>
            <div class="modal-body">
                <form id="addPetugasForm" action="{{ route('petugas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kontak</label>
                        <input type="text" class="form-control" name="kontak" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data Petugas -->
<div class="modal fade" id="editPetugasModal" tabindex="-1" aria-labelledby="editPetugasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0d47a1; color: white;">
                <h5 class="modal-title" id="editPetugasModalLabel">Edit Data Petugas</h5>
            </div>
            <div class="modal-body">
                <form id="editPetugasForm">
                    @csrf
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="editJabatan" name="jabatan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="editKontak" name="kontak" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Pencarian
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#petugasTableBody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

// Tambah Data
$('#addPetugasForm').submit(function(e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: formData,
        success: function(response) {
            if(response.success) {
                const petugas = response.petugas;
                const rowCount = $('#petugasTableBody tr').length;
                const newRow = `
                    <tr id="row_${petugas.id}">
                        <td>${rowCount + 1}</td>
                        <td>${petugas.nama}</td>
                        <td>${petugas.jabatan}</td>
                        <td>${petugas.kontak}</td>
                        <td>${petugas.email || '-'}</td>
                        <td>
                            <button class="btn btn-primary btn-sm me-1 edit-btn" 
                                    data-id="${petugas.id}"
                                    data-nama="${petugas.nama}"
                                    data-jabatan="${petugas.jabatan}"
                                    data-kontak="${petugas.kontak}"
                                    data-email="${petugas.email}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editPetugasModal">✏️</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${petugas.id}">🗑️</button>
                        </td>
                    </tr>
                `;
                $('#petugasTableBody').append(newRow);
                $('#addPetugasModal').modal('hide');
                $('#addPetugasForm')[0].reset();
                alert('Data petugas berhasil ditambahkan');
            }
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

    // Isi form edit
    $(document).on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        $('#editId').val(id);
        $('#editNama').val($(this).data('nama'));
        $('#editJabatan').val($(this).data('jabatan'));
        $('#editKontak').val($(this).data('kontak'));
        $('#editEmail').val($(this).data('email'));
    });

    // Update data
    $('#editPetugasForm').submit(function(e) {
        e.preventDefault();
        const id = $('#editId').val();
        const formData = $(this).serialize();

        $.ajax({
            url: '/petugas/' + id,
            method: 'POST',
            data: formData + '&_method=PUT',
            success: function(response) {
                if(response.success) {
                    const petugas = response.petugas;
                    const row = $(`#row_${id}`);
                    row.find('td:eq(1)').text(petugas.nama);
                    row.find('td:eq(2)').text(petugas.jabatan);
                    row.find('td:eq(3)').text(petugas.kontak);
                    row.find('td:eq(4)').text(petugas.email || '-');
                    
                    // Update data attribute pada tombol edit
                    row.find('.edit-btn')
                        .data('nama', petugas.nama)
                        .data('jabatan', petugas.jabatan)
                        .data('kontak', petugas.kontak)
                        .data('email', petugas.email);
                    
                    $('#editPetugasModal').modal('hide');
                    alert('Data petugas berhasil diperbarui');
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });

// Hapus data
$(document).on('click', '.delete-btn', function() {
    const id = $(this).data('id');
    if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        $.ajax({
            url: '/petugas/' + id,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                if(response.success) {
                    $(`#row_${id}`).remove();
                    
                    // Perbarui nomor urut setelah penghapusan
                    $('#petugasTableBody tr').each(function(index) {
                        $(this).find('td:first').text(index + 1);
                    });
                    
                    alert('Data petugas berhasil dihapus');
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    }
});
});
</script>

<style>
.container {
    max-width: 100%;
    padding: 0 15px;
}

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

.table th, .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

/* Small devices (phones, 576px and up) */
@media (max-width: 576px) {
    .modal-dialog.modal-fullscreen {
        margin: 0;
        width: 100%;
        max-width: 100%;
    }
    
    .table thead {
        display: none;
    }
    
    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
    }
    
    .table tr {
        margin-bottom: 15px;
        border: 1px solid #dee2e6;
    }
    
    .table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
        border-bottom: 1px solid #dee2e6;
    }
    
    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        padding-right: 10px;
        font-weight: bold;
        text-align: left;
    }
    
    .mb-3.d-flex.justify-content-between {
        flex-direction: column;
    }
    
    #searchInput {
        width: 100% !important;
        margin-bottom: 10px;
    }
}

/* Medium devices (tablets, 768px and up) */
@media (min-width: 576px) and (max-width: 768px) {
    .table td, .table th {
        padding: 0.5rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
}

/* Add data-label attributes to td elements */
@media (max-width: 576px) {
    #petugasTableBody tr td:nth-child(1)::before { content: "ID"; }
    #petugasTableBody tr td:nth-child(2)::before { content: "Nama"; }
    #petugasTableBody tr td:nth-child(3)::before { content: "Jabatan"; }
    #petugasTableBody tr td:nth-child(4)::before { content: "Kontak"; }
    #petugasTableBody tr td:nth-child(5)::before { content: "Email"; }
    #petugasTableBody tr td:nth-child(6)::before { content: "Action"; }
    
    #petugasTableBody tr td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
    }
    
    #petugasTableBody tr td::before {
        position: static;
        width: auto;
        padding-right: 10px;
    }
    
    #petugasTableBody tr td .btn {
        margin-left: 10px;
    }
}

/* Modal adjustments for mobile */
@media (max-width: 768px) {
    .modal-content {
        border-radius: 0;
    }
    
    .modal-header {
        padding: 1rem;
    }
    
    .modal-body {
        padding: 1rem;
    }
    
    .modal-footer {
        padding: 0.75rem;
    }
    
    .form-control {
        padding: 0.375rem 0.75rem;
    }
}

/* Button spacing for mobile */
@media (max-width: 576px) {
    .mb-3 > .btn {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .mb-3 > form {
        width: 100%;
    }
    
    .mb-3 > form > .btn {
        width: 100%;
    }
}
</style>
@endsection