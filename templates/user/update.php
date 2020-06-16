<div class="row">
<form action="/user/doUpdate" method="post" class="col-6">
		<div class="form-group">
		  <label for="fname">Vorname</label>
	  	<input id="fname" name="fname" type="text" class="form-control" value=<?= $user->firstName?> required>
		</div>
		<div class="form-group">
		  <label for="lname">Nachname</label>
	  	<input id="lname" name="lname" type="text" class="form-control" value=<?= $user->lastName?> required>
		</div>
		<div class="form-group">
		  <label for="email">Mail</label>
	  	<input id="email" name="email" type="text" class="form-control" value=<?= $user->email?> required>
		</div>
		<div class="form-group">
			<label class="control-label" for="password">Neues Passwort</label>
			<input id="password" name="password" type="password" class="form-control" placeholder="Passwort">
		</div>
        <div class="form-group">
			<label class="control-label" for="password">Neues Passwort bestätigen</label>
			<input id="password-repeat" name="password-repeat" type="password" class="form-control" placeholder="Passwort bestätigen">
		</div>
        <input id="id" name="id" value=<?= $user->id ?> type="hidden">
		<button type="submit" name="send" class="btn btn-primary">Absenden</button>
	</form>
</div>
<div class="row">
    <div class="col-6" style="padding-top: 20px">

	    <button class="btn btn-primary" style="background-color: #1B662B"><a href="/user/logout">Abmelden</a></button>

    </div>		

</div>