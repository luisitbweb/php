<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Tipos de Encomenda</legend>
    
        <div class="btn-toolbar">
            <a href="admin.php?modulo=TiposEncomendas&acao=inserir" class="btn"><i class="icon-plus"></i> <strong>Novo Tipo de Encomenda</strong></a>
        </div>    
    
        <div class="well">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Valor KM</th>
                        <th>Prazo Máximo</th>
                        <th>Criado em</th>
                        <th>Atualizado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #Inicio do Laço ?>
                        <tr>
                            <td><?php #id; ?></td>
                            <td><?php #nome ?></td>
                            <td><?php #valor; ?></td>
                            <td><?php #prazo; ?></td>
                            <td><?php #dt_criacao ?></td>
                            <td><?php #dt_edicao ?></td>
                            <td>
                                <a href=""><i class="icon-edit"></i> <strong>Editar</strong></a>
                                -
                                <a href=""><i class="icon-trash"></i> <strong>Excluir</strong></a>
                            </td>
                        </tr>
                    <?php #fim laco; ?>
                </tbody>
            </table>
      
        </div>
        
    </fieldset>
</form>
