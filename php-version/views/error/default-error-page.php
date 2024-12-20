<?php
    $description=$GLOBALS['viewData']['description'];
    $errorMessage=$GLOBALS['viewData']['errorMessage'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>error <?=$errorMessage?></title>
</head>
<body>
    <h1>Error <?=$errorMessage?></h1>
    <h2><?=$description?></h2>
</body>
</html>