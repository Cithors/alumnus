<?php $footer = $langs[$lang]['footer']; ?>
	</content>

	<div class="container">
		<a href="#fancy" class="info-request">
			<span class="holder">
				<span class="title"><?= $footer['faq']['title'] ?></span>
				<span class="text"><?= $footer['faq']['text'] ?></span>
			</span>

			<span class="arrow"></span>
		</a>
	</div>

	<footer id="footer">
		<div class="container">
			<section>
				<h2><?= $footer['ufa'] ?></h2>
				<div class="hide">
					Enseignement catholique sous contrat d'association avec l'Etat<br>
					Etablissement habilité à percevoir la taxe d'apprentissage
				</div>

				<!-- Contact -->
				<article class="col-1">
					<h3><?= $footer['contact']['title'] ?></h3>
					<ul>
						<li class="address">
							<a target="_blank" href="https://www.google.com/maps/dir//
							5+Avenue+du+G%C3%A9n%C3%A9ral+de+Gaulle,+93440+Dugny/"><?= $footer['contact']['address'] ?></a>
						</li>
						<li class="mail">
							<a href="mailto:<?= $footer['contact']['mail'] ?>
								?cc=root@admin.com
								&bcc=sudo@test.com
								&subject=Alumnus
								&body=Alumnus%20!"><?= $footer['contact']['mail'] ?>
							</a>
						</li>
						<li class="phone last">
							<a href="tel:<?= $footer['contact']['phone'] ?>"><?= $footer['contact']['phone'] ?></a>
						</li>
					</ul>
				</article>

				<!-- Gallery -->
				<!-- <article class="col-2">
					<h3><?= $footer['gallery']['title'] ?></h3>
					<ul>
						<li><a href="<?= GALLERY ?>"><?= $footer['gallery']['1'] ?></a></li>
						<li class="last"><a href="<?= GALLERY ?>"><?= $footer['gallery']['2'] ?></a></li>
					</ul>
				</article> -->
				<article class="col-2">
					<h3><?= $footer['findus']['title'] ?></h3>
					<div id="map">
				</article>

				<!-- Social -->
				<article class="col-3">
					<h3><?= $footer['social']['title'] ?></h3>
					<p><?= $footer['social']['text'] ?></p>
					<ul>
						<li class="facebook"><a href="https://facebook.com">Facebook</a></li>
						<!-- <li class="google-plus"><a href="#">Google+</a></li> -->
						<li class="twitter"><a href="https://twitter.com">Twitter</a></li>
						<li class="pinterest"><a href="https://pinterest.com">Pinterest</a></li>
					</ul>
				</article>

				<!-- Newsletter -->
				<article class="col-4">
					<h3><?= $footer['newsletter']['title'] ?></h3>
					<p><?= $footer['newsletter']['text'] ?></p>

					<form action="#">
						<div class="left">
							<fieldset>
								<input type="text" name="mail" placeholder="<?= $footer['newsletter']['mail'] ?>">
							</fieldset>
						</div>
						<button type="submit"><?= $footer['newsletter']['submit'] ?></button>
					</form>
				</article>
			</section>

			<!-- Credits -->
			<p class="copy">
				Alumnus <?= date('Y') ?><br>
				<!-- Copyright 2014 Harrison High School. Designed by <a href="http://www.vandelaydesign.com/" title="Designed by Vandelay Design" target="_blank">Vandelay Design</a>. All rights reserved. -->
			</p>
		</div>
	</footer>

	<div id="fancy" class="">
		<h2><i class="fa fa-handshake-o"></i>&nbsp;<?= $modal['contact']['title'] ?></h2>
		<form action="" method="post">
			<div class="left">
				<fieldset class="name">
					<input placeholder="<?= $modal['contact']['name'] ?>" type="text" name="name">
				</fieldset>
				<fieldset class="mail">
					<input placeholder="<?= $modal['contact']['mail'] ?>" type="text" name="mail">
				</fieldset>
				<fieldset class="subject">
					<select class="choose" name="subject">
						<option><?= $modal['contact']['subject'][0] ?></option>
						<option><?= $modal['contact']['subject'][1] ?></option>
						<option><?= $modal['contact']['subject'][2] ?></option>
					</select>
				</fieldset>
			</div>

			<div class="right">
				<fieldset class="question">
					<textarea placeholder="<?= $modal['contact']['question'] ?>" name="question"></textarea>
				</fieldset>
			</div>

			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $modal['contact']['btn'] ?></button>
			</div>
		</form>
	</div>

	<div id="profile" class="fancyModal slideModal">
		<h2><i class="fa fa-user"></i>&nbsp;<?= $modal['profile']['title'] ?></h2>
		<form>
			<div class="left">
				<fieldset class="name"><input value="<?= $info['nickname'] ?>" type="text" disabled></fieldset>
				<fieldset class="name"><input value="<?= $info['firstname'].' '.$info['lastname'] ?>" type="text" disabled></fieldset>
				<fieldset class="mail"><input value="<?= $info['mail'].'@lprs.fr' ?>" type="text" disabled></fieldset>
				<fieldset class="subject"><input value="<?= $info['birth'] ?>" type="text" disabled></fieldset>
			</div>

			<div class="btn-holder">
				<a class="trigModal" href="#edit"><button class="btn blue" type="submit"><?= $modal['profile']['btn'] ?></button></a>
			</div>
		</form>
	</div>

	<div id="edit" class="fancyModal slideModal">
		<h2><i class="fa fa-edit"></i>&nbsp;<?= $modal['edit']['title'] ?></h2>
		<form action="" method="post">
			<div class="left">
				<fieldset class="name">
					<input title="<?= $signin['user']['name'] ?>" value="<?= $info['nickname'] ?>" name="user" type="text" required>
				</fieldset>
				<fieldset class="subject"><input title="<?= $signin['pwd']['name'] ?>" name="pwd" type="password" required></fieldset>
			</div>

			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $modal['edit']['btn'] ?></button>
			</div>
		</form>
	</div>

	<div id="logout" class="fancyModal slideModal">
		<h2><i class="fa fa-door-open"></i>&nbsp;<?= $modal['logout']['title'] ?></h2>
		<form action="javascript:logout()">
			<div class="left">
				<p class='center'><?= $modal['logout']['text'] ?></p>
			</div>
			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $modal['logout']['btn'] ?></button>
			</div>
		</form>
	</div>

	<div id="reset" class="fancyModal slideModal">
		<h2><i class="fa fa-question-circle-o"></i></i>&nbsp;<?= $modal['reset']['title'] ?></h2>
		<form action="" method="post">
			<div class="left">
				<fieldset class="mail">
					<input name="mail" placeholder="<?= $modal['reset']['hint'] ?>" type="text" required>
				</fieldset>
			</div>
			<div class="right">
				<fieldset class="suffix"><input value="@lprs.fr" type="text" disabled></fieldset>
			</div>
			<div class="btn-holder">
				<button type="submit" class="btn blue"><?= $modal['reset']['btn'] ?></button>
			</div>
			<a class="fancyModal" href="#code"><button class="btn blue"><?= $modal['reset']['btn'] ?></button></a>
		</form>
	</div>

	<div id="code" class="fancyModal slideModal">
		<h2><i class="fa fa-question-circle-o"></i></i>&nbsp;<?= $modal['code']['title'] ?></h2>
		<form action="" method="post">
			<p><?= $modal['code']['text'] ?></p>
			<div class="left">
				<fieldset class="subject"><input name="code" type="text" required></fieldset>
			</div>
			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $modal['code']['btn'] ?></button>
			</div>
		</form>
	</div>

	<div id="change" class="fancyModal slideModal">
		<h2><i class="fa fa-edit"></i>&nbsp;<?= $modal['change']['title'] ?></h2>
		<form action="" method="post">
			<p><?= $modal['change']['text'] ?></p>
			<div class="left">
				<input type="text" name="id" id="id" value="<?php if (isset($_SESSION['mail'])) echo $uManager->getUserId($_SESSION['mail'])[0] ?>" hidden>
				<fieldset class="subject">
					<input placeholder="<?= $modal['change']['pwd1'] ?>" name="pwd1" type="password" required>
				</fieldset>
				<fieldset class="subject">
					<input placeholder="<?= $modal['change']['pwd2'] ?>" name="pwd2" type="password" required>
				</fieldset>
			</div>

			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $modal['change']['btn'] ?></button>
			</div>
		</form>
	</div>

	<div id="addEvent" class="fancyModal slideModal">
		<h2><i class="fa fa-plus"></i>&nbsp;<i class="fa fa-calendar"></i>&nbsp;<?= $events['add'] ?></h2>
		<form action="" method="post">
			<div class="left">
				<fieldset class="subject"><input placeholder="Event" type="text" name="title3" required></fieldset>
				<fieldset class="question"><textarea placeholder="Description" name="desc3" required></textarea></fieldset>
				<fieldset class="subject"><input min="<?= date('Y-m-d') ?>" type="date" name="sdate3" required></fieldset>
				<fieldset class="subject"><input min="<?= date('Y-m-d') ?>" type="date" name="edate3" required></fieldset>
				<fieldset class="subject"><input placeholder="URL" type="text" name="url3" required></fieldset>
			</div>

			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $admin['add'] ?></button>
			</div>
		</form>
	</div>

	<div id="addImage" class="fancyModal slideModal">
		<h2><i class="fa fa-plus"></i>&nbsp;<i class="fa fa-image"></i>&nbsp;<?= $gallery['add'] ?></h2>
		<form action="" method="post">
			<div class="left">
				<fieldset class="subject"><input placeholder="Title" type="text" name="title1" required></fieldset>
				<fieldset class="question"><textarea placeholder="Description" name="desc1" required></textarea></fieldset>
				<fieldset class="subject"><input placeholder="URL" type="text" name="url1" required></fieldset>
			</div>

			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $admin['add'] ?></button>
			</div>
		</form>
	</div>

	<div id="modImage" class="fancyModal slideModal">
		<h2><i class="fa fa-pen"></i>&nbsp;<i class="fa fa-image"></i>&nbsp;<?= $gallery['mod'] ?></h2>
		<form action="" method="post">
			<div class="left">
				<fieldset class="name" hidden><input value="<?php if (isset($_COOKIE['id'])) echo $_COOKIE['id']; ?>" type="text" name="id"></fieldset>
				<fieldset class="subject"><input placeholder="Title" type="text" name="title2" required></fieldset>
				<fieldset class="question"><textarea placeholder="Description" name="desc2" required></textarea></fieldset>
			</div>

			<div class="right">
				<fieldset class="subject"><input placeholder="URL" type="text" name="url2" required></fieldset>
			</div>

			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $admin['mod'] ?></button>
			</div>
		</form>
	</div>

	<div id="modEvent" class="fancyModal slideModal">
		<h2><i class="fa fa-pen"></i>&nbsp;<i class="fa fa-calendar"></i>&nbsp;<?= $events['mod'] ?></h2>
		<form action="" method="post">
			<div class="left">
				<fieldset class="name" hidden><input value="<?php if (isset($_COOKIE['id2'])) echo $_COOKIE['id2']; ?>" type="text" name="id2"></fieldset>
				<fieldset class="subject"><input placeholder="Event" type="text" name="title4"></fieldset>
				<fieldset class="question"><textarea placeholder="Description" name="desc4"></textarea></fieldset>
			</div>

			<div class="right">
				<fieldset class="subject"><input value="<?= date('Y-m-d') ?>" type="date" name="sdate4"></fieldset>
				<fieldset class="subject"><input value="<?= date('Y-m-d') ?>" type="date" name="edate4"></fieldset>
				<fieldset class="subject"><input placeholder="URL" type="text" name="url4" required></fieldset>
			</div>

			<div class="btn-holder">
				<button class="btn blue" type="submit"><?= $admin['mod'] ?></button>
			</div>
		</form>
	</div>

	<!-- External libraries -->
	<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script>window.jQuery || document.write("<script src='..src/js/jquery-3.4.1.min.js'>\x3C/script>")</script>
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
			crossorigin="anonymous">
	</script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
			crossorigin="anonymous">
	</script>
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
			crossorigin="anonymous">
	</script> -->
	<script src="https://kit.fontawesome.com/5e5385ed48.js"
			integrity="sha384-msZ2bOScu7SVVMcVzKyc1M+y0BPtlcPcv8vDz2AVCJnpUTGwMTVxAnpFT8RV8nD4"
			crossorigin="anonymous">
	</script>

	<!-- Internal libraries -->
	<!-- <script src="<?= JS ?>plugins.js?c=<?= time() ?>"></script> -->
	<script src="<?= JS ?>fancybox.js?c=<?= time() ?>"></script>
	<script src="<?= JS ?>main.js?c=<?= time() ?>"></script>
	<script src="<?= JS ?>functions.js?c=<?= time() ?>"></script>
	<script src="<?= JS ?>addons.js?c=<?= time() ?>"></script>
	<script src="<?= JS ?>darkreader.js?c=<?= time() ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js?c=<?= time() ?>"></script>

	<!-- pour la map -->
	<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	<script>
		// On initialise la latitude et la longitude du lycée (centre de la carte)
		var lat = 48.949276;
		var lon = 2.415706;
		var macarte = null;
		// Fonction d'initialisation de la carte
		function initMap() {
			// Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
			macarte = L.map('map').setView([lat, lon], 11);
			// Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
			L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
				// Il est toujours bien de laisser le lien vers la source des données
				attribution: '',
				minZoom: 16,
				maxZoom: 20
			}).addTo(macarte);
			var myIcon = L.icon({
				iconUrl: "https://bonnicilawgroup.com/wp-content/uploads/2015/08/map-marker-icon.png",
				iconSize: [40, 40],
				iconAnchor: [25, 50],
				popupAnchor: [-3, -76],
			});
			var marker = L.marker([lat, lon], { icon: myIcon }).addTo(macarte);
		}
		// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
		window.onload = function(){ initMap(); };
	</script>
</body>
</html>
