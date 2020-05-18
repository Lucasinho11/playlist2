view du label  
<?php require('partials/header.php')?>
<br><br>
nom du label:<?= $label['name']?>
<br><br>
liste es artistes liés au label:
<?php foreach($artists as $artist): ?>
<a href=""<?=$artis['name'] ?>>
<?php endforeach;?>
