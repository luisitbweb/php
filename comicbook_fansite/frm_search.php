<?php

require_once 'frm_header.inc.php';

echo '<h2>Procurar Resultados</h2>';

if (isset($_GET['keywords'])) {
    $sql = 'SELECT'
            . '`id`, `topic_id`, `subject`, MATCH(`subject`, `body`) AGAINST("' . $_GET['keywords'] . '") AS `score` FROM '
            . '`frm_posts` WHERE '
            . 'MATCH(`subject`, `body`) AGAINST ("' . $_GET['keywords'] . '") ORDER BY '
            . '`score` DESC';
    $result = mysql_query($sql, $db)or die(mysql_error($db));

    if (mysql_num_rows($result) > 0) {
        echo '<p>Não foram encontrados artigos que correspondam ao termo de pesquisa(s)<strong>"' . $_GET['keywords'] . '"</strong></p>';
    } else {
        echo '<ol>';
        while ($row = mysql_fetch_array($result)) {
            $topicid = ($row['topic_id'] == 0) ? $row['id'] : $row['topic_id'];
            echo '<li><a href="frm_view_topic.php?t=' . $topicid . '#post' . $row['id'] . '">' . $row['subject'] . '</a><br /> relevância: ' . $row['score'] . '</li>';
        }
        echo '</ol>';
    }
}
require_once 'frm_footer.inc.php';