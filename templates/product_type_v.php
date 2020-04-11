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
					if ($product_type['emoji']) {
						print $product_type['emoji'].' &nbsp; ';
					}
					?>
					<?= $product_type['name'] ?>
				</h1>
				<p>
					<?= $product_type['description'] ?>
				</p>
			</section>
			
			<section class="table_list">
				
				<table class="table">
					<thead>
						<tr>
							<th scope="col">
								Best Price
							</th>
							<th scope="col">
								Name
							</th>
							<th scope="col">
								Brand
							</th>
							<th scope="col">
								Description
							</th>
							<!--
							<th scope="col">
								Amount
							</th>
							<th scope="col">
								Weight
							</th>
							-->
						</tr>
					</thead>
					<tbody>
						<?
						foreach ($products as $product) {
						?>
						<tr>
							<td>
								<?= $product['min_price'] ?>
							</td>
							<td>
								<?= $product['name'] ?>
							</td>
							<td>
								brand
							</td>
							<td>
								<?= $product['description'] ?>
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