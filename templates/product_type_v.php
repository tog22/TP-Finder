<!DOCTYPE html>
<html>
	<head>
		
	    <title>
	    	AssWipr
	    </title>
	    <?php include 'includes/favicon.html' ?>
	    
	    <base href="{{ base_url() }}/"/>
	    
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
					Find available prices for a product:
				</h1>
				<ul class="interface_list">
					<?php
					foreach ($product_types as $product_type) {
						?>
						<li>
							<a href="/prices/<?= $product_type['url_name'] ?>">
								<?
								if ($product_type['emoji']) {
									print $product_type['emoji'].' &nbsp; ';
								}
								?>
								<?= $product_type['name'] ?>
							</a>
						</li>
						
						<?
					}
					?>
				</ul>
			</section>
			
			<section>
				<h1>
					Report availability of a product:
				</h1>
				<ul class="interface_list">
					<?php
					foreach ($product_types as $product_type) {
						?>
						<li>
							<a href="/report/<?= $product_type['url_name'] ?>">
								<?
								if ($product_type['emoji']) {
									print $product_type['emoji'].' &nbsp; ';
								}
								?>
								<?= $product_type['name'] ?>
							</a>
						</li>
						
						<?
					}
					?>
				</ul>
			</section>
			
		</main>
		
		<footer>
			
		</footer>
		
		<!-- Scripts and suchlike -->
	    <?php include  'includes/body-includes.html' ?>
		
	</body>
</html>