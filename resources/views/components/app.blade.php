<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  @if($title != Null)
  <title>{{ $title }} &mdash; Zilaundry</title>
  @else
  <title>Zilaundry</title>
  @endif
  <x-link></x-link>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <x-navbar></x-navbar>
      <x-aside></x-aside>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          {{ $slot }}
        </section>
      </div>
      <x-footer></x-footer>
    </div>
  </div>
  {{ $btm }}
  <x-script></x-script>
  {{ $script }}
</body>
</html>
