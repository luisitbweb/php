<?php 
use Model\Perfis;
?>
<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Menus</legend>
    
        <div class="btn-toolbar">
            <a href="admin.php?modulo=Menus&acao=inserir" class="btn"><i class="icon-plus"></i> <strong>Novo Menu</strong></a>
        </div>    
    
        <div class="well">
         
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descricao</th>
                        <th>Link</th>
                        <th>Perfil</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #inicio do Laço ?>
                        <tr>
                            <td><?php #id ?></td>
                            <td><?php #descricao ?></td>
                            <td><?php #link ?></td>
                            <td><?php #perfil ?></td>
                            <td>
                                <a href=""><i class="icon-edit"></i> <strong>Editar</strong></a>
                                -
                                <a href=""><i class="icon-trash"></i> <strong>Excluir</strong></a>
                            </td>
                        </tr>
                    <?php #fim Laço ?>
                </tbody>
            </table>
 
        </div>
        
    </fieldset>
</form>
