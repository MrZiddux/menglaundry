<x-app title="Outlets">
   <div class="section-header">
      <h1>Outlets Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
         <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
         <div class="breadcrumb-item">Modal</div>
      </div>
   </div>
   <div class="section-body">
      <div id="alertHere"></div>
      <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add New Outlet</button>
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
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
                  `<button class='btn btn-icon btn-info btnEdit mr-1' data-toggle='modal' data-target='#editModal' data-id='${item.id}' data-nama='${item.nama}' data-tlp='${item.tlp}' data-alamat='${item.alamat}'><i class='fas fa-edit'></i></button>` +
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

         $('.btnResetForm').on('click', function () {
            $('#createModal form')[0].reset()
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
                        $('#createModal form')[0].reset()
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Create Data Outlet Succesfully.
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
                           Create Data Outlet Failed.
                        </div>
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
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Update Data Outlet Succesfully.
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
                           Update Data Outlet Failed.
                        </div>
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
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Delete Data Outlet Succesfully.
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
                           Delete Data Outlet Failed.
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
