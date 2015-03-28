<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 28/03/2015
 * Time: 10:00
 */

require_once "FileUpload.php";


$fileupload = new FileUpload();
$img = $fileupload->Upload();

if($img != ""){
    echo "<div>$img</div>";
}

echo $fileupload->GetMessage();



?>
</body>
</html>

