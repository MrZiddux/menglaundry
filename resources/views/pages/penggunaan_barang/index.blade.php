<x-app>
   <div class="section-header">
      <h1>Halaman Penggunaan Barang</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Penggunaan-Barang</div>
      </div>
   </div>
   <div class="section-body">
      <div id="alertHere"></div>
      <div class="d-flex justify-content-between align-items-center">
         <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Tambah Barang</button>
         <div>
            <a href="/penggunaan-barang/export" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i>&nbsp;Export Data</a>
            <button class="btn btn-icon icon-left btn-info" data-toggle="modal" data-target="#importModal"><i class="fas fa-file-excel"></i>&nbsp;Import Data</button>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.penggunaan_barang._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const grid = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/penggunaan-barang/getData',
               then: data => data.map((item, index ) => [
                  index+1,
                  item.nama_barang,
                  item.qty,
                  item.harga,
                  item.waktu_beli,
                  item.supplier,
                  new gridjs.html( `
                     <select id="selectStatus" class="form-control" data-id="${item.id}">
                        <option value="diajukan_beli" ${item.status == 'diajukan_beli' ? 'selected' : ''}>Diajukan Beli</option>
                        <option value="habis" ${item.status == 'habis' ? 'selected' : ''}>Habis</option>
                        <option value="tersedia" ${item.status == 'tersedia' ? 'selected' : ''}>Tersedia</option>
                     </select>
                  `
                  ),
                  item.updated_at,
                  new gridjs.html(
                     `<button class='btn btn-icon btn-info btnEdit mr-1' data-toggle='modal' data-target='#updateModal' data-id='${item.id}' data-nama='${item.nama_barang}' data-qty='${item.qty}' data-harga='${item.harga}' data-status='${item.status}' data-supplier="${item.supplier}"><i class='fas fa-edit'></i></button>` +
                     `<button class="btn btn-icon btn-danger btnHapus" data-toggle="modal" data-target="#hapusModal" data-id="${item.id}" data-nama="${item.nama_barang}"><i class="fas fa-trash"></i></button>`
                  ),
               ]),
            },
            columns: [
               {
                  name: 'No',
                  sort: true,
               },
               {
                  name: 'Nama Barang',
                  sort: true,
               },
               {
                  name: 'Qty',
                  sort: true,
               },
               {
                  name: 'Harga',
                  sort: true,
               },
               {
                  name: 'Waktu Beli',
                  sort: true,
               },
               {
                  name: 'Supplier',
                  sort: true,
               },
               {
                  name: 'Status',
                  sort: false,
               },
               {
                  name: 'Waktu Update Status',
                  sort: true,
               },
               {
                  name: 'Aksi',
                  sort: false,
               },
            ],
            className: {
               table: 'table table-striped table-md',
               thead: 'bg-white',
               th: 'text-dark',
               search: 'float-right',
            },
            sort: true,
            pagination: true,
            search: true,
            resizable: true,
         }).render(document.getElementById('wrapperTable'));

         $('#createForm').on('submit', function (e) {
            e.preventDefault()
            let form = new FormData(this)
            $.ajax({
               type: 'POST',
               url: '/penggunaan-barang/store',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  grid.forceRender()
                  $('#createModal').modal('hide')
                  $('#createForm')[0].reset()
                  $('#alertHere').html(
                        `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                           <div class="alert-icon"><i class="fas fa-check"></i></div>
                           <div class="alert-body">
                              <button class="close" data-dismiss="alert">
                                 <span>&times;</span>
                              </button>
                              Create Data Succesfully.
                           </div>
                        </div>`
                     )
               },
               error: function(response) {
                  $('#alertHere').html(
                     `<div class="alert alert-danger alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-times"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           ${response.responseJSON.message}
                        </div>
                     </div>`
                  )
               }
            })
         })

         $('#wrapperTable').on('click', '.btnEdit', function () {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(8) .btnEdit').data('id')
            let nama = row.find('td:eq(8) .btnEdit').data('nama')
            let qty = row.find('td:eq(8) .btnEdit').data('qty')
            let harga = row.find('td:eq(8) .btnEdit').data('harga')
            let supplier = row.find('td:eq(8) .btnEdit').data('supplier')
            let status = row.find('td:eq(8) .btnEdit').data('status')
            $('#editId').val(id)
            $('#editNamaBarang').val(nama)
            $('#editQty').val(qty)
            $('#editHarga').val(harga)
            $('#editSupplier').val(supplier)
            $('#editStatus').val(status)
         })

         $('#wrapperTable').on('click', '.btnHapus', function () {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(8) .btnHapus').data('id')
            let nama = row.find('td:eq(8) .btnHapus').data('nama')
            $('#deleteId').val(id)
            $('#deleteNamaBarang').text(nama)
         })

         $('#updateForm').on('submit', function (e) {
            e.preventDefault()
            let form = new FormData(this)
            $.ajax({
               type: 'POST',
               url: '/penggunaan-barang/update',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  grid.forceRender()
                  $('#updateModal').modal('hide')
                  $('#updateForm')[0].reset()
                  $('#alertHere').html(
                        `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                           <div class="alert-icon"><i class="fas fa-check"></i></div>
                           <div class="alert-body">
                              <button class="close" data-dismiss="alert">
                                 <span>&times;</span>
                              </button>
                              Update Data Succesfully.
                           </div>
                        </div>`
                     )
               },
               error: function(response) {
                  $('#alertHere').html(
                     `<div class="alert alert-danger alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-times"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           ${response.responseJSON.message}
                        </div>
                     </div>`
                  )
               }
            })
         })

         $('#deleteForm').on('submit', function (e) {
            e.preventDefault()
            let form = new FormData(this)
            $.ajax({
               type: 'POST',
               url: '/penggunaan-barang/destroy',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  grid.forceRender()
                  $('#hapusModal').modal('hide')
                  $('#deleteForm')[0].reset()
                  $('#alertHere').html(
                     `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Delete Data Succesfully.
                        </div>
                     </div>`
                  )
               },
               error: function(response) {
                  $('#alertHere').html(
                     `<div class="alert alert-danger alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-times"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           ${response.responseJSON.message}
                        </div>
                     </div>`
                  )
               }
            })
         })

         $(document).on('change', '#selectStatus', function () {
            let id = $(this).data('id')
            let status = $(this).val()
            $.ajax({
               type: 'POST',
               url: '/penggunaan-barang/updateStatus',
               data: {
                  _token: "{{ csrf_token() }}",
                  id: id,
                  status: status,
               },
               success: function(response) {
                  grid.forceRender()
               },
               error: function(response) {
                  response.responseJSON.message
               }
            })
         })
      </script>
   </x-slot>
</x-app>
