<?php

function msg_box($message, $title, $description = 'frm_index.php') {
    $msg = '<div>';
    $msg .= '<h2>' . $title . '</h2>';
    $msg .= '<p>' . $message . '</p>';
    $msg .= '<p><a href="' . $description . '"> Yes</a>   ou   <a href="frm_index.php">No</a></p>';
    $msg .= '</div>';
    return $msg;
}

function get_forum($db, $id) {
    $sql = 'SELECT'
            . '`forum_name` AS `name`, `forum_desc` AS `description`, `forum_moderator` AS `moderator` FROM'
            . '`frm_forum` WHERE'
            . '`id` =' . $id;
    $result = mysql_query($sql, $db)or die(mysql_error($db));
    $row = mysql_fetch_assoc($result);
    return $row;
}

function get_forum_id($db, $topic_id) {
    $sql = 'SELECT `forum_id` FROM `frm_posts` WHERE `id` =' . $topic_id;
    $result = mysql_query($sql, $db)or die(mysql_error($db));
    $row = mysql_fetch_assoc($result);
    $retVal = $row['forum_id'];
    mysql_free_result($result);
    return $retVal;
}

function breadcrumb($db, $id, $get_from = 'F') {
    $separator = ' &middot; ';
    if ($get_from == 'P') {
        $sql = 'SELECT `forum_id`, `subject` FROM `frm_posts` WHERE `id` =' . $id;
        $result = mysql_query($sql, $db)or die(mysql_error($db));
        $row = mysql_fetch_array($result);
        $id = $row['forum_id'];
        $topic = $row['subject'];
        mysql_free_result($result);
    }
    $row = get_forum($db, $id);

    $bcrumb = '<a href="frm_index.php">Home</a>' . $separator;
    switch ($get_from) {
        case 'P':
            $bcrumb .= '<a href="frm_view_forum.php?f=' . $id . '">' . $row['name'] . '</a>' . $separator . $topic;
            break;
        case 'F':
            $bcrumb .= $row['name'];
            break;
    }
    return '<h2>' . $bcrumb . '</h2>';
}

function show_topic($db, $topic_id, $user_id, $limit = 25) {
    echo breadcrumb($db, $topic_id, 'P');

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start = ($page - 1) * $limit;

    if (isset($_SESSION['user_id'])) {
        echo topic_reply_bar($db, $topic_id, get_forum_id($db, $topic_id));
    }
    $sql = 'SELECT SQL_CALC_FOUND_ROWS'
            . '`p`.`id`, `p`.`subject`, `p`.`body`, `p`.`date_posted`, `p`.`date_updated`, '
            . '`u`.`name` AS `author`, `u`.`id` AS `author_id`, `u`.`signature` AS `sig`, '
            . '`c`.`post_count` AS `postcount`, `p`.`forum_id` AS `forum_id`, '
            . '`f`.`forum_moderator` AS `moderator`, `p`.`update_id`, `u2`.`name` AS `updated_by` '
            . 'FROM'
            . '`frm_forum` f JOIN `frm_posts` p ON `f`.`id` = `p`.`forum_id` JOIN '
            . '`frm_users` u ON `u`.`id` = `p`.`author_id` LEFT JOIN '
            . '`frm_users` u2 ON `u2`.`id` = `p`.`update_id` LEFT JOIN '
            . '`frm_post_count` c ON `u`.`id` = `c`.`user_id`'
            . 'WHERE '
            . '`p`.`topic_id` ="' . $topic_id . '" OR '
            . '`p`.`id` ="' . $topic_id . '"'
            . 'ORDER BY '
            . '`p`.`topic_id`, `p`.`date_posted`'
            . ' LIMIT '
            . '' . $start . ', ' . $limit;
    $result = mysql_query($sql, $db)or die(mysql_error($db));

    $page_links = paginate($db, $limit);
    if (mysql_num_rows($result) == 0) {
        $msg = "There are currently no posts. Would you like to be the first person to create a thread?";
        $title = "No Posts...";
        $dest = "frm_compose.php?forumid=" . $forum_id;
        echo msg_box($msg, $title, $dest);
    } else {
        echo '<table style="width: 80%;">';
        echo '<tr>';
        echo '<th>Author</th>';
        echo '<th style="width: 85%; ">Post</th>';
        echo '</tr>';
        $rowclass = '';

        while ($row = mysql_fetch_array($result)) {
            $lastupdate = '';
            $editlink = '';
            $dellink = '';
            $replylink = '&nbsp;';
            $pcount = '';
            $pdate = '';
            $sig = '';
            $body = $row['body'];

            if (isset($_SESSION['user_id'])) {
                $replylink = '<a href="frm_compose.php?forumid=' . $row['forum_id'] . '&topicid=' . $topic_id . '&reid=' . $row['id'] . '">Reply</a>  ';
            } else {
                $replylink = '';
            }
            if ($row['update_id'] > 0) {
                $lastupdate = '<p>Last updated: ' . $row['date_updated'] . 'by' . $row['updated_by'] . '</p>';
            }
            if ($user_id == $row['author_id'] || $user_id == $row['moderator'] || (isset($_SESSION['access_lvl']) && $_SESSION['access_lvl'] > 2)) {
                $editlink = '  <a href="frm_compose.php?a=edit&post=' . $row['id'] . '">EDIT</a>  ';
                $dellink = '  <a href="frm_transact_affirm.php?action=deletepost&id=' . $row['id'] . '">DELETE</a>';
            }
            $pcount = '<br />Posts: ' . ($row['postcount'] == '' ? 0 : $row['postcount']);
            $pdate = $row['date_posted'];
            $sig = (($row['sig'] != '') ? '<p class="sig">' . bbcode($db, nl2br($row['sig'])) : '') . '</p>';
            $rowclass = ($rowclass == 'odd_row') ? 'even_row' : 'odd_row';
            echo '<tr class="' . $rowclass . '">';
            echo '<td>' . $row['author'];
            echo $pcount;
            echo '</td><td><p>';

            if (isset($_SESSION['user_id']) && $_SESSION['last_login'] < $row['date_posted']) {
                echo NEWPOST . ' ';
            }
            if (isset($_GET['page'])) {
                $pagelink = '&page=' . $_GET['page'];
            } else {
                $pagelink = '';
            }
            echo '<a name="post' . $row['id'] . '" href="frm_view_topic.php?t=' . $topic_id . $pagelink . '#post' . $row['id'] . '">' . POSTLINK . '</a>';

            if (isset($row['subject'])) {
                echo ' <strong>' . $row['subject'] . '</strong>';
            }
            echo '</p><p>' . bbcode($db, nl2br(htmlspecialchars($body))) . '</p>';
            echo $sig;
            echo $lastupdate;
            echo '</td>';
            echo '</tr><tr class="' . $rowclass . '">';
            echo '<td>' . $pdate . '</td>';
            echo '<td style="text-align: right;">';
            echo $replylink;
            echo $editlink;
            echo $dellink;
            echo ',</td></tr>';
        }
        echo '</table>';
        echo $pagelink;
        echo '<p>' . NEWPOST . ' = New Post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo POSTLINK . ' = Post link (use to bookmark)</p>';
    }
}

