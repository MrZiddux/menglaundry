<x-app>
   <div class="section-header">
      <h1>Simulasi Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Simulasi Penjualan Aksesoris</div>
      </div>
   </div>
   <div class="section-body">
      <div class="card">
         <div class="card-header">
            <h4>Data Penjualan Aksesoris</h4>
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
                        <label>Tanggal Beli</label>
                        <input type="date" class="form-control form-control-sm" name="tanggal_beli">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Barang Dibeli</label>
                        <select class="form-control form-control-sm" name="barang_dibeli" id="barangDibeli">
                           <option selected disabled>Pilih</option>
                           <option value="Gantungan Kunci">Gantungan Kunci</option>
                           <option value="Ikat Rambut">Ikat Rambut</option>
                        </select>
                     </div>
                     <input type="hidden" name="harga" id="harga" value="0">
                     <input type="hidden" name="subtotal" id="subtotal" value="0">
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Warna</label>
                        <select class="form-control form-control-sm" name="warna">
                           <option selected disabled>Pilih</option>
                           <option value="Kuning">Kuning</option>
                           <option value="Merah">Merah</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Jumlah Beli</label>
                        <input type="number" class="form-control form-control-sm" name="jumlah_beli" value="0" id="jumlahBeli">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nama Pembeli</label>
                        <input type="text" class="form-control form-control-sm" name="nama_pembeli">
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
               <h4>List Penjualan Aksesoris</h4>
               {{-- <button type="button" class="btn btn-primary" id="sortById">Sort By Id</button> --}}
               <div class="input-group">
                  <select id="selectSort" class="form-control form-control-sm">
                     <option value="no">Id</option>
                     <option value="tanggal_beli">Tanggal Beli</option>
                     <option value="barang_dibeli">Nama Barang</option>
                     <option value="warna">Warna</option>
                     <option value="harga">Harga</option>
                     <option value="jumlah_beli">Jumlah Beli</option>
                     <option value="nama_pembeli">Nama</option>
                     <option value="diskon">Diskon</option>
                     <option value="total">Total</option>
                  </select>
                  <div class="input-group-btn">
                     <button type="button" class="btn btn-primary btn-icon" id="sortButton"><i class="fas fa-sort"></i>&nbsp;Sort</button>
                  </div>
               </div>
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
               <table class="table table-striped table-md" id="myTable">
                  <tr class="header">
                     <th>
                        Id
                        {{-- <a href="javascript;" id="sortById" class="text-primary text-decoration-none ml-1"><i class="fas fa-sort"></i></a> --}}
                     </th>
                     <th>Tanggal Beli</th>
                     <th>Nama Barang</th>
                     <th>Warna</th>
                     <th>
                        Harga
                     </th>
                     <th>
                        Jumlah Beli
                     </th>
                     <th>Nama Pelanggan</th>
                     <th>
                        Diskon
                     </th>
                     <th>Total Harga</th>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>

   <x-slot name="script">
      <script>
         // Membuat Arrow Function untuk mengubah sebuah format text angka di tambah . setiap 3 digit dibelakangnya
         const formatNumber = (number) => {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }

         // Membuat Arrow Function untuk mereset form
         const resetForm = () => {
            $('#Form')[0].reset()
         }

         // Membuat Arrow Function untuk menghitung diskon jika subtotal lebih dari dengan 50 ribu atau jumlah beli minimal 10
         const calculateDiskon = (data) => {
            let diskon = 0
            let subtotal = parseInt(data.subtotal)
            let jumlah_beli = parseInt(data.jumlah_beli)
            if (subtotal >= 30000 || jumlah_beli >= 10) {
               diskon = 20
               return diskon
            } else {
               return diskon
            }
         }

         // Membuat arrow function untuk merender tabel
         const renderTable = (str) => {
            let data = ''
            let grandTotal = 0
            let totalJumlahBeli = 0
            let totalDiskon = 0
            let totalHarga = 0
            let dataLocalStorage = JSON.parse(localStorage.getItem(str))

            dataLocalStorage.map(item => {
               totalHarga += parseInt(item.harga)
               grandTotal +=  parseInt(item.total)
               totalJumlahBeli += parseInt(item.jumlah_beli)
               totalDiskon += parseInt(item.diskon)
               data += `
                  <tr class="item">
                     <td>${item.no}</td>
                     <td>${item.tanggal_beli}</td>
                     <td>${item.barang_dibeli}</td>
                     <td>${item.warna}</td>
                     <td>Rp. ${formatNumber(item.harga)}</td>
                     <td>${item.jumlah_beli}</td>
                     <td>${item.nama_pembeli}</td>
                     <td>Rp. ${formatNumber(item.diskon)}</td>
                     <td>Rp. ${formatNumber(item.total)}</td>
                  </tr>
               `
            })
            data += `
               <tr class="text-white bg-primary item">
                  <td colspan="3"><b>Total</b><td>
                  <td><b>Rp. ${formatNumber(totalHarga)}</b></td>
                  <td><b>${formatNumber(totalJumlahBeli)}</b></td>
                  <td></td>
                  <td><b>Rp. ${formatNumber(totalDiskon)}</b></td>
                  <td><b>Rp. ${formatNumber(grandTotal)}</b></td>
               </td>
            `


            $('.item').remove()
            $(data).insertAfter('#myTable .header')
         }

         // Fungsi ketika tombol dari #From di submit maka hasil form akan dimasukkan ke localstorage Data
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

         // Fungsi yang dijalankan ketika halaman di load maka halaman tersebut akan merender tabel dan memasukkan dari dari localstorage ke array data
         $(window).on('load', function() {
            renderTable('data')
            let datalocalStorage = JSON.parse(localStorage.getItem('data'))
            data = datalocalStorage
         })

         // Fungsi dimana select barangdibeli dirubah maka akan menset harga sesua valuenya, dan mereset value menjadi 0 ke subtotal dan jumlah beli
         $('#barangDibeli').on('change', function () {
            let value = $(this).val()
            let harga = $('#harga')
            let jumlahBeli = $('#jumlahBeli')
            let subtotal = $('#subtotal')
            if (value == 'Gantungan Kunci') {
               harga.val(5000)
               subtotal.val(0)
               jumlahBeli.val(0)
            } else if (value == 'Ikat Rambut') {
               harga.val(2500)
               subtotal.val(0)
               jumlahBeli.val(0)
            }
         })

         // Fungsi ketika input number jumlah beli diubah maka akan menghitung subtotal
         $('#jumlahBeli').on('change', function () {
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
               const barang_dibeli = arr[i].barang_dibeli.toLowerCase()
               const warna = arr[i].warna.toLowerCase()
               const nama_pembeli = arr[i].nama_pembeli.toLowerCase()
               if (barang_dibeli.includes(text.toLowerCase()) || warna.includes(text.toLowerCase()) || nama_pembeli.includes(text.toLowerCase())) {
                  dataSearch.push(arr[i])
                  // break
               }
            }
            return dataSearch
         }

         
         // Fungsi ketika tombol searchbutton di klik maka akan mengirimkan 2 data ke fungsi searching yang nantinya akan di render oleh tabel
         $('#searchButton').on('click', function () {
            let text = $('#search').val()
            let data = JSON.parse(localStorage.getItem('data'))
            let dataSearch = searching(data, text)
            localStorage.setItem('dataSearch', JSON.stringify(dataSearch))
            renderTable('dataSearch')
         })

         // Insertion Sort
         // $('#sortById').on('click', function(e) {
         //    e.preventDefault()
         //    let data = JSON.parse(localStorage.getItem('data'))
         //    let dataSort = []
         //    data.forEach(item => {
         //       dataSort.push({...item})
         //    })
         //    let temp
         //    for (let i = 1; i < dataSort.length; i++) {
         //       for (let j = i; j > 0 && dataSort[j].barang_dibeli > dataSort[j-1].barang_dibeli; j--) {
         //          temp = dataSort[j]
         //          dataSort[j] = dataSort[j-1]
         //          dataSort[j-1] = temp
         //       }
         //    }
         //    localStorage.setItem('sortData', JSON.stringify(dataSort))
         //    renderTable('sortData')
         // })

         $('#sortButton').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('data'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               const selectValue = $('#selectSort').val()
               for (let j = i; j > 0 && dataSort[j][selectValue] < dataSort[j-1][selectValue]; j--) {
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
