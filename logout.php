<?php
if(!empty($_SESSION['status']) && $_SESSION['status'] == 'connected'){
    header('Location: index.php');
}
session_start();

session_unset();

session_destroy();

header('Location: index.php');