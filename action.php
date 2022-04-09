<?php

if($_GET['action'] == 'logout') {
session_unset();
session_destroy();
header("Location:login.php");
}

