<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard {{ $user->role ?? 'utente' }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
    <script>
        // Variabile globale che contiene il pattern della route di cancellazione
        window.deleteRoutePattern = "{{ route('product.delete', ':prodId') }}";
    </script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>