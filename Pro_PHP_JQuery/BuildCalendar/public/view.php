<?php

declare (strict_types=1);

/*
 * Make sure the event ID was passed
 */
if(isset($_GET['event_id'])){
    /*
     * Collect the event ID from the URL string
     *
    $id = htmlentities($_GET['event_id'], ENT_QUOTES);
     * 
     * Make sure the ID is an interger
     * 
     */
    $id = preg_replace('/[^0-9]/', '', $_GET['event_id']);
    
    /*
     * If the ID isn't valid, send the user to the main page
     */
    if(empty($id)){
        header("Location: ./");
        exit;
    }
    
} else {
   
    /*
     * Send the user to the main page if no ID is supplied
     */
    header("Location: ./");
    exit;
}

/*
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

/*
 * Output the header
 */

$page_title = "View Event";
$css_files = array("style.css", "admin.css");
include_once 'assets/common/header.inc.php';

/*
 * Load the calendar
 */
$cal = new Calendar($dbo);
?>

<div id="content">
    <?php echo $cal->displayEvent($id) ?>
    
    <a href="./">&laquo; Back to the calendar</a>
</div><!-- end #content -->

<?php
/*
 * Output the footer
 */
include_once 'assets/common/footer.inc.php';