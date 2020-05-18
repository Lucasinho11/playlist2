<?php
require('models/Artist.php');
require('models/Label.php');
if(isset($_GET['id'])){
    $label = getLabel($_GET['id']);
    $artists = 
    include('views/label.php');
}
else{

}