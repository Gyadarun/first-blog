<?php
// suppression commentaire de la bdd
require "../../functions/main-functions.php";
$db->exec("DELETE FROM comments WHERE id = {$_POST['id']}");