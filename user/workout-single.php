<?php

	include_once(".././includes/functions.php"); // Include functions.php
	$functions = new Functions(); // Create function object

	$workoutId = $_GET['Workout_ID'];
	$workoutName = $_GET['Workout_name'];

?>

<!doctype html>
<html lang="en">
	<head>
    <?php include ('.././includes/header.php') ?>
    <title>Dashboard</title>
	</head>
  <body>
    
		<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
			<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">TFGMS</a>
			<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
			<div class="navbar-nav">
				<div class="nav-item text-nowrap">
					<a class="nav-link px-3" href=".././logout.php">Sign out</a>
				</div>
			</div>
		</header>

		<div class="container-fluid">
			<div class="row">
				<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
					<div class="position-sticky pt-3">
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="nav-link" href="index.php">Dashboard</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" href="workouts.php">Workouts</a>
							</li>
						</ul>
						<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
							<span>Account</span>
						</h6>
						<ul class="nav flex-column mb-2">
							<li class="nav-item">
								<a class="nav-link" href="#">
									<span data-feather="file-text"></span>
									Current month
								</a>
							</li>
						</ul>
					</div>
				</nav>

				<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
	
						<nav class="mt-3" aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="workouts.php">Workouts</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?= $workoutName ?></li>
							</ol>
						</nav>
						<?php
							$fetchWorkoutsById = $functions->fetchWorkoutsById($workoutId);
							while($row = mysqli_fetch_array($fetchWorkoutsById)) {
						?>
							
							<div class="col-lg-6">
								<div class="card">
									<div class="card-body">
										<img src="<?= $row['Workout_image'] ?>" class="w-100" alt="<?= $row['Workout_name'] ?>">
										<h3 class="my-2"><?= $row['Workout_name'] ?> (<?= $row['Difficulty'] ?>)</h3>
										<p class="lead m-0"><?= $row['Category'] ?></p>
										<p class="lead m-0"><?= $row['Workout_description'] ?></p>
									</div>
								</div>
							</div>
						<?php } ?>
	
				</main>

			</div>
		</div>
    <?php include ('.././includes/scripts-file.php') ?>
	</body>
</html>
