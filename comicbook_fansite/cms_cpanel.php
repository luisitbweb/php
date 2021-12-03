<?php
require_once 'db.inc.php';
require_once 'cms_output_functions.inc.php';
require_once 'cms_header.inc.php';

echo '<hr>';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$sql = 'SELECT'
        . '`email`, `name` FROM'
        . '`cms_users` WHERE'
        . '`user_id` =' . $_SESSION['user_id'];
$result = mysql_query($sql, $db)or die(mysql_error($db));

$row = mysql_fetch_array($result);
extract($row);
mysql_free_result($result);
?>

<h2>Informações Usuario</h2>

<form method="post" action="cms_transact_user.php">
    <table>
        <tr>
            <td><label for="name">Nome completo:</label></td>
            <td><input type="text" name="name" id="name" maxlength="100" value="<?php echo htmlspecialchars($name); ?>"/></td>
        </tr>
        <tr>
            <td><label for="email">Endereço Email:</label></td>
            <td><input type="text" id="email" name="email" maxlength="100" value="<?php echo htmlspecialchars($email); ?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="action" value="Change my info"/></td>
        </tr>
    </table>
</form>

<?php
echo '<h2>Artigos Pendentes</h2>';

$sql = 'SELECT'
        . '`article_id`, UNIX_TIMESTAMP(submit_date) AS submit_date, `title` FROM'
        . '`cms_articles` WHERE'
        . '`is_published` = FALSE AND'
        . '`user_id` ="' . $_SESSION['user_id'] . '" ORDER BY'
        . '`submit_date` ASC';
$result = mysql_query($sql, $db)or die(mysql_error($db));

if (mysql_num_rows($result) == 0) {
    echo '<p><strong>Atualmente não há artigos pendentes.</strong></p>';
} else {
    echo '<ul>';
    while ($row = mysql_fetch_array($result)) {
        echo '<li><a href="cms_review_article.php?article_id="' . $row['article_id'] . '">' . htmlspecialchars($row['tile']) . '</a> (submitted ' . date('F j, Y', $row['submit_date']) . ')</li>';
    }
    echo '</ul>';
}
mysql_free_result($result);

echo '<h2>Artigos Publicados</h2>';

$sql = 'SELECT'
        . '`article_id`, UNIX_TIMESTAMP(publish_date) AS publish_date, `title` FROM'
        . '`cms_articles` WHERE'
        . '`is_published` = TRUE AND'
        . '`user_id` ="' . $_SESSION['user_id'] . '" ORDER BY'
        . '`publish_date` ASC';
$result = mysql_query($sql, $db)or die(mysql_error($db));

if (mysql_num_rows($result) == 0) {
    echo '<p><strong>Atualmente não há artigos publicados.</strong></p>';
} else {
    echo '<ul>';
    while ($row = mysql_fetch_array($result)) {
        echo '<li><a href="cms_review_article.php?article_id="' . $row['article_id'] . '">' . htmlspecialchars($row['title']) . '</a> (published ' . date('F j, Y', $row['publish_date']) . ')</li>';
    }
    echo '</ul>';
}
mysql_free_result($result);
include_once 'cms_footer.inc.php';
