<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Post</title>
    </head>
    <body>
        <form action="{{ route('debug') }}" method="post">
            <lable for="title" >Titulo</lable>
            @csrf
            <input type="text" name="title" id="title">
            
            <lable for="subtitle">Sub-Titulo</lable>
            <input type="text" name="subtitle" id="subtitle"><br />
            
            <br /><label for="content">Conteudo do Artigo</label>
            <textarea style="resize: vertical" name="content" id="content" cols="30" rows="10"></textarea><br />
            
            <br /><input type="submit" value="Cadastrar Arquivo">
        </form>
    </body>
</html>