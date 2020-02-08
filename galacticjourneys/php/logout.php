<?php
session_start();

session_unset($_SESSION['isLogged']);
session_unset($_SESSION['firstname']);
session_unset($_SESSION['lastname']);
session_unset($_SESSION['email']);
session_unset($_SESSION['isAdmin']);

session_destroy();

header("Location: ../index.php");
?>