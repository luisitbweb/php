<form class="form-horizontal" action="" method="POST">
    <fieldset>

        <!-- Form Name -->
        <legend>Rastrear Encomendas</legend>
    
        <div class="control-group">
            <label class="control-label">Código da encomenda:</label>
            <div class="controls">
                <input class="span4" type="text" placeholder="ex: 1" name="enc_id" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <button class="btn btn-primary">Rastrear</button>
            </div>
        </div>
        
        <?php if($dados): ?>
        <div class="well">
            
            <fieldset>
                <!-- Form Name -->
                <legend>Dados da encomenda</legend>
        
                <table class="table">
                    <thead>
                        <tr>
                            <th>Origem</th>
                            <th>Localização Atual</th>
                            <th>Destino</th>
                            <th>Última Atualização</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $dados[0]->origem; ?></td>
                            <td><?php echo $dados[0]->destino; ?></td>
                            <td><?php echo $dados[0]->atual; ?></td>
                            <td><?php echo $dados[0]->dt_edicao; ?></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            
        </div>
                    
        <?php endif; ?>        
        
    </fieldset>
</form>