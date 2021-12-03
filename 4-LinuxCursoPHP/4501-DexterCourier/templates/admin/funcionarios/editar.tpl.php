<form action="" method="POST" class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Editar Funcionário</legend>
    
        <div class="control-group">
            <label class="control-label">Nome:</label>
            <div class="controls">
                <input name="nome" value="" class="input-xlarge" type="text">
            </div>
        </div>
            
        <div class="control-group">
            <label class="control-label">Perfil:</label>
            <div class="controls">
            	<select class="span2" name="prf_id">
            	    <option value="">Selecionar</option>
               </select>
            </div>
        </div>
            
        <div class="control-group">
            <label class="control-label">E-mail:</label>
            <div class="controls">
                <input name="email" value="" class="input-xlarge" type="text">
            </div>
        </div>
            
        <div class="control-group">
            <label class="control-label">Senha:</label>
            <div class="controls">
                <input name="senha" class="input-xlarge" type="password">
            </div>
        </div>
            
        <div class="control-group">
            <label class="control-label">Confirme a senha:</label>
            <div class="controls">
                <input name="conf_senha" class="input-xlarge" type="password">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <button class="btn btn-primary">Salvar</button>
            </div>
        </div>

    </fieldset>
</form>
