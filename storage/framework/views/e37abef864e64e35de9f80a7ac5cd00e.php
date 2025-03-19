
<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
      <h4>Data Master Produk</h4>
      <div class="mb-3">
        <button class="btn btn-primary me-2">Export Data Produk</button>
        <button class="btn btn-success">Import Data Produk</button>
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
      
      <div class="d-flex justify-content-between">
        <span>Showing 1 to of entries</span>
        <nav>
          <ul class="pagination">
            <li class="page-item disabled"><a class="page-link">Previous</a></li>
            <li class="page-item active"><a class="page-link">1</a></li>
            <li class="page-item disabled"><a class="page-link">Next</a></li>
          </ul>
        </nav>
      </div>
    </div>

  
  <script>
  export default {
    data() {
      return {
        entries: 10,
        search: "",
        products: [
          { partNo: "P0001", partname: "Mouse Logitech", description: "Supplies", qty: "10", unit: "Unit", remark: "Consumable" },
          { partNo: "P0002", partname: "Battery AAA Alkaline", description: "Consumable", qty: "25", unit: "Pack", remark: "Supplies" }
        ]
      };
    },
    computed: {
      filteredData() {
        return this.products.filter(p =>
          Object.values(p).some(val => val.toString().toLowerCase().includes(this.search.toLowerCase()))
        );
      }
    }
  };
  </script>
  
  <style>
  .container {
    max-width: 900px;
  }
  </style>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/petugas/dashboard.blade.php ENDPATH**/ ?>