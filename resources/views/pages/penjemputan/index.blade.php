<x-app>
   <div class="section-header">
      <h1>Penjemputan Laundry Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item active"><a href="/transactions">Transaction</a></div>
         <div class="breadcrumb-item">Penjemputan Laundry</div>
      </div>
   </div>
   <div class="section-body">
      <div id="alertHere"></div>
      <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add Delivery</button>
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.penjemputan._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const formatNumber = (number) => {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }

         const gridPenjemputan = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/transaction/penjemputan-laundry/showDataPenjemputan',
               then: data=>data.map((item, index) =>[
                  index+1,
                  item.transaksi.kode_invoice,
                  item.transaksi.member.nama,
                  item.transaksi.member.alamat,
                  item.transaksi.member.tlp,
                  new gridjs.html( `
                     <select id="selectStatusPenjemputan" class="form-control" data-id="${item.id}">
                        <option value="tercatat" ${item.status == 'tercatat' ? 'selected' : ''}>Tercatat</option>
                        <option value="penjemputan" ${item.status == 'penjemputan' ? 'selected' : ''}>Penjemputan</option>
                        <option value="selesai" ${item.status == 'selesai' ? 'selected' : ''}>Selesai</option>
                     </select>
                  `
                  ),
                  new gridjs.html(
                     `<button class='btn btn-icon btn-info btnEdit mr-1' data-toggle='modal' data-target='#updateModal' data-id='${item.id}' data-transaksi='${item.id_transaksi}' data-kurir='${item.id_kurir}' data-status='${item.status}'><i class='fas fa-edit'></i></button>` +
                     `<button class="btn btn-icon btn-danger btnHapus" data-toggle="modal" data-target="#hapusModal" data-id="${item.id}" data-kodeinvoice="${item.transaksi.kode_invoice}"><i class="fas fa-trash"></i></button>`
                  ),
               ]),
            },
            columns: [
               {
                  name: 'No',
               },
               {
                  name: 'Kode Invoice',
               },
               {
                  name: 'Nama Pengguna',
               },
               {
                  name: 'Alamat',
               },
               {
                  name: 'Telp',
               },
               {
                  name: 'Status',
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

         $(document).on('change', '#selectStatusPenjemputan', function () {
            let id = $(this).data('id')
            let status = $(this).val()
            $.ajax({
               type: 'POST',
               url: "/transaction/penjemputan-laundry/updateStatus",
               data: {
                  _token: "{{ csrf_token() }}",
                  id: id,
                  status: status,
               },
               success: function(data) {
                  if(data.success) {
                        gridPenjemputan.forceRender()
                  } else {
                     `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                           <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                           </button>
                           Update Status Penjemputan Failed.
                        </div>
                     </div>`
                  }
               }
            })
         })


         $('#createForm').on('submit', function(e) {
            e.preventDefault()
            let createformdata = new FormData(this);
            $.ajax({
               type: 'POST',
               url: "{{ route('penjemputan-laundry.store') }}",
               processData: false,
               contentType: false,
               data: createformdata,
               success: function(data) {
                  if(data.success) {
                        gridPenjemputan.forceRender()
                        $('#createModal').modal('hide')
                        $('#createForm')[0].reset()
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Create Data Penjemputan Succesfully.
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
                           Create Data Penjemputan Failed.
                        </div>
                     </div>`
                  }
               }
            })
         })

         $('#updateForm').on('submit', function(e) {
            e.preventDefault()
            let updateformdata = new FormData(this);
            $.ajax({
               type: 'POST',
               url: "/transaction/penjemputan-laundry/update",
               processData: false,
               contentType: false,
               data: updateformdata,
               success: function(data) {
                  if(data.success) {
                        gridPenjemputan.forceRender()
                        $('#updateModal').modal('hide')
                        $('#updateForm')[0].reset()
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Update Data Penjemputan Succesfully.
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
                           Update Data Penjemputan Failed.
                        </div>
                     </div>`
                  }
               }
            })
         })

         $('#formDeletePenjemputan').on('submit', function(e) {
            e.preventDefault()
            let formdata = new FormData(this);
            $.ajax({
               type: 'POST',
               url: "/transaction/penjemputan-laundry/destroy",
               processData: false,
               contentType: false,
               data: formdata,
               success: function(data) {
                  if(data.success) {
                        gridPenjemputan.forceRender()
                        $('#hapusModal').modal('hide')
                        $('#formDeletePenjemputan')[0].reset()
                        $('#alertHere').html(
                           `<div class="alert alert-success alert-dismissible alert-has-icon align-items-center show fade">
                              <div class="alert-icon"><i class="fas fa-check"></i></div>
                              <div class="alert-body">
                                 <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 Update Data Penjemputan Succesfully.
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
                           Update Data Penjemputan Failed.
                        </div>
                     </div>`
                  }
               }
            })
         })

         $('#wrapperTable').on('click', '.btnEdit', function() {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(6) .btnEdit').data('id')
            let transaksi = row.find('td:eq(6) .btnEdit').data('transaksi')
            let kurir = row.find('td:eq(6) .btnEdit').data('kurir')
            let status = row.find('td:eq(6) .btnEdit').data('status')
            
            $('#id').val(id)
            $('#inputIdTransaksi2').val(transaksi)
            $('#inputIdKurir2').val(kurir)
            $('#inputStatus2').val(status)
         })

         $('#wrapperTable').on('click', '.btnHapus', function() {
            let row = $(this).closest('tr')
            let id = row.find('td:eq(6) .btnHapus').data('id')
            let kode_invoice = row.find('td:eq(6) .btnHapus').data('kodeinvoice')
            $('#idDelete').val(id)
            $('#kodeInvoice').text(kode_invoice)
         })

         const getDataTransaction = async () => {
            const response = await fetch('/transaction/penjemputan-laundry/getTransactionStatus');
            const data = await response.json();
            return data;
         }

         const getDataKurir = async () => {
            const response = await fetch('/transaction/penjemputan-laundry/getDataKurir');
            const data = await response.json();
            return data;
         }

         const loopingDataTransaction = async () => {
            const data = await getDataTransaction();
            const select = $('#inputIdTransaksi');
            const select2 = $('#inputIdTransaksi2');
            data.forEach(item => {
               const option = document.createElement('option');
               option.value = item.id;
               option.innerHTML = item.kode_invoice;
               // select.append(option);
               select2.append(option);
            });
         }

         // AWAIT PENGGANTI THEN

         const loopingDataKurir = async () => {
            const data = await getDataKurir();
            const select = $('#inputKurir');
            const select2 = $('#inputKurir2');
            data.forEach(item => {
               const option = document.createElement('option');
               option.value = item.id;
               option.innerHTML = item.nama;
               // select.append(option);
               select2.append(option);
            });
         }

         $(window).on('load', async () => {
            loopingDataTransaction();
            loopingDataKurir();
         });
      </script>
   </x-slot>
</x-app>