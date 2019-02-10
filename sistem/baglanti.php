<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 11:56
 */

try {
     $db = new PDO("mysql:host=localhost;dbname=stok_takip;charset=utf8", "root", "root");

} catch ( PDOException $e ){
     print $e->getMessage();
}
?>
