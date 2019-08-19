<?php

// comparaison infos entrées et bdd pour connexion admin
function is_admin($email)
{
    global $db;
    $a = [
        'email'     =>  $email,

    ];
    $sql = "SELECT * FROM admins WHERE email = :email";
    $req = $db->prepare($sql);
    $req->execute($a);
    $exist = $req->rowCount($sql);
    return $exist;
}

function is_adminpw( $password)
{
    
    global $db;
    $a = [
    
        'password'  => password_hash($password, PASSWORD_DEFAULT)
    ];
    $sql = "SELECT * FROM admins WHERE password = :password";
    $req = $db->prepare($sql);
    $req->execute($a);
    $exist = $req->rowCount($sql);
    return $exist;
}
