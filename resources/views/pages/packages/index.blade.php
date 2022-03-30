<x-app title="Packages">
   <div class="section-header">
      <h1>Packages Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Packages</div>
      </div>
   </div>
   <div class="section-body">
      <div id="alertHere"></div>
      <div class="d-flex justify-content-between align-items-center">
         <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add New Package</button>
         <div>
            <a href="/packages/export" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i>&nbsp;Export Data</a>
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
      @include('pages.packages._modal')
   </x-slot>
   <x-slot name="script">
      <script>
      const formatNumber = (number) => {
         return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      }
      // const grid = new gridjs()
      const gridPackages = new gridjs.Grid({
         server: {
            method: 'GET',
            url: '/packages/getData',
            then: data=>data.map(item =>[
               item.nama_paket,
               item.jenis,
               formatNumber(item.harga),
               new gridjs.html(
                  `<button class='btn btn-icon btn-info btnEdit mr-1' data-toggle='modal' data-target='#editModal' data-id='${item.id}' data-nama-paket='${item.nama_paket}' data-jenis='${item.jenis}' data-harga='${item.harga}'><i class='fas fa-edit'></i></button>` +
                  `<button class="btn btn-icon btn-danger btnHapus" data-toggle="modal" data-target="#hapusModal" data-id="${item.id}" data-nama-paket="${item.nama_paket}"><i class="fas fa-trash"></i></button>`
               ),
            ]),
         },
         columns: [
            {
               name: 'Package Name',
            },
            {
               name: 'Package Type',
            },
            {
               name: 'Price',
            },
            {
               name: 'Actions',
               sort: false,
            },
         ],
         className: {
            table: 'table table-striped table-md',
            thead: 'bg-white',
            th: 'text-dark',
            search: 'float-right',
         },
         fixedHeader: true,
         sort: true,
         pagination: true,
         search: true,
         resizable: true,
      }).render(document.getElementById("wrapperTable"));

      $(function () {
         $('#wrapperTable').on('click', '.btnEdit', function() {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(3) .btnEdit').data('id')
            let nama_paket = row.find('td:eq(3) .btnEdit').data('nama-paket')
            let jenis = row.find('td:eq(3) .btnEdit').data('jenis')
            let harga = row.find('td:eq(3) .btnEdit').data('harga')

            $('#editModal #id').val(id);
            $('#editModal #nama_paket').val(nama_paket);
            $('#editModal #harga').val(harga);
            $('#editModal #jenis').val(jenis);
         })

         $('#wrapperTable').on('click', '.btnHapus', function() {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(3) .btnHapus').data('id')
            let nama = row.find('td:eq(3) .btnHapus').data('nama-paket')
            $('#hapusModal #id2').val(id)
            $('#hapusModal #namaPackage').text(nama)
         })

         $('.btnResetForm').on('click', function () {
            $('#createModal form')[0].reset()
         })

         $('#btnCreatePackage').click(function(e) {
            e.preventDefault()
            let createformdata = new FormData(document.getElementById('formCreatePackage'))
            $.ajax({
               type: 'POST',
               url: "{{ route('packages.store') }}",
               processData: false,
               contentType: false,
               data: createformdata,
               success: function(data) {
                  if(data.success) {
                        gridPackages.forceRender()
                        $('#createModal').modal('hide')
                        $('#createModal form')[0].reset()
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Create Data Package Succesfully.
                              </div>
                           </div>`
                        )
                  } else {
                     `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Create Data Package Failed.
                        </div>
                     </div>`
                  }
               }
            })
         })


         $('#btnUpdatePackage').click(function(e) {
            e.preventDefault()
            let updateformdata = new FormData(document.getElementById('formUpdatePackage'))
            $.ajax({
               type: 'POST',
               url: "{{ route('packages.update') }}",
               processData: false,
               contentType: false,
               data: updateformdata,
               success: function(data) {
                  if(data.success) {
                        gridPackages.forceRender()
                        $('#editModal').modal('hide')
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Update Data Package Succesfully.
                              </div>
                           </div>`
                        )
                  } else {
                     `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Update Data Package Failed.
                        </div>
                     </div>`
                  }
               }
            })
         })

         $('#btnDeletePackage').click(function(e) {
            e.preventDefault()
            let deleteformdata = new FormData(document.getElementById('formDeletePackage'))
            $.ajax({
               type: 'POST',
               url: "{{ route('packages.destroy') }}",
               processData: false,
               contentType: false,
               data: deleteformdata,
               success: function(data) {
                  if(data.success) {
                        gridPackages.forceRender()
                        $('#hapusModal').modal('hide')
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Delete Data Package Succesfully.
                              </div>
                           </div>`
                        )
                  } else {
                     `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Delete Data Package Failed.
                        </div>
                     </div>`
                  }
               }
            })
         })
      })
      </script>
   </x-slot>
</x-app>
