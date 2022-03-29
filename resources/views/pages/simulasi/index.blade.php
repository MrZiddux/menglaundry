<x-app>
   <div class="section-header">
      <h1>Simulasi Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Simulasi Transaksi Cucian</div>
      </div>
   </div>
   <div class="section-body">
      <div class="card">
         <div class="card-header">
            <h4>Data Transaksi Cucian</h4>
         </div>
         <form id="Form">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>No Transaksi</label>
                        <input type="text" class="form-control form-control-sm" name="no">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control form-control-sm" name="nama">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>No. HP/WA</label>
                        <input type="tel" class="form-control form-control-sm" name="tlp">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Tanggal Cuci</label>
                        <input type="date" class="form-control form-control-sm" name="tanggal_cuci">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Jenis Cucian</label>
                        <select class="form-control form-control-sm" name="jenis" id="inputJenis">
                           <option selected disabled>Pilih Jenis</option>
                           <option value="Standar">Single</option>
                           <option value="Express">Express</option>
                        </select>
                     </div>
                     <input type="hidden" name="harga" id="harga" value="0">
                     <input type="hidden" name="subtotal" id="subtotal" value="0">
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Berat</label>
                        <input type="number" step="0.1" class="form-control form-control-sm" name="berat" value="0" id="berat">
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-primary">Input</button>
            </div>
         </form>
      </div>

      <div class="card">
         <div class="card-header row justify-content-between align-items-center">
            <div class="d-flex">
               <h4>List Gaji Karyawan</h4>
               <button type="button" class="btn btn-primary" id="sortById">Sort By Id</button>
            </div>
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
               <table class="table table-striped table-md" id="tableKaryawan">
                  <tr class="header">
                     <th>
                        Id
                        {{-- <a href="javascript;" id="sortById" class="text-primary text-decoration-none ml-1"><i class="fas fa-sort"></i></a> --}}
                     </th>
                     <th>Nama Pelanggan</th>
                     <th>Kontak</th>
                     <th>Tanggal Cuci</th>
                     <th>
                        Jenis Cucian
                     </th>
                     <th>
                        Berat
                     </th>
                     <th>Diskon</th>
                     <th>
                        Total Harga
                     </th>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>

   <x-slot name="script">
      <script>
         const formatNumber = (number) => {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }

         const resetForm = () => {
            $('#Form')[0].reset()
         }

         const calculateDiskon = (data) => {
            let diskon = 0
            let subtotal = parseInt(data.subtotal)
            if (subtotal >= 50000) {
               diskon = 10
               return diskon
            } else {
               return diskon
            }
         }

         const renderTable = (str) => {
            let data = ''
            let grandTotal = 0
            let totalBerat = 0
            let totalDiskon = 0
            let dataLocalStorage = JSON.parse(localStorage.getItem(str))

            dataLocalStorage.map(item => {
               grandTotal +=  parseInt(item.total)
               totalBerat += parseInt(item.berat)
               totalDiskon += parseInt(item.diskon)
               data += `
                  <tr class="item">
                     <td>${item.no}</td>
                     <td>${item.nama}</td>
                     <td>${item.tlp}</td>
                     <td>${item.tanggal_cuci}</td>
                     <td>${item.jenis}</td>
                     <td>${item.berat}Kg</td>
                     <td>Rp. ${formatNumber(item.diskon)}</td>
                     <td>Rp. ${formatNumber(item.total)}</td>
                  </tr>
               `
            })
            data += `
               <tr class="text-white bg-primary item">
                  <td colspan="4"><b>Total</b><td>
                  <td><b>${formatNumber(totalBerat)}Kg</b></td>
                  <td><b>Rp. ${formatNumber(totalDiskon)}</b></td>
                  <td><b>Rp. ${formatNumber(grandTotal)}</b></td>
               </td>
            `


            $('.item').remove()
            $(data).insertAfter('#tableKaryawan .header')
         }

         let data = []
         $('#Form').on('submit', function(e) {
            e.preventDefault()
            const form = new FormData(this)
            let obj = {}
            for (const key of form) {
               obj[key[0]] = key[1]
            }
            obj['diskon'] =  obj['subtotal'] * (calculateDiskon(obj) / 100)
            obj['total'] = obj['subtotal'] - obj['diskon']
            data.push(obj)
            localStorage.setItem('data', JSON.stringify(data))
            renderTable('data')
            resetForm()
         })

         $(window).on('load', function() {
            renderTable('data')
            let datalocalStorage = JSON.parse(localStorage.getItem('data'))
            data = datalocalStorage
         })

         $('#inputJenis').on('change', function () {
            let value = $(this).val()
            let harga = $('#harga')
            let berat = $('#berat')
            let subtotal = $('#subtotal')
            if (value == 'Standar') {
               harga.val(7500)
               subtotal.val(0)
               berat.val(0)
            } else if (value == 'Express') {
               harga.val(10000)
               subtotal.val(0)
               berat.val(0)
            }
         })

         $('#berat').on('change', function () {
            let value = $(this).val()
            let harga = $('#harga').val()
            let subtotal = $('#subtotal')
            let total = 0
            total = value * harga
            subtotal.val(total)
         })

         // Binary Search Algorithm || Sequential Search
         const searching = (arr, text) => {
            let dataSearch = []
            for (let i = 0; i < arr.length; i++) {
               const nama = arr[i].nama.toLowerCase()
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

         // Insertion Sort
         $('#sortById').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('data'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].no < dataSort[j-1].no; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('sortData', JSON.stringify(dataSort))
            renderTable('sortData')
         })
      </script>
   </x-slot>
</x-app>
