<div class="row">
	<form action="/videospiel/doCreate" method="post" class="col-6">
		<div class="form-group">
		  <label for="titel">Titel</label>
	  	<input id="titel" name="titel" type="text" class="form-control" required>
		</div>
		<div class="form-group">
		  <label for="publisher">Publisher</label>
	  	<input id="publisher" name="publisher" type="text" class="form-control" required>
		</div>
		<div class="form-group">
		  <label for="trailer">Trailer Youtube-Link</label>
	  	<input id="trailer" name="trailer" type="url" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="price">Preis</label>
			<input id="price" name="price" type="number" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="genre">Genre</label>
			<select id="genre" name="genre" class="form-control">
				<?php foreach($genres as $genre): ?>
				<option value=<?=$genre->genre?>><?=$genre->genre?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<button type="submit" name="send" class="btn btn-primary">Hinzufügen</button>
	</form>
</div>
