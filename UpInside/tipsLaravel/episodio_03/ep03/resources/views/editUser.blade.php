<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update Usuario</title>
    </head>
    <body>
        <form action="{{ route('users.edit', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('PUT')
            <label for="">Nome do Usuario:</label>
            <input type="text" name="name" value="{{ $user->name }}"><br />
            
            <label for="">E-mail do Usuario:</label>
            <input type="email" name="email" value="{{ $user->email }}"><br />
            
            <label for="">Senha do Usuario:</label>
            <input type="password" name="password"><br />

            <input type="submit" value="Update usuario">
        </form>
    </body>
</html>