<article class="hreview open special">
	<?php if (empty($videospiele)): ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Keine Videospiele gefunden.</h2>
		</div>
	<?php else: ?>
	<div class="d-flex flex-wrap align-content-center ">
		<?php foreach ($videospiele as $videospiel): ?>
			<div class="mt-auto rounded">
				<div class="panel-heading"><h3><?= htmlentities($videospiel->titel); ?></h3></div>
				<iframe src=<?=htmlentities($videospiel->trailer); ?> allowfullscreen></iframe>
				<div><?= htmlentities($videospiel->publisher); ?></div>
				<div><?= htmlentities($videospiel->genre); ?></div>
				<?php if($videospiel->price == 0): ?>
					Kostenlos
				<?php else: ?>
					<?= htmlentities($videospiel->price); ?> CHF
				<?php endif; ?>
				<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]): ?>
					<div class="row">
						<form action="/bestellung/doCreate" method="post" class="col-6 col-sm">
						<input type="hidden" id="user_id" name="user_id" value=<?= $_SESSION["user_id"]; ?>>
						<input type="hidden" id="videospiel_id" name="videospiel_id" value=<?= $videospiel->id; ?>>
						<button type="submit" name="send" class="btn btn-primary">Zum Warenkorb hinzufügen</button>
						</form>
						<?php if($_SESSION["user"] == "bseilm@bbcag.ch"): ?>
						<a class="col-sm" title="Löschen" href="/bestellung/delete?id=<?= $bestellung->id; ?>">Löschen</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
</article>
