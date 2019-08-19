<?php
// passe la valeur du commentaire à 1
require "../../functions/main-functions.php";

$db->exec("UPDATE comments SET seen='1' WHERE id='{$_POST['id']}'");