function isParent($page) {
    return (strpos($_SERVER['PHP_SELF'], $page) !== FALSE);
}

function topic_reply_bar($db, $topic_id, $forum_id) {
    $html = '<p>';

    if ($topic_id > 0) {
        $html .= '<a href="frm_compose.php?forumid=' . $forum_id . '&topicid=' . $topic_id . '&reid=' . $topic_id . '">Reply to Thread</a>  ';
    }
    if ($forum_id > 0) {
        $html .= '  <a href="frm_compose.php?forumid=' . $forum_id . '">New Thread</a>';
    }
    $html .= '</p>';
    return $html;
}

function user_option_list($db, $level) {
    $sql = 'SELECT'
            . '`id`, `name`, `access_lvl` FROM'
            . '`frm_users` WHERE'
            . '`access_lvl` =' . $level . ' ORDER BY'
            . '`name`';
    mysql_query($sql, $db)or die(mysql_error($db));

    while ($row = mysql_fetch_array($result)) {
        echo '<option value="' . $row['id'] . '">"' . htmlspecialchars($row['name']) . '"</option>';
    }
    mysql_free_result($result);
}

function paginate($db, $limit = 10) {
    global $admin;

    $sql = 'SELECT FOUND_ROWS()';
    $result = mysql_query($sql, $db)or die(mysql_error($db));
    $row = mysql_fetch_array($result);
    $numrows = $row[0];
    $pagelinks = '<p>';

    if ($numrows > $limit) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $currpage = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
        $currpage = str_replace('&page=' . $page, '', $currpage);

        if ($page == 1) {
            $pagelinks .= '&lt; PREV';
        } else {
            $pageprev = $page - 1;
            $pagelinks .= '<a href="' . $currpage . '&page=' . $pageprev . '">&lt; PREV</a>';
        }
        $numofpages = ceil($numrows / $limit);
        $range = $admin['pageRange']['value'];
        if ($range == '' or $range == 0) {
            $range = 7;
        }
        $lrange = max(1, $page - (($range - 1) / 2));
        $rrange = min($numofpages, $page + (($range - 1) / 2));

        if (($rrange - $lrange) < ($range - 1)) {
            if ($lrange == 1) {
                $rrange = min($lrange + ($range - 1), $numofpages);
            } else {
                $lrange = max($rrange - ($range - 1), 0);
            }
        }
        if ($lrange > 1) {
            $pagelinks .= '..';
        } else {
            $pagelinks .= '&nbsp;&nbsp;';
        }
        for ($i = 1; $i <= $numofpages; $i++) {
            if ($i == $page) {
                $pagelinks .= $i;
            } else {
                if ($lrange <= $i and $i <= $rrange) {
                    $pagelinks .= '<a href="' . $currpage . '&page=' . $i . '">' . $i . '</a>';
                }
            }
        }
        if ($rrange < $numofpages) {
            $pagelinks .= '..';
        } else {
            $pagelinks .= '&nbsp;&nbsp;';
        }

        if (($numrows - ($limit * $page)) > 0) {
            $pagenext = $page + 1;
            $pagelinks .= '<a href="' . $currpage . '&page=' . $pagenext . '">NEXT &gt;</a>';
        } else {
            $pagelinks .= 'NEXT &gt;';
        }
    } else {
        $pagelinks .= '&lt; PREV&nbsp;NEXT &gt;&nbsp;&nbsp;';
    }
    $pagelinks .= '</p>';
    return $pagelinks;
}

function bbcode($db, $data) {
    $sql = 'SELECT'
            . '`template`, `replacement` FROM'
            . '`frm_bbcode`';
    $result = mysql_query($sql, $db)or die(mysql_error($db));

    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
            $bbcode['tpl'][] = '/' . html_entity_decode($row['template'], ENT_QUOTES) . '/i';
            $bbcode['rep'][] = html_entity_decode($row['replacement'], ENT_QUOTES);
        }
        $data1 = preg_replace($bbcode['tpl'], $bbcode['rep'], $data);
        $count = 1;
        while (($data1 != $data) and ( $count < 4)) {
            $count++;
            $data = $data1;
            $data1 = preg_replace($bbcode['tpl'], $bbcode['rep'], $data);
        }
    }
    return $data;
}