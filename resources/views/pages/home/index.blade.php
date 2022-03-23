<x-app title="Dashboard">
   @if (session('success'))
      <div class="section-header">
         <h1>{{ auth()->user()->nama }}, {{ session('success') }}</h1>
      </div>
   @else
      <div class="section-header">
         <h1>Halaman Dashboard</h1>
      </div>
   @endif
</x-app>