<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Contato</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="_css/contato.css"/>
        <script type="text/javascript" src="_JavaScript/Layout.js"></script>
    </head>
    <body>
        <div id="inface">

            <?php
            require('header.inc');
            ?>
            <?php
            require('menu.inc');
            ?>

            <h1>Formulário de Contato:</h1>

            <form method="POST" id="fcontato" action="mailto:lusitb@ig.com.br" oninput="calc_total();">
                <fieldset id="usuario">
                    <legend>Identificação do Usuário</legend>
                    <p><label for="cnome">Nome:&nbsp;</label><input type="text" name="tnome" id="cnome" size="30" maxlength="40" placeholder="Nome Completo" autofocus="autofocus"/></p>
                    <p><label for="cmail">E-mail:&nbsp;</label><input type="email" name="tmail" id="cmail" size="30" maxlength="40" placeholder="exemplo@gmail.com"/></p>
                    <fieldset id="sexo">
                        <legend>Sexo:</legend>
                        <input type="radio" name="tsexo" id="cmasc" checked/><label for="cmasc">Masculino</label><br />
                        <input type="radio" name="tsexo" id="cfem"/><label for="cfem">Feminino</label>
                    </fieldset>
                    <p><label for="cnasc">Data de Nascimento:&nbsp;</label><input type="date" name="tnasc" id="cnasc" placeholder="12/12/2015"/></p>
                </fieldset>

                <fieldset id="endereco">
                    <legend>Endereço do Usuário</legend>
                    <p><label for="crua">Logradouro:&nbsp;</label><input type="text" name="trua" id="crua" size="13" maxlength="80" placeholder="Rua, Av, Trav, ..."/></p>
                    <p><label for="cnum">Número:&nbsp;</label><input type="number" name="tnum" id="cnum" min="0" max="9999"/></p>
                    <p><label for="cest">Estado:&nbsp;</label>
                        <select name="test" id="cest">
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AM">AM</option>
                            <option value="AP">AP</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MG">MG</option>
                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="PR">PR</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="RS">RS</option>
                            <option value="SC">SC</option>
                            <option value="SE">SE</option>
                            <option value="SP">SP</option>
                            <option value="TO">TO</option>
                        </select></p>
                    <p><label for="ccid">Cidade:&nbsp;</label><input type="text" name="tcid" id="ccid" size="15" maxlength="40" placeholder="Sua Cidade" list="cidade"/></p>
                    <datalist id="cidade">
                        <option value="Rio de Janeiro"></option>
                        <option value="Nova Iguaçu"></option>
                        <option value="Itumbiara"></option>
                    </datalist>
                </fieldset>

                <fieldset id="mensagem">
                    <legend>Mensagem do Usuário</legend>
                    <p><label for="curg">Grau de Urgência:&nbsp;</label> Mín <input type="range" name="turg" id="curg" min="0" max="10" step="2"/> Máx </p>
                    <p><label for="cmsg">Mensagem:&nbsp;</label><textarea name="tmsg" id="cmsg" cols="35" rows="5" placeholder="Digite aqui sua mensagem"></textarea></p>
                </fieldset>

                <input id="envbot" alt="botao-enviar" type="image" name="tenviar" src="_imagens/botao-enviar.png"/>

            </form>                 
            <?php
            require('footer.inc');
            ?>

        </div>
    </body>
</html>