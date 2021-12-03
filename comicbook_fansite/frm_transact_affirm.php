<?php
require 'frm_header.inc.php';
?>

<script type="text/javascript">
function deletePost(id, redir){
    if(id > 0){
        window.location = 'frm_transact_post.php?action=delete&post=' + id + '&r=' + redir;
    }else{
        history.back();
    }
}

function deleteForum(id){
    if(id > 0){
        window.location = 'frm_transact_admin.php?action=deleteForum&f=' + id;
    }else{
        history.back();
    }
}
</script>

<?php
switch (strtoupper($_REQUEST['action'])){
case 'DELETEPOST':
    $sql = 'SELECT'
        . '`id`, `topic_id`, `forum_id`, `subject` FROM'
        . '`frm_posts` WHERE'
        . '`id` =' . $_REQUEST['id'];
    $result = mysql_query($sql, $db)or die(mysql_error($db));
    $row = mysql_fetch_array($result);
    
    if ($row['topic_id'] > 0){
        $msg = 'Are you sure you wish to delete the post<br /><em>' . $row['subject'] . '</em>?';
        $redir = htmlspecialchars('frm_view_topic.php?t=' . $row['topic_id']);
    }  else {
        $msg = 'If you delete this post, all replies will be deleted as well. Are you sure you wish to delete the entire thread<br /><em>' . $row['subject'] . '</em>?';
        $redir = htmlspecialchars('frm_view_forum.php?f=' . $row['forum_id']);
    }
    echo '<div>';
    echo '<h2>DELETE POST?</h2>';
    echo '<p>' . $msg . '</p>';
    echo '<p><a href="#" onclick="deletePost(' . $row['id'] . ', \'' . $redir . '\');
    return FALSE; ">Yes</a> <a> href="#" onclick="history.back(); return FALSE; ">No</a></p>';
    echo '</div>';
    break;
    
    case 'DELETEFORUM':
        $sql = 'SELECT'
            . '`forum_name` FROM'
            . '`frm_forum` WHERE'
            . '`id` =' . $_REQUEST['f'];
        $result = mysql_query($sql, $db)or die(mysql_error($db));
        $row = mysql_fetch_array($result);
        echo '<div>';
        echo '<h2>DELETE Forum?</h2>';
        echo '<p> If ou delete this forum, all topics and replies will be'
        . 'deleted as well. Are you sure you wish to delete the entire forum<br /><em>' . $row['forum_name'] . '</em>?</p>';
        echo '<p><a href="#" onclick="deleteForum(' . $_REQUEST['f'] . '); return FALSE; ">Yes</a> <a href="#" onclick="history.back(); return FALSE; ">No</a></p>';
        echo '</div>';
}
require_once 'frm_footer.inc.php';