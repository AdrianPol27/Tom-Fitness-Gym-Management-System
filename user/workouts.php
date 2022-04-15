<?php

	include_once(".././includes/functions.php"); // Include functions.php
	$functions = new Functions(); // Create function object

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
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1>Workouts</h1>
					</div>

					<div class="row">
						<?php
							$fetchWorkouts = $functions->fetchWorkouts();
							while($row = mysqli_fetch_array($fetchWorkouts)) {
						?>
							<div class="col-lg-3 col-md-4 col-sm-6">
								<a href="workout-single.php?Workout_ID=<?= $row['Workout_ID'] ?>&Workout_name=<?= $row['Workout_name'] ?>" class="text-decoration-none text-dark">
									<div class="card">
										<div class="card-header">
											<div class="d-flex">
												<p class="lead m-0"><?= $row['Workout_name'] ?></p>
												<p class="lead m-0 ms-auto"><?= $row['Category'] ?></p>
											</div>
										</div>
										<div class="card-body m-0 p-0">
											<img src="<?= $row['Workout_image'] ?>" alt="<?= $row['Workout_name'] ?>" style="width: 100%; height: 120px;">
										</div>
										<div class="card-footer">
											<div class="d-flex">
												<p class="m-0">Difficulty:</p>
												<?php

													if ($row['Difficulty'] == 'Easy') {
														echo '<p class="text-success m-0 ms-auto">Easy</p>';
													}
													if ($row['Difficulty'] == 'Moderate') {
														echo '<p class="text-warning m-0 ms-auto">Moderate</p>';
													}
													if ($row['Difficulty'] == 'Hard') {
														echo '<p class="text-danger m-0 ms-auto">Hard</p>';
													}
												?>
											</div>
										</div>
									</div>
								</a>
							</div>
						<?php } ?>

						
					</div>
				</main>

			</div>
		</div>
    <?php include ('.././includes/scripts-file.php') ?>
	</body>
</html>
