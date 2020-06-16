<article class="hreview open special">
	<?php if (empty($videospiele)): ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Keine Videospiele gefunden.</h2>
		</div>
	<?php else: ?>
		<?php foreach ($videospiele as $videospiele): ?>
			<div class="panel panel-default">
				<div class="panel-heading"><?= $videospiel->title; ?> von <?= $videospiel->publisher; ?> | <?=$videospiel->genre; ?></div>
				<iframe src=<?=$videospiel->trailer; ?> frameborder="0" allowfullscreen></iframe>
				<?= $videospiel->price; ?> 
				<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]): ?>
				<form action="/bestellung/doCreate" method="post" class="col-6">
					<input type="hidden" id="user_id" name="user_id" value=<?= $_SESSION["user"]; ?>>
					<input type="hidden" id="videospiel_id" name="videospiel_id" value=<?= $videospiel->id; ?>>
					<button type="submit" name="send" class="btn btn-primary">Zum Warenkorb hinzufügen</button>
				</form>
				<?php endif; ?>
				</div>
		<?php endforeach; ?>
	<?php endif; ?>
</article>
