<form action=""  method="POST" class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Editar Menu</legend>
                
        <div class="control-group">
            <label class="control-label">Descrição:</label>
            <div class="controls">
                <input name="descricao" value="" class="input-xlarge" type="text">
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
            <label class="control-label">Link:</label>
            <div class="controls">
                <input name="link" value="" class="input-xlarge" type="text">
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
