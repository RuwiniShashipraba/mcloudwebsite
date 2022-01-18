<?php
    session_start();
    session_unset();
    session_destroy();

    header('Location: https://m-cloud.herokuapp.com/');
?>