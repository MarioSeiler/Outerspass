<?php
if(!$_SESSION['loggedin']): ?>
<div class="row">
	<form action="/user/doLogin" method="post" class="col-6">
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

			<p>Du hast noch keinen Account? Dann erstelle jetzt <a href="/user/create">hier</a> einen!</p>			
		</div>
	</div>
</div>
<?php else: ?>
<div class="row">
	<div class="col-6">

		<button class="btn btn-primary"><a href="/user/logout">Abmelden</a></button>			

	</div>
</div>
<?php endif; ?>