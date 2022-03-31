<?php

	include_once(".././includes/functions.php"); // Include functions.php
	$functions = new Functions(); // Create function object
	$errors = array();

	if (isset($_POST['add_member_btn'])) { // Kung ang add member button tuplokon
    $name = $_POST['name']; // Kuhaon ang name gikan sa form
    $email = $_POST['email']; // Kuhaon ang email gikan sa form
    if (empty($name)) {
      array_push($errors, "Name should not be empty!"); // Mag push og error kung empty ang name
    }
    if (empty($email)) {
      array_push($errors, "Email should not be empty!"); // Mag push og error kung empty ang email
    } else {
			$addMember = $functions->addMember($name, $email);
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
					<a href="javascript:void()" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">Add New Member</a>
          <?php include('.././includes/errors.php'); ?>
					<table id="myTable">
						<thead>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Date Registered</th>
						</thead>
						<tbody>
							<?php
								$cnt = 1;
							?>
							<tr>
								<td><?= $cnt ?></td>
								<td>Name</td>
								<td>Email</td>
								<td>Date Registered</td>
							</tr>
						</tbody>
						<?php $cnt = $cnt + 1;?>
					</table>
				</main>
			</div>
		</div>

		<!-- Add member modal -->
		<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add New Member</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="members.php" method="post">
							<div class="form-floating mb-2">
								<input type="text" class="form-control" id="name" name="name" placeholder="Name">
								<label for="name">Name</label>
							</div>
							<div class="form-floating">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email">
								<label for="email">Email</label>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="add_member_btn">Add Member</button>
					</div>
						</form>
				</div>
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
