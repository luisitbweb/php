<?php include_once 'frm_header.inc.php'; ?>

<h1>Membro Login</h1>
<form method="post" action="frm_transact_user.php">
    <table>
        <tr>
            <td><label for="email">Endereço Email:</label></td>
            <td><input type="text" id="email" name="email" maxlength="100"/></td>
        </tr>
        <tr>
            <td><label for="passwd">Senha:</label></td>
            <td><input type="password" id="passwd" name="passwd" maxlength="20"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="submit" name="action" value="Login"/></td>
        </tr>
    </table>
</form>
<p>Não e um membro ainda? <a href="frm_useraccount.php">Criar uma nova Conta!</a></p>
<p><a href="frm_forgotpass.php">esqueceu sua senha?</a></p>

<?php include_once 'frm_footer.inc.php';