<?php require('partials/header.php')?>
<a href="index.php">retour à l'index</a>

<p>Nom de l'artiste : <?= $artist['name'] ?></p>
<?php if(!empty($artist['image'])):?>
  <p>
  <img src="assets/images/artist/<?=$artist['image']?>" class="image_50px">
  </p>
<?php endif;?>
<p>Bio : <?= $artist['biography'] ?></p>
<style>
.image_50px{
  width: 100px;
  height: 100px;
  border-radius:50px;
}
</style>
Albums :

<?php if(sizeof($albums) > 0): ?>
  <ul>
  <?php foreach($albums as $album): ?>
    <li><a href="index.php?p=album&album_id=<?= $album['id'] ?>"><?= $album['name'] ?></a></li>
  <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>aucun album pour cet artiste</p>
<?php endif; ?>
