<?php
    session_start();

    $_SESSION = [];

    header('Location: /kerostore/index.php');
?>