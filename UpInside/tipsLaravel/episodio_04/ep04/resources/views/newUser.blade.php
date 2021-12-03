<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Usuario</title>
    </head>
    <body>
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <label for="">Nome do Usuario:</label>
            <input type="text" name="name"><br />
            
            <label for="">E-mail do Usuario:</label>
            <input type="email" name="email"><br />
            
            <label for="">Senha do Usuario:</label>
            <input type="password" name="password"><br />

            <input type="submit" value="Cadastrar usuario">
        </form>
    </body>
</html>