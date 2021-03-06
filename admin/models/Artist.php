<?php

function getAllArtists()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM artists');
	$artists =  $query->fetchAll();

    return $artists;
}

function getArtist($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM artists WHERE id = ?");
	$query->execute([
		$id
	]);
	
	$result = $query->fetch();
	
	return $result;
}

function update($id, $informations)
{
	$db = dbConnect();
	
	$query = $db->prepare('UPDATE artists SET name = ?, biography = ?, label_id = ? WHERE id = ?');
	
	$result = $query->execute(
		[
			htmlspecialchars($informations['name']),
			htmlspecialchars($informations['biography']),
			$informations['label_id'],
			$id,
		]
	);
	
	return $result;
}
function add($informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("INSERT INTO artists (name, biography, label_id) VALUES( :name, :biography, :label_id)");
	$result = $query->execute([
		'name' => htmlspecialchars($informations['name']),
		'biography' => htmlspecialchars($informations['biography']),
		'label_id' => $informations['label_id'],
	]);

	if($result && isset($_FILES['image']['tmp_name'])){
		$artistId = $db->lastInsertId();
		
		$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
		$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);
		if (in_array($my_file_extension , $allowed_extensions)){
			$new_file_name = $artistId . '.' . $my_file_extension ;
			$destination = '../assets/images/artist/' . $new_file_name;
			$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);
			
			$db->query("UPDATE artists SET image = '$new_file_name' WHERE id = $artistId");
		}
	}
	
	return $result;
}

function delete($id)
{
	$db = dbConnect();
	$artist = getArtist($id);
	if(!empty($artist['image'])){
		unlink("../assets/images/artist/".$artist['image']);
	}
	
	
	
	$query = $db->prepare('DELETE FROM artists WHERE id = ?');
	$result = $query->execute([$id]);
	
	return $result;
}