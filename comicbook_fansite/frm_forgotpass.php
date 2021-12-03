<?php include_once 'frm_header.inc.php'; ?>

<h2>Email Lembrete de Senha</h2>

<p>Esqueceu sua senha? Basta digitar o seu endereço de email, e vamos enviar
    você um novo!</p>

<form method="post" action="frm_transact_user.php">
    <div>
        <label for="email">Endereço Email:</label>
        <input type="text" id="email" name="email" maxlength="100"/>
        <input type="submit" name="action" value="Send my reminder!"/>
    </div>
</form>

<?php include_once 'frm_footer.inc.php';