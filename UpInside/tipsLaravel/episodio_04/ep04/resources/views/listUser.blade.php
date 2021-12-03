<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Detalhes do Usuarios</title>
    </head>
    <body>
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>
        <p>{{ date('d/m/Y H:i:s', strtotime($user->created_at)) }}</p>
    </body>
</html>