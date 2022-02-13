<x-app title="Members">
   <div class="section-header">
      <h1>Members Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
         <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
         <div class="breadcrumb-item">Modal</div>
      </div>
   </div>
   <div class="section-body">
      <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add New Member</button>
      <div id="alertHere"></div>
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.members._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const gridMember = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/members/getData',
               then: data=>data.map(item =>[
                  item.nama,
                  item.tlp,
                  new gridjs.html(
                     item.jenis_kelamin == 'L' ? `<span class="badge badge-sm bg-info text-white">L</span>` : `<span class="badge badge-sm bg-danger text-white">P</span>`
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
               $('#hapusModal #namaMember').text(nama)
            })

            $('#btnCreateMember').click(function(e) {
               e.preventDefault()
               let createformdata = new FormData(document.getElementById('formCreateMember'))
               $.ajax({
                  type: 'POST',
                  url: "{{ route('members.store') }}",
                  processData: false,
                  contentType: false,
                  data: createformdata,
                  success: function(data) {
                     if(data.success) {
                           gridMember.forceRender()
                           $('#createModal').modal('hide')
                           $('#alertHere').html(
                              `<div class="alert alert-success alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                                 <span class="alert-icon align-middle">
                                       <span class="material-icons text-md">
                                       thumb_up_off_alt
                                       </span>
                                 </span>
                                 <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Create Data Member Successfull</span>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>`
                           )
                     } else {
                           `<div class="alert alert-danger alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                              <span class="alert-icon align-middle">
                                 <span class="material-icons text-md">
                                 info
                                 </span>
                              </span>
                              <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Create Data Member Successfull</span>
                              <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                              </button>
                           </div>`
                     }
                  }
               })
            })


            $('#btnUpdateMember').click(function(e) {
               e.preventDefault()
               let updateformdata = new FormData(document.getElementById('formUpdateMember'))
               $.ajax({
                  type: 'POST',
                  url: "{{ route('members.update') }}",
                  processData: false,
                  contentType: false,
                  data: updateformdata,
                  success: function(data) {
                     if(data.success) {
                           gridMember.forceRender()
                           $('#editModal').modal('hide')
                           $('#alertHere').html(
                              `<div class="alert alert-success alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                                 <span class="alert-icon align-middle">
                                       <span class="material-icons text-md">
                                       thumb_up_off_alt
                                       </span>
                                 </span>
                                 <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Update Data Member Successfull</span>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>`
                           )
                     } else {
                           `<div class="alert alert-danger alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                              <span class="alert-icon align-middle">
                                 <span class="material-icons text-md">
                                 info
                                 </span>
                              </span>
                              <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Update Data Member Unsuccessfull</span>
                              <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                              </button>
                           </div>`
                     }
                  }
               })
            })

            $('#btnDeleteMember').click(function(e) {
               e.preventDefault()
               let deleteformdata = new FormData(document.getElementById('formDeleteMember'))
               $.ajax({
                  type: 'POST',
                  url: "{{ route('members.destroy') }}",
                  processData: false,
                  contentType: false,
                  data: deleteformdata,
                  success: function(data) {
                     if(data.success) {
                           gridMember.forceRender()
                           $('#hapusModal').modal('hide')
                           $('#alertHere').html(
                              `<div class="alert alert-success alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                                 <span class="alert-icon align-middle">
                                       <span class="material-icons text-md">
                                       thumb_up_off_alt
                                       </span>
                                 </span>
                                 <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Delete Data Member Successfull</span>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>`
                           )
                     } else {
                           `<div class="alert alert-danger alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                              <span class="alert-icon align-middle">
                                 <span class="material-icons text-md">
                                 info
                                 </span>
                              </span>
                              <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Delete Data Member Unsuccessfull</span>
                              <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>`
                     }
                  }
               })
            })
         })
      </script>
   </x-slot>
</x-app>