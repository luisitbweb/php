<?php
require_once 'frm_header.inc.php';

$sql = 'SELECT f.id AS id, f.forum_name AS forum, f.forum_desc AS description, '
        . 'COUNT(forum_id) AS threads, u.name AS moderator FROM frm_forum f '
        . 'LEFT JOIN frm_posts p ON f.id = p.forum_id AND p.topic_id = 0 '
        . 'LEFT JOIN frm_users u ON f.forum_moderator = u.id GROUP BY f.id';
$result = mysql_query($sql, $db)or die(mysql_error($db));

if (mysql_num_rows($result) == 0){
    echo '<h2>Atualmente não há fóruns para ver.</h2>';
}  else {
    ?>

<table>
    <tr>
        <th>Forum</th>
        <th>Threads</th>
        <th>Moderator</th>
    </tr>
    <?php
    $odd = TRUE;
    while ($row = mysql_fetch_array($result)){
        echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
        $odd = !$odd;
        echo '<td><a href="frm_view_forum.php?f=' . $row['id'] . '">' . $row['forum'] . '</a><br />'
                . '' .$row['description'] . '</td>';
                echo '<td style="text-align: center; ">' . $row['threads'] . '</td>';
                echo '<td>' . $row['moderator'] . '</td>';
                echo '</tr>';
    }
echo '</table>';
}

require_once 'frm_footer.inc.php';