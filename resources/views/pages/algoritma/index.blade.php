<x-app>
   <div class="section-header">
      <h1>Algoritma Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Algoritma</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row justify-content-center">
         <div class="col-lg-4">
            <div class="card">
               <div class="card-header">
                  <h4>To Do List</h4>
               </div>
               <form id="todolistForm">
                  <div class="card-body">
                     <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" id="id" class="form-control" placeholder="What's your id?" name="id">
                     </div>
                     <div class="form-group">
                        <label for="tenggatWaktu">Tenggat Waktu</label>
                        <input type="datetime-local" id="tenggatWaktu" class="form-control" name="tenggat_waktu">
                     </div>
                     <div class="form-group">
                        <label for="kegiatan">Kegiatan</label>
                        <input type="text" id="kegiatan" class="form-control" placeholder="What's your activity?" name="kegiatan">
                     </div>
                  </div>
                  <div class="card-footer text-right">
                     <button type="reset" class="btn btn-secondary">Clear</button>
                     <button type="submit" class="btn btn-primary">Set Kegiatan</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-8">
            <div class="card">
               <div class="card-header row justify-content-between align-items-center">
                  <h4>List Data</h4>
                  <div class="card-header-form">
                     <div class="input-group">
                        <input type="search" class="form-control" id="search" placeholder="Type here...">
                        <div class="input-group-btn">
                           <button type="button" class="btn btn-primary btn-icon"><i class="fas fa-search"></i>&nbsp;Search</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body p-0">
                  <div class="table-responsive">
                     <table class="table table-striped table-md" id="tableTodolist">
                        <tr class="header">
                           <th>No</th>
                           <th>
                              Id
                              <a href="javascript;" id="sortById" class="text-primary text-decoration-none ml-1"><i class="fas fa-sort"></i></a>
                           </th>
                           <th>Kegiatan</th>
                           <th>
                              Tenggat Waktu
                              <a href="javascript;" id="sortByDate" class="text-primary text-decoration-none ml-1"><i class="fas fa-sort"></i></a>
                           </th>
                           <th>&nbsp;</th>
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
         const checkDataForBtn = () => {
            if (JSON.parse(localStorage.getItem('data')).length === 0) {
               $('#sortById').removeClass('text-primary')
               $('#sortById').addClass('text-secondary')
               $('#sortByDate').removeClass('text-primary')
               $('#sortByDate').addClass('text-secondary')
               return false
            } else {
               $('#sortById').removeClass('text-secondary')
               $('#sortById').addClass('text-primary')
               $('#sortByDate').removeClass('text-secondary')
               $('#sortByDate').addClass('text-primary')
            }
         }

         const resetForm = () => {
            $('#todolistForm')[0].reset()
         }

         let dataAll = []
         $('#todolistForm').on('submit', function(e) {
            e.preventDefault()
            const dataForm = new FormData(this)
            let obj = {}
            for (const key of dataForm) {
               obj[key[0]] = key[1]
            }
            // make if when input is empty add class to input is-invalid
            if (obj.id === '' || obj.tenggat_waktu === '' || obj.kegiatan === '') {
               $('#id').addClass('is-invalid')
               $('#tenggatWaktu').addClass('is-invalid')
               $('#kegiatan').addClass('is-invalid')
            } else {
               $('#id').removeClass('is-invalid')
               $('#tenggatWaktu').removeClass('is-invalid')
               $('#kegiatan').removeClass('is-invalid')
               dataAll.push(obj)
               localStorage.setItem('data', JSON.stringify(dataAll))
               renderTable()
               checkDataForBtn()
               resetForm()
            }
         })

         const renderTable = () => {
            let data = ''
            let dataLocalStorage = JSON.parse(localStorage.getItem('data'))
            dataLocalStorage.map((item, index) => {
               return data +=  `
                  <tr class="item">
                     <td>${index+1}</td>
                     <td>${item.id}</td>
                     <td>${item.kegiatan}</td>
                     <td>${item.tenggat_waktu}</td>
                     <td><button data-index="${index+1}" class="btn btn-sm btn-danger">Remove</button></td>
                  </tr>`
            })
            $('.item').remove()
            $(data).insertAfter('#tableTodolist .header')
         }

         $(window).on('load', function () {
            checkDataForBtn()
            renderTable()
            let data = JSON.parse(localStorage.getItem('data'))

            // CARA PENDEK
            dataAll = data

            // CARA RIVALDI
            // if (data) {
            //    dataAll.push(..data)
            // }
            
            // CARA IHSAN
            // data.forEach(item => {
               //    dataAll.push({...item})
               // })
         })

         $('#tableTodolist').on('click', '.btn-danger', function() {
            let index = $(this).data('index')
            dataAll.splice(index-1, 1)
            localStorage.setItem('data', JSON.stringify(dataAll))
            checkDataForBtn()
            renderTable()
         })

         $('#sortByDate').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('data'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].tenggat_waktu < dataSort[j-1].tenggat_waktu; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('data', JSON.stringify(dataSort))
            renderTable()
         })

         $('#sortById').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('data'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].id < dataSort[j-1].id; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('data', JSON.stringify(dataSort))
            renderTable()
         })

         // make function to search data by kegiatan, id or date when click button search
         $('#search').on('keyup', function() {
            let data = JSON.parse(localStorage.getItem('data'))
            let dataSearch = []
            data.forEach(item => {
               dataSearch.push({...item})
            })
            let search = $(this).val()
            let dataSearchResult = dataSearch.filter(item => {
               return item.kegiatan.toLowerCase().includes(search.toLowerCase()) || item.id.toLowerCase().includes(search.toLowerCase()) || item.tenggat_waktu.toLowerCase().includes(search.toLowerCase())
            })
            localStorage.setItem('data', JSON.stringify(dataSearchResult))
            renderTable()
         })

      </script>
   </x-slot>
</x-app>