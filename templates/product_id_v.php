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
					<span style="font-weight: 600">
						<?= $product_info['brand_info']['name'] ?>
					</span>
					<?= $product_info['name'] ?>
				</h1>
			</section>
			
			<section class="table_list">
				
				<table class="table">
					<thead>
						<tr>
							<th scope="col">
								Price
							</th>
							<th scope="col">
								Store
							</th>
							<th scope="col">
								Location
							</th>
							<th scope="col">
								City
							</th>
						</tr>
					</thead>
					<tbody>
						<?
						foreach ($prices as $price) {
						?>
						<tr>
							<td>
								$<?= $price['price'] ?>
							</td>
							<td>
								<a class="direct_link" href="<?= $price['store_info']['website'] ?>">
									<?= $price['store_info']['company'] ?>
								
							</td>
							<td>
								<a class="direct_link" href="/store/<?= $price['store_info']['store_id'] ?>">
									<img 
										class="icon_s"
									    src="/images/icons/address-26x26.png" 
									    title="See address"
								    />
									<?= $price['store_info']['store_location_name'] ?>
								</a>
							</td>
							<td>
								<?= $price['store_info']['address']['city'] ?>
							</td>
							<!--
							<td>
								amount
							</td>
							<td>
								weight
							</td>
							-->
						</tr>
						<?
						}
						?>
					</tbody>
				</table>
			</section>
			
		</main>
		
		<footer>
			
		</footer>
		
		<!-- Scripts and suchlike -->
		<?php include  'includes/body-includes.html' ?>
		
	</body>
</html>