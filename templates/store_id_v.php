<!DOCTYPE html>
<html>
	<head>
		<?php
		// Template prep at start of <head>
		?>
		<title>
			AssWipr
		</title>
		<!-- TO DO: title -->
		
		<?php include 'includes/favicon.html' ?>
		
		<?php include 'includes/head-includes.html' ?>
		
	</head>
	<body>
		
		<nav class="navbar navbar-expand-md">
			<div class="container">
				<a class="navbar-brand" href="/">
					<span class="loo_roll">
						🧻
					</span>
					AssWipr
				</a>
				<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
					<span class="navbar-toggler-icon">
					</span>
				</button>
				<!--
				<div class="collapse navbar-collapse" id="main-navigation">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="/about">About</a>
						</li>
					</ul>
				</div>
				-->
			</div>
		</nav>

		<main class="regular_page container">
			
			<section>
				<h1>
					<?
					print $store_info['company'];
					if ($store_info['store_location_name']) { 
						print ': '; ?>
						<span class="store_location_name">
							<?= $store_info['store_location_name'] ?>
						</span>
						<?
					}
					?>
				</h1>
				<p class="label_s">
					Website:
				</p>
				<p class="labeled_line">
					<a href="<?= $store_info['website'] ?>">
						<?= $store_info['website'] ?>
					</a>
				</p>
				<p class="label_s">
					Address:
				</p>
				<p class="address_s">
					<?= $store_info['address']['st_num'] ?> <?= $store_info['address']['st_name'] ?>
					<br />
					<?= $store_info['address']['city'] ?>, <?= $store_info['address']['state'] ?>
					<br />
					<?= $store_info['address']['postal_code'] ?>
					<br />
					<?= $store_info['address']['country'] ?>
				</p>
				<p>
					<?
					// URL encode address
					//
					// Example of search string:
					// Real Canadian Superstore, 3185 Grandview Highway, Vanvouver, BC, V5M 2E9, Canada
					
					$google_maps_search_string = $store_info['company'].', ';
					$google_maps_search_string .= $store_info['address']['st_num'].' '.$store_info['address']['st_name'].', ';
					$google_maps_search_string .= $store_info['address']['city'].', ';
					$google_maps_search_string .= $store_info['address']['state'].', ';
					$google_maps_search_string .= $store_info['address']['postal_code'].', ';
					$google_maps_search_string .= $store_info['address']['country'];
					$google_maps_search_string = urlencode($google_maps_search_string);
					?>
				</p>
				<p class="label_s">
					Google Maps:
				</p>
				<p>
					<a href="https://www.google.com/maps/search/?api=1&query=<?= $google_maps_search_string ?>">Open a map in your browser</a>, or use it below:
				</p>
				<p>
					<iframe width="600" height="450" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/place?q=Real%20Canadian%20Superstore%2C%203185%20Grandview%20Highway%2C%20Vanvouver%2C%20BC%2C%20V5M%202E9%2C%20Canada&key=AIzaSyAAyDzJXxrbELmBFpebZdjnNi-IrFL0kBA" allowfullscreen>
					</iframe>
				</p>
			</section>
			
		</main>
		
		<footer>
			
		</footer>
		
		<!-- Scripts and suchlike -->
		<?php include  'includes/body-includes.html' ?>
		
	</body>
</html>