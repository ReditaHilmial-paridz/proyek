@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Search Bar & Tambah Button -->
    <form action="{{ route('fasilitas.index') }}" method="GET" id="searchForm">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" name="search" class="form-control w-25" placeholder="Search..." value="{{ request('search') }}" />
            <button type="button" class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#tambahFasilitasModal">
                + Tambah
            </button>
        </div>
    </form>

    <!-- Modal Tambah Fasilitas -->
    <div class="modal fade" id="tambahFasilitasModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="fasilitasForm" action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Tambah Fasilitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Fasilitas</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Fasilitas" required />
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Kategori" required />
                        </div>
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <input type="text" name="kondisi" id="kondisi" class="form-control" placeholder="Kondisi" required />
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi" required />
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="uploadImage" class="form-label">Gambar Fasilitas</label>
                            <input type="file" name="gambar" id="uploadImage" class="form-control" accept="image/*" required />
                            <div class="mt-2" id="imagePreviewContainer" style="display: none;">
                                <img id="imagePreview" class="img-thumbnail" style="max-width: 200px;" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="submitBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Fasilitas -->
    <div class="modal fade" id="editFasilitasModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editFasilitasForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Fasilitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama Fasilitas</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_kategori" class="form-label">Kategori</label>
                            <input type="text" name="kategori" id="edit_kategori" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_kondisi" class="form-label">Kondisi</label>
                            <input type="text" name="kondisi" id="edit_kondisi" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" id="edit_lokasi" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="edit_deskripsi" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_gambar" class="form-label">Gambar Fasilitas</label>
                            <input type="file" name="gambar" id="edit_gambar" class="form-control" accept="image/*" />
                            <div class="mt-2" id="editImagePreviewContainer">
                                <img id="editImagePreview" class="img-thumbnail" style="max-width: 200px;" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kartu Fasilitas -->
    <div class="row">
        @foreach($fasilitas as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset($item->gambar) }}" class="card-img-top img-fluid" alt="Gambar Fasilitas" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $item->nama }}</h5>
                    <p class="mb-1"><strong>Kategori:</strong> {{ $item->kategori }}</p>
                    <p class="mb-1"><strong>Kondisi:</strong> {{ $item->kondisi }}</p>
                    <p class="mb-1"><strong>Lokasi:</strong> {{ $item->lokasi }}</p>
                    <p class="mb-1"><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
                    <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editFasilitasModal">
                        <i class="bi bi-pencil"></i>
                    </button>
                        <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.card {
    border-radius: 12px;
    transition: transform 0.2s ease-in-out;
}
.card:hover {
    transform: scale(1.03);
}
.spinner-border {
    vertical-align: middle;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Handle tombol edit
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const fasilitasId = this.getAttribute('data-id');
        
        fetch(`/fasilitas/${fasilitasId}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_nama').value = data.nama;
                document.getElementById('edit_kategori').value = data.kategori;
                document.getElementById('edit_kondisi').value = data.kondisi;
                document.getElementById('edit_lokasi').value = data.lokasi;
                document.getElementById('edit_deskripsi').value = data.deskripsi;
                
                // Set preview gambar
                if (data.gambar) {
                    document.getElementById('editImagePreview').src = `/${data.gambar}`;
                    document.getElementById('editImagePreviewContainer').style.display = 'block';
                }
                
                // Set action form
                document.getElementById('editFasilitasForm').action = `/fasilitas/${data.id}`;
            });
    });
});

// Handle preview gambar edit
document.getElementById("edit_gambar")?.addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const preview = document.getElementById("editImagePreview");
        preview.src = URL.createObjectURL(file);
        document.getElementById("editImagePreviewContainer").style.display = "block";
    }
});

// Handle form edit submission
const editForm = document.getElementById('editFasilitasForm');
if (editForm) {
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memperbarui...';
        submitBtn.disabled = true;
        
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-HTTP-Method-Override': 'PUT'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editFasilitasModal'));
            modal.hide();
            alert('Data berhasil diperbarui');
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan saat memperbarui data');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Preview gambar
    document.getElementById("uploadImage")?.addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const preview = document.getElementById("imagePreview");
            preview.src = URL.createObjectURL(file);
            document.getElementById("imagePreviewContainer").style.display = "block";
        }
    });

    // Handle form submission
    const fasilitasForm = document.getElementById('fasilitasForm');
    if (fasilitasForm) {
        fasilitasForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
            submitBtn.disabled = true;
            
            // Prepare form data
            const formData = new FormData(fasilitasForm);
            
            // AJAX request
            fetch(fasilitasForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('tambahFasilitasModal'));
                modal.hide();
                
                // Show success message
                alert('Data berhasil disimpan');
                
                // Reset form
                fasilitasForm.reset();
                document.getElementById('imagePreviewContainer').style.display = 'none';
                
                // Reload page to show new data
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Terjadi kesalahan saat menyimpan data');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
});
</script>
@endsection