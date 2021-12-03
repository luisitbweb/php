<?php include_once 'cms_header.inc.php'; ?>

<hr>
<h1>Email Lembrete de Senha</h1>
<p>Esqueceu sua senha? Basta digitar o seu endereço de email, e vamos enviar uma nova a você!</p>
<form method="post" action="cms_transact_user.php">
    <div>
        <label for="email">Endereço Email:</label>
        <input type="text" id="email" name="email" maxlength="100"/>
        <input type="submit" name="action" value="Enviar minha redefinição!"/>
    </div>
</form>

<?php
include_once 'cms_footer.inc.php';
