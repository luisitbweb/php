<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Banners</legend>
    
        <div class="btn-toolbar">
            <a href="admin.php?modulo=Banners&acao=inserir" class="btn"><i class="icon-plus"></i> <strong>Novo Banner</strong></a>
        </div>    
    
        <div class="well">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descricao</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #inicio do laco ?>
                        <tr>
                            <td><?php #id ?></td>
                            <td><?php #descricao ?></td>
                            <td>
                                <a href=""><i class="icon-edit"></i> <strong>Editar</strong></a>
                                -
                                <a href=""><i class="icon-trash"></i> <strong>Excluir</strong></a>
                            </td>
                        </tr>
                    <?php #fim do laco ?>
                </tbody>
            </table>

        </div>
        
    </fieldset>
</form>
