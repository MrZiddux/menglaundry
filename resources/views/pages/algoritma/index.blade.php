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
               <div class="card-header">
                  <h4>List Data</h4>
               </div>
               <div class="card-body p-0">
                  <div class="table-responsive">
                     <table class="table table-striped table-md" id="tableTodolist">
                        <tr class="header">
                           <th>No</th>
                           <th>Kegiatan</th>
                           <th>Tenggat Waktu</th>
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
         let dataAll = []
         $('#todolistForm').on('submit', function(e) {
            e.preventDefault()
            const dataForm = new FormData(this)
            let obj = {}
            for (const key of dataForm) {
               obj[key[0]] = key[1]
            }
            dataAll.push(obj)
            localStorage.setItem('data', JSON.stringify(dataAll));
            renderTable()
         })

         const renderTable = () => {
            let data = ''
            let dataLocalStorage = JSON.parse(localStorage.getItem('data'))
            dataLocalStorage.map((item, index) => {
               return data +=  `
                  <tr class="item">
                     <td>${index+1}</td>
                     <td>${item.kegiatan}</td>
                     <td>${item.tenggat_waktu}</td>
                  </tr>`
            })
            $('.item').remove()
            $(data).insertAfter('#tableTodolist .header')
         }

         $(window).on('load', function () {
            renderTable()
            let data = JSON.parse(localStorage.getItem('data'))
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




         // Function to sort an array using insertion sort
         function insertionSort(arr, n) 
         { 
            let i, key, j; 
            for (i = 1; i < n; i++)
            { 
               key = arr[i]; 
               j = i - 1; 
            
               /* Move elements of arr[0..i-1], that are 
               greater than key, to one position ahead 
               of their current position */
               while (j >= 0 && arr[j] > key)
               { 
                     arr[j + 1] = arr[j]; 
                     j = j - 1; 
                     console.log(j)
               } 
               arr[j + 1] = key; 
            } 
         } 
            
         // A utility function to print an array of size n 
         function printArray(arr, n) 
         { 
            let i; 
            for (i = 0; i < n; i++) 
               document.write(arr[i] + " "); 
            document.write("<br>");
         } 
            
         // Driver code
            let arr = [12, 11, 13, 5, 6 ]; 
            let n = arr.length; 
            
            insertionSort(arr, n); 
            printArray(arr, n); 

            function insertionSort(arr) 
         { 
            let key, j; 
            for (let i = 1; i < arr.length; i++)
            { 
               key = arr[i]; 
               j = i - 1; 
            
               /* Move elements of arr[0..i-1], that are 
               greater than key, to one position ahead 
               of their current position */
               while (j >= 0 && arr[j] > key)
               { 
                     arr[j + 1] = arr[j];
                     j = j - 1; 
               } 
               arr[j + 1] = key; 
            } 
         } 
      </script>
   </x-slot>
</x-app>