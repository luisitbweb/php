<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario Universal</title>
        <style>
            td{vertical-align: top;}
        </style>
    </head>
    <body>
        <form action="form4a.php" method="post">
            <table>
                <tr>
                    <td>Nome</td>
                    <td><input type="text" name="name"/></td>
                </tr>
                <tr>
                    <td>Tipos Itens</td>
                    <td>
                        <label for="filme"><input type="radio" name="type" id="filme" value="movie" checked="checked"/>Filme<br /></label>
                        <label for="ator"><input type="radio" name="type" id="ator" value="actor"/>Ator<br /></label>
                        <label for="diretor"><input type="radio" name="type" id="diretor" value="director"/>Diretor<br/></label>
                    </td>
                </tr>
                <tr>
                    <td>Tipos de Filmes<br/><small>(Se Aplicavel)</small></td>
                </tr>
                <tr>
                    <td>
                        <select name="movie_type">
                            <option value="">Selecione um tipo de filme..</option>
                            <option value="Filme Ação">Ação</option>
                            <option value="Filme Drama">Drama</option>
                            <option value="Filme Comedia">Comedia</option>
                            <option value="Filme Ficção Cientifica">Ficção Cientifica</option>
                            <option value="Filme guerra">Guerra</option>
                            <option value="Outros">Outros..</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="checkbox" name="debug" checked="checked"/>Exebir informação de depuração</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="submit" value="Pesquisa"/>
                        <input type="submit" name="submit" value="Adicionar"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>