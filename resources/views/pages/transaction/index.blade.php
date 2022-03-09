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

   <x-slot name="script">
      <script>
         const gridTransaction = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/transactions/getData',
               then: data=>data.map(item => [
                  
               ])
            }
         })
      </script>
   </x-slot>
</x-app>