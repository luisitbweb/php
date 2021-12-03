<?php include_once 'cms_header.inc.php'; ?>

<hr>
<h1>Acesso de membro</h1>
<form method="post" action="cms_transact_user.php">
    <table>
        <tr>
            <td><label for="email">Endereço Email:</label></td>
            <td><input type="text" id="email" name="email" maxlength="100"/></td>
        </tr>
        <tr>
            <td><label for="password">Senha:</label></td>
            <td><input type="password" id="password" name="password" maxlength="20"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="action" value="Login"/></td>
        </tr>
    </table>
</form>
<p>Ainda não é membro? <a href="cms_user_account.php">Criar uma nova conta!</a></p>
<p><a href="cms_forgot_password.php">Esqueceu sua senha?</a></p>

<?php
include_once 'cms_footer.inc.php';
