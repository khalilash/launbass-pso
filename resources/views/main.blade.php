<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - @yield('title', 'Aplikasi')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=2">

</head>
<body class="d-flex flex-column min-vh-100">

    <header class="header text-center py-3">
        <h2 class="fw-bold">Data Pelanggan</h2>
    </header>

    <main class="container py-3 grow">
        @yield('content')
    </main>

    <footer class="mt-auto">
        @include('layouts.navbar')
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
