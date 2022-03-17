<x-app title="Kurir">
   <div class="section-header">
      <h1>Kurir Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Kurir</div>
      </div>
   </div>
   <div class="section-body">
      @error('file')
         {{$message}}
      @enderror
      <div id="alertHere"></div>
      <div class="d-flex justify-content-between align-items-center">
         <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add New Kurir</button>
         {{-- <div>
            <a href="/kurir/export" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i>&nbsp;Export Data</a>
            <button class="btn btn-icon icon-left btn-info" data-toggle="modal" data-target="#importModal"><i class="fas fa-file-excel"></i>&nbsp;Import Data</butt>
         </div> --}}
      </div>
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.kurir._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const gridKurir = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/kurir/getData',
               then: data=>data.map(item =>[
                  item.nama,
                  item.tlp,
                  new gridjs.html(
                     item.jenis_kelamin == 'L' ?
                     `<span class="badge badge-sm bg-info text-white">L</span>` :
                     `<span class="badge badge-sm bg-danger text-white">P</span>`
                  ),
                  item.alamat,
                  new gridjs.html(
                     `<button class='btn btn-icon btn-info btnEdit mr-1' data-toggle='modal' data-target='#editModal' data-id='${item.id}' data-nama='${item.nama}' data-tlp='${item.tlp}' data-alamat='${item.alamat}' data-jenis-kelamin='${item.jenis_kelamin}'><i class='fas fa-edit'></i></button>` +
                     `<button class="btn btn-icon btn-danger btnHapus" data-toggle="modal" data-target="#hapusModal" data-id="${item.id}" data-nama="${item.nama}"><i class="fas fa-trash"></i></button>`
                  ),
               ]),
            },
            columns: [
               {
                  name: 'Name',
               },
               {
                  name: 'Phone Number',
               },
               {
                  name: 'Gender',
                  sort: false,
               },
               {
                  name: 'Address',
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
            search: {
               server: {
                  url: (prev, keyword) => `${prev}?search=${keyword}`
               }
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
               let id = row.find('td:eq(4) .btnEdit').data('id')
               let nama = row.find('td:eq(4) .btnEdit').data('nama')
               let jenis_kelamin = row.find('td:eq(4) .btnEdit').data('jenis-kelamin')
               let tlp = row.find('td:eq(4) .btnEdit').data('tlp')
               let alamat = row.find('td:eq(4) .btnEdit').data('alamat')

               $('#editModal #id').val(id);
               $('#editModal #nama').val(nama);
               if(jenis_kelamin == "L") {
                  $('#editModal #male2').prop('checked', true);
               } else if(jenis_kelamin == "P") {
                  $('#editModal #female2').prop('checked', true);
               }
               $('#editModal #tlp').val(tlp);
               $('#editModal #alamat').text(alamat);
            })

            $('#wrapperTable').on('click', '.btnHapus', function() {
               let row = $(this).closest('tr')
               let id = row.find('td:eq(4) .btnHapus').data('id')
               let nama = row.find('td:eq(4) .btnHapus').data('nama')
               $('#hapusModal #id2').val(id)
               $('#hapusModal #namaKurir').text(nama)
            })

            $('.btnResetForm').on('click', function () {
               $('#createModal form')[0].reset()
            })

            $('#btnCreateKurir').click(function(e) {
               e.preventDefault()
               let createformdata = new FormData(document.getElementById('formCreateKurir'))
               $.ajax({
                  type: 'POST',
                  url: "{{ route('kurir.store') }}",
                  processData: false,
                  contentType: false,
                  data: createformdata,
                  success: function(data) {
                     if(data.success) {
                           gridKurir.forceRender()
                           $('#createModal').modal('hide')
                           $('#createModal form')[0].reset()
                           $('#alertHere').html(
                              `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                                 <div class="alert-icon"><i class="fas fa-check"></i></div>
                                 <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                       <span>&times;</span>
                                    </button>
                                    Create Data Kurir Succesfully.
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
                              Create Data Kurir Failed.
                           </div>
                        </div>`
                     }
                  }
               })
            })


            $('#btnUpdateKurir').click(function(e) {
               e.preventDefault()
               let updateformdata = new FormData(document.getElementById('formUpdateKurir'))
               $.ajax({
                  type: 'POST',
                  url: "{{ route('kurir.update') }}",
                  processData: false,
                  contentType: false,
                  data: updateformdata,
                  success: function(data) {
                     if(data.success) {
                           gridKurir.forceRender()
                           $('#editModal').modal('hide')
                           $('#alertHere').html(
                              `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                                 <div class="alert-icon"><i class="fas fa-check"></i></div>
                                 <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                       <span>&times;</span>
                                    </button>
                                    Update Data Kurir Succesfully.
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
                              Update Data Kurir Failed.
                           </div>
                        </div>`
                     }
                  }
               })
            })

            $('#btnDeleteKurir').click(function(e) {
               e.preventDefault()
               let deleteformdata = new FormData(document.getElementById('formDeleteKurir'))
               $.ajax({
                  type: 'POST',
                  url: "{{ route('kurir.destroy') }}",
                  processData: false,
                  contentType: false,
                  data: deleteformdata,
                  success: function(data) {
                     if(data.success) {
                           gridKurir.forceRender()
                           $('#hapusModal').modal('hide')
                           $('#alertHere').html(
                              `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                                 <div class="alert-icon"><i class="fas fa-check"></i></div>
                                 <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                       <span>&times;</span>
                                    </button>
                                    Delete Data Kurir Succesfully.
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
                              Delete Data Kurir Failed.
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