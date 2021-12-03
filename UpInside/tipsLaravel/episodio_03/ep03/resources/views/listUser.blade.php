<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Detalhes do Usuario</title>
    </head>
    <body>
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>
        <p>{{ date('d/m/Y H:i', strtotime($user->created_at)) }}</p>
    </body>
</html>