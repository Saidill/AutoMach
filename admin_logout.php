<?php

include 'connect.php';

session_start();
session_unset();
session_destroy();

header('admin_login.php');

?>