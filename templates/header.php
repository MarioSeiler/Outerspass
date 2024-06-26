<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
	<script src="js/main.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css" >

    <title><?= $title; ?> | Outerspass</title>
  </head>
  <body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand nav-outerspass" href="/default/index">Outerspass</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= ($title=='Home'?'active':'') ?>">
               <a class="nav-link waves-effect waves-light" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= ($title=='Videospiele'?'active':'') ?>">
                <a class="nav-link waves-effect waves-light" href="/videospiel/index">Games</a>
				<form action="/videospiel/doSearch" method="get" id="Searchbar" class="col-6">		
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
            </li>
            <li class="nav-item <?= ($title=='About us'?'active':'') ?>">
                <a class="nav-link waves-effect waves-light" href="/default/about">About us</a>
            </li>
        </ul>
		<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['user'] == 'bseilm@bbcag.ch'): ?>
        <span class="navbar-text icons">
      <a href="/videospiel/create"><i class="fa fa-plus fa-2x" style="color:#FFFFFF"></i></a>
    </span>
		<?php endif; ?> 
      <span class="navbar-text icons">
      <a href="/bestellung/index"><i class="fas fa-shopping-cart fa-2x" style="color:#FFFFFF"></i></a>
    </span>
      <span class="navbar-text icons">
      <?php if(isset($_SESSION['loggedin']) && !$_SESSION['loggedin']): ?>
      <a href="/user/login"><i class="fas fa-user fa-2x" style="color:#FFFFFF"></i></a>
      <?php else: ?>
        <a href="/user/update"><i class="fas fa-user fa-2x" style="color:#FFFFFF"></i></a>
      <?php endif; ?>
    </span>
</nav>
    </header>
      </div>
    <main class="container">
      <h1><?= $heading; ?></h1>
