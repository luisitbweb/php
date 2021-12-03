<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Funcionários</legend>
    
        <div class="btn-toolbar">
            <a href="admin.php?modulo=Funcionarios&acao=inserir" class="btn"><i class="icon-plus"></i> <strong>Novo Funcionário</strong></a>
        </div>    
    
        <div class="well">
           
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Perfil</th>
                        <th>E-mail</th>
                        <th>Senha</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #inicio do Laço ?>
                        <tr>
                            <td><?php #id ?></td>
                            <td><?php #nome ?></td>
                            <td><?php #perfis ?></td>
                            <td><?php #email ?></td>
                            <td><?php #senha ?></td>
                            <td>
                                <a href=""><i class="icon-edit"></i> <strong>Editar</strong></a>
                                -
                                <a href=""><i class="icon-trash"></i> <strong>Excluir</strong></a>
                            </td>
                        </tr>
                    <?php #fim do Laco ?>
                </tbody>
            </table>
        </div>
        
    </fieldset>
</form>
