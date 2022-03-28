<x-app title="Simulasi">
   <div class="section-header">
      <h1>Halamana Simulasi</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Simulasi</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4>Transaksi Barang</h4>
               </div>
               <form id="formSimulasi">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                              <label>ID Karyawan</label>
                              <input type="text" class="form-control" name="id">
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label>Tanggal Beli</label>
                              <input type="date" class="form-control" name="tgl">
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label>Nama Barang</label>
                              <select class="form-control" name="nama_barang" id="selectBarang">
                                 <option selected disabled>Pilih Barang</option>
                                 <option value="Detergen">Detergen</option>
                                 <option value="Pewangi">Pewangi</option>
                                 <option value="Detergen Sepatu">Detergen Sepatu</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label>Harga Barang</label>
                              <input type="text" class="form-control" name="harga_barang" id="hargaBarang" readonly value="0">
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label>Jumlah</label>
                              <input type="number" class="form-control" name="jml" id="jml" value="0" disabled>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label class="d-block">Jenis Pembayaran</label>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" id="jenisPembayaran1" value="Cash" name="jenis_pembayaran">
                                 <label class="form-check-label" for="jenisPembayaran1">Cash</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" id="jenisPembayaran2" value="E-Money" name="jenis_pembayaran">
                                 <label class="form-check-label" for="jenisPembayaran2">E-Money/Transfer</label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Input</button>
                     <div class="float-right text-primary">
                        <h2>Rp. <span id="textTotal">0</span></h2>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-12">
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label>Filter</label>
                     <select id="filterJenisPembayaran" class="form-control">
                        <option selected disabled>Pilih Filter</option>
                        <option value="Cash">Cash</option>
                        <option value="E-Money">E-Money</option>
                        <option value="Keduanya">Keduanya</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header row justify-content-between align-items-center">
                  <h4>List Transaksi Barang</h4>
                  <div class="card-header-form">
                     <div class="input-group">
                        <input type="search" class="form-control" id="search" placeholder="Type here...">
                        <div class="input-group-btn">
                           <button type="button" class="btn btn-primary btn-icon" id="searchButton"><i class="fas fa-search"></i>&nbsp;Search</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body p-0">
                  <div class="table-responsive">
                     <table class="table table-striped table-md" id="tableData">
                        <tr class="header">
                           <th>ID</th>
                           <th>Tanggal Beli</th>
                           <th>Nama Barang</th>
                           <th>Harga</th>
                           <th>Qty</th>
                           <th>Diskon</th>
                           <th>Total Harga</th>
                           <th>Jenis Bayar</th>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <x-slot name="script">
      <script>
         const formatNumber = (number) => {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }

         let data = []
         $('#formSimulasi').submit(function(e) {
            e.preventDefault()
            const form = new FormData(this)
            let obj = {}
            for (const key of form) {
               obj[key[0]] = key[1];
            }
            obj['diskon'] =  (obj['harga_barang'] * obj['jml']) * (calculateDiskon(obj) / 100)
            obj['total_harga'] = (obj['harga_barang'] * obj['jml']) - obj['diskon']
            data.push(obj)
            localStorage.setItem('data', JSON.stringify(data))
            renderTable('data')
            clearForm()
         });

         const renderTable = (str) => {
            let data = ``
            let datalocalStorage = JSON.parse(localStorage.getItem(str))
            let totalHarga = 0
            let totalQty = 0
            let totalDiskon = 0
            let grandTotal = 0

            datalocalStorage.map(item => {
               totalHarga += parseInt(item.harga_barang)
               totalQty += parseInt(item.jml)
               totalDiskon += parseInt(item.diskon)
               grandTotal += parseInt(item.total_harga)
               data += `
                  <tr class="item">
                     <td>${item.id}</td>
                     <td>${item.tgl}</td>
                     <td>${item.nama_barang}</td>
                     <td>${formatNumber(item.harga_barang)}</td>
                     <td>${formatNumber(item.jml)}</td>
                     <td>${formatNumber(item.diskon)}</td>
                     <td>${formatNumber(item.total_harga)}</td>
                     <td>${item.jenis_pembayaran}</td>
                  </tr>
               `
            })
            data += `
               <tr class="text-white bg-primary item">
                  <td colspan="3"><b>Total</b></td>
                  <td><b>${formatNumber(totalHarga)}</b></td>
                  <td><b>${formatNumber(totalQty)}</b></td>
                  <td><b>${formatNumber(totalDiskon)}</b></td>
                  <td colspan="2"><b>${formatNumber(grandTotal)}</b></td>
               </tr>
            `
            $('.item').remove()
            $(data).insertAfter('#tableData .header')
         }

         const calculateDiskon = (data) => {
            let diskon = 0
            let total_harga = data.harga_barang * data.jml
            if (total_harga >= 50000) {
               diskon = 15
               return diskon
            } else {
               return diskon
            }
         }

         const checkData = () => {
            if (localStorage.getItem('data') === null) {
               let emptyTable = `
                  <tr class="item">
                     <td colspan="8" class="text-center">Tidak ada data</td>
                  </tr>
               `
               $('item').remove()
               $(emptyTable).insertAfter('#tableData .header')
            } else {
               renderTable('data')
               let datalocalStorage = JSON.parse(localStorage.getItem('data'))
               data = datalocalStorage
            }
         }

         const clearForm = () => {
            $('#formSimulasi')[0].reset()
            $('#textTotal').text(0)
         }

         $('#filterJenisPembayaran').on('change', function () {
            let filter = $(this).val()
            let data = JSON.parse(localStorage.getItem('data'))
            if (filter === 'Cash') {
               let cash = data.filter(item => item.jenis_pembayaran === 'Cash')
               localStorage.setItem('dataFilter', JSON.stringify(cash))
               renderTable('dataFilter')
            } else if (filter === 'E-Money') {
               let emoney = data.filter(item => item.jenis_pembayaran === 'E-Money')
               localStorage.setItem('dataFilter', JSON.stringify(emoney))
               renderTable('dataFilter')
            } else if (filter === 'Keduanya') {
               let keduanya = data.filter(item => item.jenis_pembayaran === 'Cash' || item.jenis_pembayaran === 'E-Money')
               localStorage.setItem('dataFilter', JSON.stringify(keduanya))
               renderTable('dataFilter')
            } else {
               renderTable('data')
            }
         })

         // const filterJenisBayar = () => {
         //    let data = JSON.parse(localStorage.getItem('data'))
         //    let dataFilter []
         //    data.forEach(item => {
         //       dataSort.push({...item})
         //    })
         //    let temp
         //    for (let i = 1; i < dataFilter.length; i++) {
         //       for(let j = 1; j > 0 && dataFilter[j].)
         //    }
         // }

         $('#selectBarang').on('change', function () {
            let value = $(this).val()
            let harga = $('#hargaBarang')
            let jml = $('#jml')
            let textTotal = $('#textTotal')
            if (value == 'Detergen') {
               harga.val(15000)
               jml.attr('disabled', false)
               jml.val(0)
               textTotal.text(0)
            } else if (value == 'Pewangi') {
               harga.val(10000)
               jml.attr('disabled', false)
               jml.val(0)
               textTotal.text(0)
            } else if (value == 'Detergen Sepatu') {
               harga.val(25000)
               jml.attr('disabled', false)
               jml.val(0)
               textTotal.text(0)
            }
         })

         const searching = (arr, text) => {
            let dataSearch = []
            for (let i = 0; i < arr.length; i++) {
               const nama = arr[i].nama_barang.toLowerCase()
               if (nama.includes(text.toLowerCase())) {
                  dataSearch.push(arr[i])
                  break
               }
            }
            return dataSearch
         }

         $('#searchButton').on('click', function () {
            let text = $('#search').val()
            let data = JSON.parse(localStorage.getItem('data'))
            let dataSearch = searching(data, text)
            localStorage.setItem('dataSearch', JSON.stringify(dataSearch))
            renderTable('dataSearch')
         })

         $('#jml').on('change', function () {
            let value = $(this).val()
            let harga = $('#hargaBarang').val()
            let textTotal = $('#textTotal')
            let total = 0
            total = value * harga
            textTotal.text(formatNumber(total)  )
         })

         $(window).on('load', () => {
            checkData()
         })
      </script>
   </x-slot>
</x-app>
