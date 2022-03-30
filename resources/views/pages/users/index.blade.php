<x-app title="Users">
   <div class="section-header">
      <h1>Halaman Kelola User</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Users</div>
      </div>
   </div>
   <div class="section-body">
      <div id="alertHere"></div>
      <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add New User</button>
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.users._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const grid = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/users/getData',
               then: data => data.map((item, index) => [
                  index+1,
                  item.nama,
                  item.tlp,
                  item.username,
                  item.outlet.nama,
                  new gridjs.html(
                     `<button class='btn btn-icon btn-info btnEdit mr-1' data-toggle='modal' data-target='#updateModal' data-id='${item.id}' data-nama='${item.nama}' data-tlp='${item.tlp}' data-alamat='${item.alamat}' data-username='${item.username}' data-role="${item.role}" data-idoutlet="${item.id_outlet}"><i class='fas fa-edit'></i></button>` +
                     `<button class="btn btn-icon btn-danger btnHapus mr-1" data-toggle="modal" data-target="#hapusModal" data-id="${item.id}" data-nama="${item.nama}"><i class="fas fa-trash"></i></button>` +
                     `<button class="btn btn-icon btn-warning btnGantiPw" data-toggle="modal" data-target="#changePasswordModal" data-id="${item.id}"><i class="fas fa-key"></i></button>`
                  ),
               ]),
            },
            columns: [
               {
                  name: 'No',
               },
               {
                  name: 'Nama',
               },
               {
                  name: 'Telepon',
               },
               {
                  name: 'Username',
               },
               {
                  name: 'Outlet',
               },
               {
                  name: 'Aksi',
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
         }).render(document.getElementById('wrapperTable'));

         $('#formCreate').on('submit', function(e) {
            e.preventDefault();
            let form = new FormData(this)
            console.log(form)
            $.ajax({
               url: '/users/store',
               type: 'POST',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  grid.forceRender()
                  $('#createModal').modal('hide')
                  $('#formCreate')[0].reset()
                  $('#alertHere').html(`
                     <div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Create Data Succesfully.
                        </div>
                     </div>
                  `)
               },
               error: function(response) {
                  $('#alertHere').html(`
                     <div class="alert alert-danger alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-times"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           ${response.responseJSON.message}
                        </div>
                     </div>
                  `)
               }
            });
         });

         $('#wrapperTable').on('click', '.btnEdit', function () {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(5) .btnEdit').data('id')
            let nama = row.find('td:eq(5) .btnEdit').data('nama')
            let tlp = row.find('td:eq(5) .btnEdit').data('tlp')
            let alamat = row.find('td:eq(5) .btnEdit').data('alamat')
            let username = row.find('td:eq(5) .btnEdit').data('username')
            let role = row.find('td:eq(5) .btnEdit').data('role')
            let id_outlet = row.find('td:eq(5) .btnEdit').data('idoutlet')
            $('#updateId').val(id)
            $('#updateNama').val(nama)
            $('#updateTlp').val(tlp)
            $('#inputAlamat').text(alamat)
            $('#inputUsername').val(username)
            $('#selectRole').val(role)
            $('#selectOutlet').val(id_outlet)
         })

         $('#wrapperTable').on('click', '.btnHapus', function () {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(5) .btnEdit').data('id')
            let nama = row.find('td:eq(5) .btnEdit').data('nama')
            $('#deleteId').val(id)
            $('#deleteNama').text(nama)
         })

         $('#formUpdate').on('submit', function(e) {
            e.preventDefault()
            let form = new FormData(this)
            $.ajax({
               url: '/users/update',
               type: 'POST',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  grid.forceRender()
                  $('#updateModal').modal('hide')
                  $('#formUpdate')[0].reset()
                  $('#alertHere').html(`
                     <div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Update Data Succesfully.
                        </div>
                     </div>
                  `)
               },
               error: function(response) {
                  $('#alertHere').html(`
                     <div class="alert alert-danger alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-times"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           ${response.responseJSON.message}
                        </div>
                     </div>
                  `)
               }
            });
         })

         $('#formDelete').on('submit', function(e) {
            e.preventDefault()
            let form = new FormData(this)
            $.ajax({
               url: '/users/destroy',
               type: 'POST',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  grid.forceRender()
                  $('#hapusModal').modal('hide')
                  $('#formDelete')[0].reset()
                  $('#alertHere').html(`
                     <div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Delete Data Succesfully.
                        </div>
                     </div>
                  `)
               },
               error: function(response) {
                  $('#alertHere').html(`
                     <div class="alert alert-danger alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-times"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           ${response.responseJSON.message}
                        </div>
                     </div>
                  `)
               }
            });
         })

         $('#wrapperTable').on('click', '.btnGantiPw', function () {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(5) .btnGantiPw').data('id')
            $('#CPid').val(id)
         })

         $('#formChangePassword').on('submit', function(e) {
            e.preventDefault()
            let form = new FormData(this)
            $.ajax({
               url: '/users/changePassword',
               type: 'POST',
               processData: false,
               contentType: false,
               data: form,
               success: function(response) {
                  if (response.success == 'true') {
                     $('#changePasswordModal').modal('hide')
                     $('#formChangePassword')[0].reset()
                     $('#alertHere').html(`
                        <div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                           <div class="alert-icon"><i class="fas fa-check"></i></div>
                           <div class="alert-body">
                              <button class="close" data-dismiss="alert">
                                 <span>&times;</span>
                              </button>
                              Change Password Succesfully.
                           </div>
                        </div>
                     `)
                  } else {
                     $('#alertHere').html(`
                        <div class="alert alert-danger alert-dismissible alert-has-icon align-items-center show fade">
                           <div class="alert-icon"><i class="fas fa-times"></i></div>
                           <div class="alert-body">
                              <button class="close" data-dismiss="alert">
                                 <span>&times;</span>
                              </button>
                              Password Tidak Sama
                           </div>
                        </div>
                     `)
                  }
               },
               error: function(response) {
                  $('#alertHere').html(`
                     <div class="alert alert-danger alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-times"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           ${response.responseJSON.message}
                        </div>
                     </div>
                  `)
               }
            });
         })
      </script>
   </x-slot>
</x-app>
