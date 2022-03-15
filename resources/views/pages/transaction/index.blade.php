<x-app>
   <div class="section-header">
      <h1>Transactions Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Transactions</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.transaction._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const formatNumber = (number) => {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }

         const unformatNumber = (number) => {
            return parseInt(number.replaceAll(/\./g, ''));
         }

         const delunderscore = (str) => {
            return str.replace(/_/g, " ");
         }

         const capitalize = (str) => {
            return str.replace(/\w\S*/g, function (txt) {
               return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
         }
         
         let dataDetail = []
         const gridTransaction = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/transactions/getData',
               then: data=> {
                  dataDetail = data
                  let array = []
                  data.map((item, index) => {
                     array.push([
                        index+1,
                        item.tgl,
                        item.kode_invoice,
                        new gridjs.html(
                           item.status == 'baru' || item.status == 'proses' ?
                           `<span class="badge badge-sm bg-info text-white">${capitalize(delunderscore(item.status))}</span>` :
                           `<span class="badge badge-sm bg-success text-white">${capitalize(delunderscore(item.status))}</span>`
                        ),
                        new gridjs.html(
                           item.pelunasan == 'belum_lunas' ?
                           `<span class="badge badge-sm bg-warning text-white">${capitalize(delunderscore(item.pelunasan))}</span>` :
                           `<span class="badge badge-sm bg-success text-white">${capitalize(delunderscore(item.pelunasan))}</span>`
                        ),
                        new gridjs.html(
                           `<button class='btn btn-icon btn-info btnDetail' data-toggle='modal' data-target='#detailModal' data-id='${item.id}'><i class='fas fa-eye'></i></button>`
                        ),
                     ])
                  })
                  return array
               },
            },
            columns: [
               {
                  name: 'No',
               },
               {
                  name: 'Tanggal',
               },
               {
                  name: 'Kode Invoice',
               },
               {
                  name: 'Status',
                  sort: false,
               },
               {
                  name: 'Pembayaran',
                  sort: false,
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

         // make function to passing data to detailTable modal when click detail button by id
         $(document).on('click', '.btnDetail', function() {
            let id = $(this).data('id')
            let data = dataDetail.find(item => item.id == id)
            let totalHarga = 0
            let totalQty = 0
            let xml = ``

            $('#wizardStatus').text(capitalize(delunderscore(data.status)))
            $('#wizardTgl').text(data.tgl)
            $('#wizardPelunasan').text(capitalize(delunderscore(data.pelunasan)))
            $('#wizardMember').text(data.member.nama)
            $('#wizardUser').text(data.user.nama)
            $('#displayKodeInvoice').text(data.kode_invoice)
            if (data.pelunasan == 'belum_lunas') {
               $('.myWizardPelunasan').removeClass('bg-success')
               $('.myWizardPelunasan').addClass('bg-warning')
            } else {
               $('.myWizardPelunasan').removeClass('bg-warning')
               $('.myWizardPelunasan').addClass('bg-success')
            }

            if (data.status == 'baru') {
               $('#confirmationModalBtn').removeClass('d-none')
               $('#confirmationModalBtn').text('Proses')
            } else if (data.status == 'proses') {
               $('#confirmationModalBtn').removeClass('d-none')
               $('#confirmationModalBtn').text('Selesai')
            } else {
               $('#confirmationModalBtn').addClass('d-none')
               $('#confirmationModalBtn').removeAttr('data-key')
            }

            data.detail_transaksi.map((item, index) => {
               totalHarga += parseInt(item.subtotal)
               totalQty += parseInt(item.qty)
               xml += `
                  <tr class="item">
                     <td>${index+1}</td>
                     <td>${item.paket.nama_paket}</td>
                     <td>Rp. ${formatNumber(item.harga)}</td>
                     <td class="text-center">${item.qty}</td>
                     <td>Rp. ${formatNumber(item.subtotal)}</td>
                  </tr>
               `
            })

            xml += `
               <tr class="text-white bg-primary item">
                  <td colspan="3"><b>Jumlah</b></td>
                  <td class="text-center"><b>${formatNumber(totalQty)}</b></td>
                  <td><b>Rp. ${formatNumber(totalHarga)}</b></td>
               </tr>
            `
            $('.item').remove()
            $(xml).insertAfter('#tableDetailTransaction #header')
         })

         $('#confirmationModalBtn').on('click', function(e) {
            e.preventDefault()
            let modalConfirm = $('#confirmationModal')
            modalConfirm.modal('show')
         })
      </script>
   </x-slot>
</x-app>