<x-app title="Outlets">
   <div id="alertHere"></div>
   <div class="row">
      <div class="col-12">
         <button class="btn btn-sm bg-gradient-dark mb-0" data-toggle="modal" data-target="#createModal"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Member</button>
         <div id="wrapperTable"></div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.outlets._modal')
   </x-slot>
   <x-slot name="script">
      <script>
      // const grid = new gridjs()
      const gridOutlet = new gridjs.Grid({
         server: {
            method: 'GET',
            url: '/outlets/getData',
            then: data=>data.map(item =>[
               item.nama,
               item.tlp,
               item.alamat,
               new gridjs.html(
                  `<button class='btn btn-link text-dark px-3 mb-0 btnEdit' data-toggle='modal' data-target='#editModal' data-id='${item.id}' data-nama='${item.nama}' data-tlp='${item.tlp}' data-alamat='${item.alamat}'><i class='material-icons text-sm me-2'>edit</i>Edit</button>` +
                  `<button class="btn btn-link text-danger text-gradient px-3 mb-0 btnHapus" data-toggle="modal" data-target="#hapusModal" data-id="${item.id}" data-nama="${item.nama}"><i class="material-icons text-sm me-2">delete</i>Delete</button>`
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
               name: 'Address',
            },
            {
               name: 'Actions',
               sort: false,
            },
         ],
         className: {
            table: 'table align-items-center mb-0',
            thead: 'bg-primary',
            th: 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7',
            td: 'text-xs font-weight-bold',
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
            let nama = row.find('td:eq(3) .btnEdit').data('nama')
            let tlp = row.find('td:eq(3) .btnEdit').data('tlp')
            let alamat = row.find('td:eq(3) .btnEdit').data('alamat')

            $('#editModal #id').val(id);
            $('#editModal #nama').val(nama);
            $('#editModal #tlp').val(tlp);
            $('#editModal #alamat').text(alamat);
         })

         $('#wrapperTable').on('click', '.btnHapus', function() {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(3) .btnHapus').data('id')
            let nama = row.find('td:eq(3) .btnHapus').data('nama')
            $('#hapusModal #id2').val(id)
            $('#hapusModal #namaOutlet').text(nama)
         })

         $('#btnCreateOutlet').click(function(e) {
            e.preventDefault()
            let createformdata = new FormData(document.getElementById('formCreateOutlet'))
            $.ajax({
               type: 'POST',
               url: "{{ route('outlets.store') }}",
               processData: false,
               contentType: false,
               data: createformdata,
               success: function(data) {
                  if(data.success) {
                        gridOutlet.forceRender()
                        $('#createModal').modal('hide')
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                              <span class="alert-icon align-middle">
                                    <span class="material-icons text-md">
                                    thumb_up_off_alt
                                    </span>
                              </span>
                              <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Create Data Outlet Successfull</span>
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
                           <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Create Data Outlet Successfull</span>
                           <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                           </button>
                        </div>`
                  }
               }
            })
         })


         $('#btnUpdateOutlet').click(function(e) {
            e.preventDefault()
            let updateformdata = new FormData(document.getElementById('formUpdateOutlet'))
            $.ajax({
               type: 'POST',
               url: "{{ route('outlets.update') }}",
               processData: false,
               contentType: false,
               data: updateformdata,
               success: function(data) {
                  if(data.success) {
                        gridOutlet.forceRender()
                        $('#editModal').modal('hide')
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                              <span class="alert-icon align-middle">
                                    <span class="material-icons text-md">
                                    thumb_up_off_alt
                                    </span>
                              </span>
                              <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Update Data Outlet Successfull</span>
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
                           <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Update Data Outlet Unsuccessfull</span>
                           <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                           </button>
                        </div>`
                  }
               }
            })
         })

         $('#btnDeleteOutlet').click(function(e) {
            e.preventDefault()
            let deleteformdata = new FormData(document.getElementById('formDeleteOutlet'))
            $.ajax({
               type: 'POST',
               url: "{{ route('outlets.destroy') }}",
               processData: false,
               contentType: false,
               data: deleteformdata,
               success: function(data) {
                  if(data.success) {
                        gridOutlet.forceRender()
                        $('#hapusModal').modal('hide')
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible fade show text-white mb-4 alertAnimation" role="alert">
                              <span class="alert-icon align-middle">
                                    <span class="material-icons text-md">
                                    thumb_up_off_alt
                                    </span>
                              </span>
                              <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Delete Data Outlet Successfull</span>
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
                           <span class="alert-text"><strong>Success!</strong>&nbsp;&nbsp;Delete Data Outlet Unsuccessfull</span>
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
