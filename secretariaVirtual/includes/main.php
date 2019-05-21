<?php
    if (!isset($_GET['page'])) {
        include("login.php");
    } else {
        include($_GET['page'].".php");
    }
?>