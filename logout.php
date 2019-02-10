<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 13:46
 */
session_start();
session_destroy();
header("Location:login.php");

?>