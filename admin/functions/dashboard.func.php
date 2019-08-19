<?php
// récupérer le nombre d'entrée dans une table
function inTable($table){
    global $db;
    $query = $db->query("SELECT COUNT(id) FROM $table");
    return $nombre = $query->fetch();
}

// récupérer couleur du tableau colors
function getColor($table,$colors){
    if(isset($colors[$table])){
        return $colors[$table];
    }else{
        return "orange";
    }
}
// récupération commentaire encore non visualisé pour le dashboard
function get_comments(){
    global $db;

    $req = $db->query("
        SELECT  comments.id,
                comments.name,
                comments.email,
                comments.date,
                comments.post_id,
                comments.comment,
                posts.title
        FROM comments
        JOIN posts
        ON comments.post_id = posts.id
        WHERE comments.seen = '0'
        ORDER BY comments.date ASC
    ");

    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }
    return $results;
}

function get_user(){
    global $db;

    $req = $db->query("
        SELECT * FROM admins WHERE email='{$_SESSION['admin']}';
    ");

    $result = $req->fetchObject();
    return $result;
}