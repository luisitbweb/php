
<?php
$html = "<a href='#'>stew's favorite movie.</a>";
print htmlspecialchars($html) . '</br />';
print htmlspecialchars($html, ENT_QUOTES) . '</br />';
print htmlspecialchars($html, ENT_NOQUOTES) . '</br />';

if (@$_SERVER['RESQUEST_METHOD'] == 'GET') {
    ?>

    <form method="post" action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>"
          enctype="multipart/form-data">
        <input type="file" name="document"/>
        <input type="submit" value="send file"/>
    </form>
<?php
} else {
    if (isset($_FILES['document']) && ($_FILES['document']['error'] == UPLOAD_ERR_OK)) {
        $newPath = '/tmp/' . basename($_FILES['document']['name']);
        if (move_uploaded_file($_FILES['document']['tmp_name'], $newPath)) {
            print "file saved in $newPath";
        } else {
            print "couldn't move file to $newPath";
        }
    } else {
        print "no valid file uploaded.";
    }
}