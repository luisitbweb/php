<?php

if (!isset($_GET['f'])) {
    header('Location: frm_index.php');
}

require_once 'frm_header.inc.php';

$forumid = $_GET['f'];
$forum = get_forum($db, $forumid);

echo breadcrumb($db, $forumid, 'F');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$limit = $admin['pageLimit']['value'];

if ($limit == '') {
    $limit = 25;
}

$start = ($page - 1) * $admin['pageLimit']['value'];

$sql = 'CREATE TEMPORARY TABLE tmp('
        . 'topic_id INTEGER UNSIGNED NOT NULL DEFAULT 0, '
        . 'postdate DATETIME NOT NULL)';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'LOCK TABLES `frm_users` READ, `frm_posts` READ';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT INTO `tmp` SELECT '
        . '`topic_id`, MAX(`date_posted`) FROM '
        . '`frm_posts` WHERE'
        . '`forum_id` ="' . $forumid . '" AND `topic_id` > 0 GROUP BY '
        . '`topic_id`';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'UNLOCK TABLES';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'SELECT SQL_CALC_FOUND_ROWS '
        . '`t`.`id` AS `topic_id`, `t`.`subject` AS `t_subject`, `u`.`name` AS `t_author`, '
        . 'COUNT(`p`.`id`) AS `numreplies`, `t`.`date_posted` AS `t_posted`, `tmp`.`postdate` AS `re_posted` FROM '
        . '`frm_users` u JOIN `frm_posts` t ON `t`.`author_id` = `u`.`id` '
        . 'LEFT JOIN `tmp` ON `t`.`id` = `tmp`.`topic_id` '
        . 'LEFT JOIN `frm_posts` p ON `p`.`topic_id` = `t`.`id` WHERE '
        . '`t`.`forum_id` =' . $forumid . ' AND `t`.`topic_id` = 0 '
        . 'GROUP BY `t`.`id` ORDER BY '
        . '`re_posted` DESC '
        . 'LIMIT ' . $start . ', ' . $limit;
$result = mysql_query($sql, $db)or die(mysql_error($db));

$numrows = mysql_num_rows($result);

if ($numrows == 0) {
    $msg = 'Atualmente não há mensagens. Gostaria de ser a primeira pessoa a criar uma lista de discussão?';
    $title = 'Bem vindo a ' . $forum['name'];
    $dest = 'frm_compose.php?forumid=' . $forumid;
    echo msg_box($msg, $title, $dest);
} else {
    if (isset($_SESSION['user_id'])) {
        echo topic_reply_bar($db, 0, $_GET['f']);
    }
    ?>
    <table style="width: 80%;">
        <tr>
            <th style="width: 50%;">Thread</th>
            <th>Author</th>
            <th>Replies</th>
            <th>Last Post</th>
        </tr>

        <?php

        $rowclass = '';
        while ($row = mysql_fetch_array($result)) {
            $rowclass = ($rowclass == 'odd_row') ? 'even_row' : 'odd_row';
            if ($row['re_posted'] == '') {
                $lastpost = $row['t_posted'];
            } else {
                $lastpost = $row['re_posted'];
            }
            if (isset($_SESSION['user_id']) && $_SESSION['last_login'] < $lastpost) {
                $newpost = TRUE;
            } else {
                $newpost = FALSE;
            }
            echo '<tr class="' . $rowclass . '">';
            echo '<td>' . (($newpost) ? NEWPOST . '&nbsp;' : '') . '<a href="frm_view_topic.php?t=' . $row['topic_id'] . '">' . $row['t_subject'] . '</a></td>';
            echo '<td>' . $row['t_author'] . '</td>';
            echo '<td>' . $row['numreplies'] . '</td>';
            echo '<td>' . $lastpost . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo paginate($db, $limit);
        echo '<p>' . NEWPOST . ' New Post(s)</p>';
    }
    $sql = 'DROP TABLE `tmp`';
    mysql_query($sql, $db)or die(mysql_error($db));

    require_once 'frm_footer.inc.php';