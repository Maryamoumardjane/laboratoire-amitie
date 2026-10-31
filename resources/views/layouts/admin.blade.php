<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Laboratoire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark px-3">
    <span class="text-white fw-bold">Admin - Laboratoire de l'Amitié</span>
</nav>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div style="width:250px; background:#1F3A5F; min-height:100vh; color:white;">

        <ul class="list-unstyled p-3">

            <li><a href="/admin" class="text-white d-block mb-2">📊 Dashboard</a></li>
            <li><a href="/admin/rendezvous" class="text-white d-block mb-2">📅 Rendez-vous</a></li>
            <li><a href="/admin/examens" class="text-white d-block mb-2">🧪 Examens</a></li>

        </ul>

    </div>

    <!-- CONTENT -->
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>

</div>

</body>
</html>