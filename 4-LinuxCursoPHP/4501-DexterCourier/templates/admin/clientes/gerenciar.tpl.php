<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Clientes</legend>
    
        <div class="btn-toolbar">
            <a href="admin.php?modulo=Clientes&acao=inserir" class="btn"><i class="icon-plus"></i> <strong>Novo Cliente</strong></a>
        </div>    
    
        <div class="well">
            
            <table class="table">
                <thead>
                    <tr>
								<th>#</th>
                        <th>Nome / Razão Social</th>
                        <th>CPF / CNPJ</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #inicio do laco ?>
                        <tr>
                            <td><?php #id ?></td>
									 <td><?php #Nome_Razao ?></td>
                            <td><?php #cpf_cnpj ?></td>
                            <td><?php #email ?></td>
                            <td><?php #telefone ?></td>
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
