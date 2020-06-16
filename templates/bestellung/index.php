<article class="hreview open special">
	<?php if (empty($bestellungen)): ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Du hast noch nichts zum Warenkorb hinzugefügt!.</h2>
		</div>
	<?php else: ?>
		<?php foreach ($bestellungen as $bestellung): ?>
			<div class="panel panel-default">
				Noice
						<a title="Löschen" href="/bestellung/delete?id=<?= $bestellung->id; ?>">Löschen</a>
					</p>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</article>