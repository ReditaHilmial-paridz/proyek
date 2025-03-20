@extends('layouts.app')
@section('content')
    <div class="container mt-4">
      <h4>Data Master Produk</h4>
      <div class="mb-3">
        <button class="btn btn-primary me-2">Tambah</button>
      </div>
      
      <div class="mb-3 d-flex justify-content-between">
        <div>
          <label>Show
            <select v-model="entries" class="form-select d-inline w-auto mx-2">
              <option>10</option>
              <option>25</option>
              <option>50</option>
            </select> entries</label>
        </div>
        <input type="text" v-model="search" class="form-control w-auto" placeholder="Search...">
      </div>
      
      <table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th>Part No</th>
            <th>Partname</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Remark</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in filteredData" :key="index">
            <td>tes</td>
            <td>tes</td>
            <td>tes</td>
            <td>tes</td>
            <td>tes</td>
            <td>tes</td>
            <td>
              <button class="btn btn-success btn-sm me-1">📄</button>
              <button class="btn btn-primary btn-sm me-1">✏️</button>
              <button class="btn btn-danger btn-sm">🗑️</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  
  <style>
  .container {
    max-width: 900px;
  }
  </style>
  @endsection