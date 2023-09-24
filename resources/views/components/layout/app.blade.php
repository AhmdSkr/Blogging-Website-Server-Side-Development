<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @if(isset($head))
    {{$head}}
    @endif
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
  <main class="min-h-screen">
    <x-layout.navigation>
    {{$slot}}
    </x-layout.navigation>
  </main>
  <x-layout.footer/>
</body>
</html>