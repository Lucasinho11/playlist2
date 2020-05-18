<?php
function getArtists($label_id =false){

    $db = dbConnect();
    if($label_id){
        $query = $db->prepare('SELECT * FROM artists');
        $artist = $query->execute( [ $id ] );
        $query->execute( [ $label_id ] );
    }
    return $query->fetchAll();
}

function getArtist($id){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM artists WHERE id = ?');
    $artist = $query->execute( [ $id ] );
    if ($artist){
        return $query->fetch();
    }else {
        return false;
    }
}
