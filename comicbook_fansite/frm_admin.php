<?php require_once 'frm_header.inc.php'; ?>

<script type="text/javascript">
    function delBBCode(id) {
        window.location = 'frm_transact_admin.php?action=deleteBBCode&b=' + id;
    }

    function delForum(id) {
        window.location = 'frm_transact_affirm.php?action=deleteForum&f=' + id;
    }
</script>

<?php
$sql = 'SELECT'
        . '`access_lvl`, `access_name` FROM'
        . '`frm_access_levels` ORDER BY'
        . '`access_lvl` DESC';
$result = mysql_query($sql, $db)or die(mysql_error($db));

while ($row = mysql_fetch_array($result)) {
    $a_users[$row['access_lvl']] = $row['access_name'];
}

$menuoption = 'boardadmin';

if (isset($_GET['option']))
    $menuoption = $_GET['option'];

$menuItems = ['boardadmin' => 'Board Admin', 'edituser' => 'Users', 'forums' => 'Forums', 'bbcode' => 'BBcode'];

echo '<p>|';

foreach ($menuItems as $key => $value) {
    if ($menuoption != $key) {
        echo '<a href="' . $_SERVER['PHP_SELF'] . '?option=' . $key . '">';
    }
    echo ' ' . $value . ' ';

    if ($menuoption != $key) {
        echo '</a>';
    }
    echo '|';
}

echo '</p>';

switch ($menuoption) {
    case 'boardadmin':
        ?>

        <h2>Administrador Board</h2>
        <form method="post" action="frm_transact_admin.php">

            <table>
                <tr>
                    <th>Titulo</th>
                    <th>Valor</th>
                    <th>Parametro</th>
                </tr>

                <?php
                foreach ($admin as $key => $value) {
                    echo '<tr>';
                    echo '<td>' . $value['title'] . '</td>';
                    echo '<td><input type="text" name="' . $key . '" value="' . $value['value'] . '" size="60" /></td>';
                    echo '<td>' . $key . '</td>';
                    echo '</tr>';
                }
                ?>

            </table>

            <p><input type="submit" name="action" id="Update" value="Update"/></p>
        </form>

        <?php
        break;

    case 'edituser':
        ?>

        <h2>Usuario Administrador</h2>
        <div id="users">
            <form action="frm_transact_admin.php" method="post">
                <div>
                    <label for="userlist">Por favor selecione um usuario para gerenciar:</label>
                    <select id="userlist" name="userlist[]">

                        <?php
                        foreach ($a_users as $key => $value) {
                            echo '<optgroup label="' . $value . '">' . user_option_list($db, $key) . '</optgroup>';
                        }
                        ?>
                    </select>
                    <input type="submit" name="action" value="Modify User"/>
                </div>
            </form>

            <?php
            break;

        case 'forums':
            ?>

            <h2>Forum Administrador</h2>
            <table>
                <tr><th colspan="3">Forum</th></tr>

                <?php
                $sql = 'SELECT'
                        . '`id`, `forum_name`, `forum_desc` FROM'
                        . '`frm_forum`';
                $result = mysql_query($sql, $db)or die(mysql_error($db));

                while ($row = mysql_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['forum_name'] . '<br />' . $row['forum_desc'] . '</td>';
                    echo '<td><a href="frm_edit_forum.php?forum=' . $row['id'] . '">Edit</a></td>';
                    echo '<td><a href="#" onclick="delForum(' . $row['id'] . '); return FALSE;">Delete</a></td>';
                    echo '</tr>';
                }
                ?>

            </table>
            <p><a href="frm_edit_forum.php">Novo Forum</a></p>

            <?php
            break;

        case 'bbcode':
            ?>

            <h2>BBcode Administrador</h2>
            <form method="post" action="frm_transact_admin.php">
                <table>
                    <tr>
                        <th>Modelo</th>
                        <th>Substituição</th>
                        <th>Ação</th>
                    </tr>

                    <?php
                    if (isset($bbcode)) {
                        foreach ($bbcode as $key => $value) {
                            echo '<tr>';
                            echo '<td><input type="text" name="bbcode_t' . $key . '" value="' . $value['template'] . '" size="32"/></td>';
                            echo '<td><input type="text" name="bbcode_r' . $key . '" value="' . $value['replacement'] . '" size="32"/></td>';
                            echo '<td><input type="button" name="action" id="DelBBCode" value="Delete" onclick="delBBCode(' . $key . '); return FALSE; "/></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                    <tr>
                        <td><input type="text" name="bbcode-tnew" size="32"/></td>
                        <td><input type="text" name="bbcode-rnew" size="32"/></td>
                        <td><input type="submit" name="action" id="AddBBCode" value="Add New"/></td>
                    </tr>
                </table>
                <p><input type="submit" name="action" id="Update" value="Update BBCodes"/></p>
            </form>

            <?php
            break;
    }
    require_once 'frm_footer.inc.php';
    