<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Encomendas</legend>
    
        <div class="btn-toolbar">
            <a href="admin.php?modulo=Encomendas&acao=inserir" class="btn"><i class="icon-plus"></i> <strong>Nova Encomenda</strong></a>
        </div>    
    
        <div class="well">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Localização atual</th>
                        <th>Criado em</th>
                        <th>Atualizado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #inicio do laco ?>
                        <tr>
                            <td><?php #id ?></td>
                            <td><?php #origem ?></td>
                            <td><?php #destino ?></td>
                            <td><?php #atual; ?></td>
                            <td><?php #dt_criacao ?></td>
                            <td><?php #dt_edicao ?></td>
                            <td>
                                <a href=""><i class="icon-edit"></i> <strong>Editar</strong></a>
                                -
                                <a href=""><i class="icon-trash"></i> <strong>Excluir</strong></a>
                            </td>
                        </tr>
                    <?php #fim Laco ?>
                </tbody>
            </table>

        </div>
        
    </fieldset>
</form>
