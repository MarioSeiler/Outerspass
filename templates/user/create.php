<div class="row">
	<form action="/user/doCreate" method="post" class="col-6">
		<div class="form-group">
		  <label for="fname">Vorname</label>
	  	<input id="fname" name="fname" type="text" class="form-control" required>
		</div>
		<div class="form-group">
		  <label for="lname">Nachname</label>
	  	<input id="lname" name="lname" type="text" class="form-control" required>
		</div>
		<div class="form-group">
		  <label for="email">Mail</label>
	  	<input id="email" name="email" type="text" class="form-control" required>
		</div>
		<div class="form-group">
			<label class="control-label" for="password">Passwort</label>
			<input id="password" name="password" type="password" class="form-control" required>
		</div>
		<button type="submit" name="send" class="btn btn-primary">Absenden</button>
	</form>
</div>
<div class="row">
	<div class="col-6">
		<div class="user-info">

			<p>Du hast schon einen Account dann melde dich jetzt an! <br></p>
			<button class="btn btn-primary"><a href="/user/login">Anmelden</a></button>
		</div>
	</div>
</div>
