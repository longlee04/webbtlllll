<?php
session_start();
session_destroy();
header("Location: ../views/user/home.php");
exit();
