<?php

	include_once(".././includes/functions.php"); // Include functions.php
	$functions = new Functions(); // Create function object

	if (isset($_POST['activate_btn'])) { // Kung ang add member button tuplokon
		$userId = $_POST['user_id'];
		$dateActivated = date("Y-m-d");

		$activateMember = $functions->activateMember($userId, $dateActivated);

		if ($activateMember) {
			array_push($errorSuccess, "Account has been activated successfully!");
		} else {
			array_push($errors, "There was an error in activating account!");
		}

	}


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
								<a class="nav-link active" href="members.php">Members</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="workouts.php">Workouts</a>
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
						<h1>Members</h1>
					</div>
          <?php include('.././includes/errors.php'); ?>
					<form action="members.php" method="post">
						<div class="table-responsive">
							<table id="myTable">
								<thead class="text-center">
									<th>ID</th>
									<th>Name</th>
									<th>Address</th>
									<th>Mobile Number</th>
									<th>Sex</th>
									<th>Age</th>
									<th>Exercise Type</th>
									<th>Date Activated</th>
									<th>Activation</th>
								</thead>
								<tbody>
									<?php
										$cnt = 1;
										$fetchMembers = $functions->fetchMembers();
										while($row = mysqli_fetch_array($fetchMembers)) {
									?>
									<tr class="text-center">
										<td><?= $cnt ?></td>
										<td><?= $row['First_name'] . ' ' . $row['Last_name'] ?></td>
										<td><?= $row['Address'] ?></td>
										<td><?= $row['Mobile_number'] ?></td>
										<td><?= $row['Sex'] ?></td>
										<td><?= $row['Age']?></td>
										<td><?= $row['Exercise_type'] ?></td>
										<td><?= $row['Date_activated'] ?></td>
										<td>
											<?php 
												if ($row['Status'] == '0') {
													echo '<button type="submit" class="btn btn-primary btn-sm w-100" name="activate_btn">Activate</button>';
												} 
												if ($row['Status'] == '1') {
													echo '<p class="text-success m-0">Activated</p>';
												}
												if ($row['Status'] == '2') {
													echo '<p class="text-danger m-0">Expired</p>';
												}
											?>
										</td>
									</tr>

									<!-- Hidden Input -->
									<input type="hidden" name="user_id" value="<?= $row['User_ID'] ?>">

									<?php $cnt = $cnt + 1; }?>

								</tbody>
							</table>
						</div>
					</form>
				</main>
			</div>
		</div>

    <?php include ('.././includes/scripts-file.php') ?>

		<script>
			$(document).ready( function () {
				$('#myTable').DataTable();
			});
		</script>

	</body>
</html>
