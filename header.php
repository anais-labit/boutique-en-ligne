<?php

require_once '../Controller/search.php';

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/427958ed2f.js" crossorigin="anonymous"></script>
    <script src="../Controller/auto_complete.js" defer></script>

</head>
<body>

    <nav>

    </nav>

    <div class=search id=search>
        <form id=searchform action=header.php>
            <input type=text id="field" name="field" autocomplete=off>
            <input type=submit name="search" value="Rechercher">
        </form>
    </div>

</body>

</html>