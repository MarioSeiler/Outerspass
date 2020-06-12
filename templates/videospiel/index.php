<article class="hreview open special">
	<?php if (empty($videospiele)): ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Keine Videospiele gefunden.</h2>
		</div>
	<?php else: ?>
		<?php foreach ($videospiele as $videospiele): ?>
			<div class="panel panel-default">
				<div class="panel-heading"><a><?= $videospiel->title; ?> von <?= $videospiel->publisher; ?></a></div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</article>
