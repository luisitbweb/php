<?php
if (!isset($_GET['t'])){
    header('Location: frm_index.php');
}

require_once 'frm_header.inc.php';

$topicid = $_GET['t'];
$limit = $admin['pageLimit']['value'];

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
show_topic($db, $topicid, $user_id);

require_once 'frm_footer.inc.php';