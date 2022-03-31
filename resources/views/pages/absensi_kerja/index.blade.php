<x-app>
   <div class="section-header">
      <h1>Halaman Absensi Kerja</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Absensi-Kerja</div>
      </div>
   </div>
   <div class="section-body">
      <div id="alertHere"></div>
      <div class="d-flex justify-content-between align-items-center">
         <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
         <div>
            <a href="/absensi-kerja/export" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i>&nbsp;Export Data</a>
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
      @include('pages.absensi_kerja._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const grid = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/absensi-kerja/getData',
               then: data => data.map((item, index ) => [
                  index+1,
                  item.nama_karyawan,
                  item.tanggal_masuk,
                  item.waktu_masuk,
                  new gridjs.html( `
                     <select id="selectStatus" class="form-control" data-id="${item.id}">
                        <option value="masuk" ${item.status == 'masuk' ? 'selected' : ''}>Masuk</option>
                        <option value="sakit" ${item.status == 'sakit' ? 'selected' : ''}>Sakit</option>
                        <option value="cuti" ${item.status == 'cuti' ? 'selected' : ''}>Cuti</option>
                     </select>
                  `
                  ),
                  new gridjs.html(
                     item.status == 'masuk' && item.waktu_selesai == '00:00:00' ?
                     `
                        <button class="btn btn-icon icon-left btn-success btnSelesai" data-id="${item.id}" data-nama="${item.nama_karyawan}" data-toggle="modal" data-target="#selesaiModal"><i class="fas fa-check"></i>&nbsp;Selesai</button>
                     ` : item.waktu_selesai
                  ),
                  new gridjs.html(
                     `<button class='btn btn-icon btn-info btnEdit mr-1' data-toggle='modal' data-target='#updateModal' data-id='${item.id}' data-nama='${item.nama_karyawan}' data-tanggalmasuk='${item.tanggal_masuk}' data-waktumasuk='${item.waktu_masuk}' data-status='${item.status}' data-waktuselesai="${item.waktu_selesai}"><i class='fas fa-edit'></i></button>` +
                     `<button class="btn btn-icon btn-danger btnHapus" data-toggle="modal" data-target="#hapusModal" data-id="${item.id}" data-nama="${item.nama_karyawan}"><i class="fas fa-trash"></i></button>`
                  ),
               ]),
            },
            columns: [
               {
                  name: 'No',
                  sort: true,
               },
               {
                  name: 'Nama Karyawan',
                  sort: true,
               },
               {
                  name: 'Tanggal Masuk',
                  sort: true,
               },
               {
                  name: 'Waktu Masuk',
                  sort: true,
               },
               {
                  name: 'Status',
                  sort: true,
               },
               {
                  name: 'Waktu Kerja Selesai',
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
               url: '/absensi-kerja/store',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  grid.forceRender()
                  $('#createModal').modal('hide')
                  $('#createForm')[0].reset()
                  $('#createWaktuMasuk').attr('disabled', true)
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
            let id = row.find('td:eq(6) .btnEdit').data('id')
            let nama = row.find('td:eq(6) .btnEdit').data('nama')
            let tanggalmasuk = row.find('td:eq(6) .btnEdit').data('tanggalmasuk')
            $('#editId').val(id)
            $('#updateNama').val(nama)
            $('#updateTanggalMasuk').val(tanggalmasuk)
         })

         $('#wrapperTable').on('click', '.btnHapus', function () {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(6) .btnHapus').data('id')
            let nama = row.find('td:eq(6) .btnHapus').data('nama')
            $('#deleteId').val(id)
            $('#deleteNamaKaryawan').text(nama)
         })

         $('#updateForm').on('submit', function (e) {
            e.preventDefault()
            let form = new FormData(this)
            $.ajax({
               type: 'POST',
               url: '/absensi-kerja/update',
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
               url: '/absensi-kerja/destroy',
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
               url: '/absensi-kerja/updateStatus',
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

         $('#wrapperTable').on('click', '.btnSelesai', function () {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(5) .btnSelesai').data('id')
            let nama = row.find('td:eq(5) .btnSelesai').data('nama')
            $('#selesaiId').val(id)
            $('#NamaKaryawan').text(nama)
         })

         $('#selesaiForm').on('submit', function (e) {
            e.preventDefault()
            let form = new FormData(this)
            $.ajax({
               type: 'POST',
               url: '/absensi-kerja/selesai',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  grid.forceRender()
                  $('#selesaiModal').modal('hide')
                  $('#selesaiForm')[0].reset()
                  $('#alertHere').html(
                     `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Selesai Absensi Succesfully.
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

         $('#createStatus').on('change', function() {
            let val = $(this).val()
            let waktumasuk = $('#createWaktuMasuk')
            if (val == 'masuk') {
               waktumasuk.attr('disabled', false)
            } else {
               waktumasuk.attr('disabled', true)
            }
         })

         $('.btnResetForm').on('click', function() {
            $(this).closest('form')[0].reset()
         })
      </script>
   </x-slot>
</x-app>
