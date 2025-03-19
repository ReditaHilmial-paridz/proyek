@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <h2>Data Siswa</h2>
        <div class="mb-3">
            <button class="btn btn-primary me-2">Tambah</button>
        <button class="btn btn-success">Import Excel</button>
        </div>
        <div class="mb-3 d-flex justify-content-between">
        <div>
          <label>Show
            <select class="form-select d-inline w-auto mx-2">
              <option>10</option>
              <option>25</option>
              <option>50</option>
            </select> entries</label>
        </div>
        <input type="text" class="form-control w-auto" placeholder="Search...">
      </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_2">✏️</button>

<div class="modal bg-body fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">SARANA PRASARANA</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="container mt-4">
    <h3>Mengedit Data Siswa</h3>
    <form >
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" v-model="siswa.nama" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <input type="text" class="form-control" v-model="siswa.status" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Masuk</label>
        <input type="date" class="form-control" v-model="siswa.tanggal_masuk" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Keluar</label>
        <input type="date" class="form-control" v-model="siswa.tanggal_keluar" />
      </div>
    </form>
  </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
                    <button type="button" class="btn btn-danger">🗑️</button>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endsection