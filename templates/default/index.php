<article class="hreview open special">
	<?php if (empty($videospiele)): ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Keine Videospiele gefunden.</h2>
		</div>
	<?php else: ?>
	<div class="d-flex flex-wrap align-content-center ">
        <?php shuffle($videospiele);
        for ($i = 0; $i<3;$i++): ?>
			<div class="mt-auto rounded">
				<div class="panel-heading"><h3><?= $videospiele[$i]->titel; ?></h3></div>
				<iframe src=<?=$videospiele[$i]->trailer; ?> frameborder="0" allowfullscreen></iframe>
				<div><?= $videospiele[$i]->publisher; ?></div>
				<div><?= $videospiele[$i]->genre; ?></div>
				<div><?php if($videospiele[$i]->price == 0): ?>
					Kostenlos</div>
					<?php else: ?>
					<?= $videospiele[$i]->price; ?> CHF</div>
				<?php endif; ?>
				<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]): ?>
					<div class="row">
						<form action="/bestellung/doCreate" method="post" class="col-6 col-sm">
						<input type="hidden" id="user_id" name="user_id" value=<?= $_SESSION["user_id"]; ?>>
						<input type="hidden" id="videospiel_id" name="videospiel_id" value=<?= $videospiele[$i]->id; ?>>
						<button type="submit" name="send" class="btn btn-primary">Zum Warenkorb hinzufügen</button>
						</form>
						<?php if($_SESSION["user"] == "bseilm@bbcag.ch"): ?>
						<a class="col-sm" title="Löschen" href="/bestellung/delete?id=<?= $bestellung->id; ?>">Löschen</a>
					<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
            <?php endfor; ?>
        </div> <?php // Diese Zeile nach dem endforeach Zeile moven ?>
	<?php endif; ?>
</article>
