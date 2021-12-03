<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Conteúdos</legend>
    
        <div class="btn-toolbar">
            <a href="admin.php?modulo=Conteudos&acao=inserir" class="btn"><i class="icon-plus"></i> <strong>Novo Conteúdo</strong></a>
        </div>    
    
        <div class="well">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #inicio Laco ?>
                        <tr>
                            <td><?php #id ?></td>
                            <td><?php #titulo ?></td>
                            <td>
                                <a href=""><i class="icon-edit"></i> <strong>Editar</strong></a>
                                -
                                <a href=""><i class="icon-trash"></i> <strong>Excluir</strong></a>
                            </td>
                        </tr>
                    <?php #fim laco ?>
                </tbody>
            </table>

        </div>
        
    </fieldset>
</form>
