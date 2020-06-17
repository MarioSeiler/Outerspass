<div class="margin-top">
	<form action="/videospiel/doSearch" method="get" class="col-6 mt-auto rounded">	
		<h3 class="row">Suchen</h3>	
		<div class="row align-items-center">
			<div class="col.sm">
				<input type="radio" id="titel" name="searchtype" value="titel" required>
				<label for="titel">Titel</label><br>
				<input type="radio" id="publisher" name="searchtype" value="publisher" required>
				<label for="publisher">Publisher</label><br>
				<input type="radio" id="genre" name="searchtype" value="genre" required>
				<label for="genre">Genre</label>
			</div>
			<div class="col-sm">
			<input id="q" name="q" type="text" class="form-control" placeholder="Sucheingabe" maxlength="64" required>
			</div>
		</div>
		<div class="row">
			<button type="submit" name="send" class="btn btn-primary">Suchen</button>
		</div>
	
	</form>
</div>
<article class="hreview open special">
	<?php if (empty($videospiele)): ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Keine Videospiele gefunden.</h2>
		</div>
	<?php else: ?>
	<div class="d-flex flex-wrap align-content-center ">
		<?php foreach ($videospiele as $videospiel): ?>
			<div class="mt-auto rounded">
				<div class="panel-heading"><h3><?= $videospiel->titel; ?></h3></div>
				<iframe src=<?=$videospiel->trailer; ?> frameborder="0" allowfullscreen></iframe>
				<div><?= $videospiel->publisher; ?></div>
				<div><?= $videospiel->genre; ?></div>
				<div><?php if($videospiel->price == 0): ?>
					Kostenlos
					<?php else: ?>
					<?= $videospiel->price; ?> CHF</div>
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
	</div> <?php // Diese Zeile nach dem endforeach Zeile moven ?>
	<?php endif; ?>
</article>
