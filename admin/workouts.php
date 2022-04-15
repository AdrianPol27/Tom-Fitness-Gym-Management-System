<?php

  include_once(".././includes/functions.php"); // Include functions.php
  $functions = new Functions(); // Create function object

  if (isset($_POST['add_workout'])) {
    $file = $_FILES['workout_image'];
		$fileName = $_FILES['workout_image']['name'];
		$fileTmpName = $_FILES['workout_image']['tmp_name'];
		$fileSize = $_FILES['workout_image']['size'];
		$fileError = $_FILES['workout_image']['error'];
		$fileType = $_FILES['workout_image']['type'];
		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		$allowed = array('jpg', 'jpeg', 'png');

    $workoutImage = $fileTmpName;
    $workoutName = $_POST['workout_name'];
    $workoutDescription = $_POST['workout_description'];
    $difficulty = $_POST['difficulty'];
    $category = $_POST['category'];

    if (empty($workoutImage)) {
      array_push($errors, "Workout image should not be empty!");
    }
    if (empty($workoutName)) {
      array_push($errors, "Workout name should not be empty!");
    }
    if (empty($workoutDescription)) {
      array_push($errors, "Workout description should not be empty!");
    }
    if ($difficulty == 'None') {
      array_push($errors, "Difficulty should not be empty!");
    }
    if ($category == 'None') {
      array_push($errors, "Category should not be empty!");
    }
    else {

      $ifWorkoutExist = $functions->ifWorkoutExist($workoutName);
      if (mysqli_num_rows($ifWorkoutExist) > 0) {
        array_push($errors, "Workout already exist!");
      } 

			elseif ($fileError === 0) {
				if (in_array($fileActualExt, $allowed)) {
					if ($fileSize > 5000) {
						$fileNameNew = uniqid('', true) . "." . $fileActualExt;
						$workoutImage = '../assets/images/workout-images/' . $fileNameNew;
						move_uploaded_file($fileTmpName, $workoutImage);
						// Insert Data To Database
						$addWorkout = $functions->addWorkout($workoutImage, $workoutName, $workoutDescription, $difficulty, $category) ;
						if ($addWorkout) {
							array_push($errorSuccess, "Workout added successfully!");
						} else {
							array_push($errors, "Workout not added!");
						}
						
					} else {
						array_push($errors, "File size should not exceed 5MB!");
					}
				} else {
					array_push($errors, "File type is not supported!");
				}
			}

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
								<a class="nav-link" href="members.php">Members</a>
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
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Workout</button>
          <?php include('.././includes/errors.php'); ?>
          <div class="table-responsive">
            <table id="myTable">
              <thead class="text-center">
                <th>ID</th>
                <th>Workout Image</th>
                <th>Workout Name</th>
                <th>Workout Description</th>
                <th>Difficulty</th>
                <th>Category</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                  $cnt = 1;
                  $fetchWorkouts = $functions->fetchWorkouts();
                  while($row = mysqli_fetch_array($fetchWorkouts)) {
                ?>
                <tr class="text-center">
                  <td><?= $cnt ?></td>
                  <td><img src="<?= $row['Workout_image'] ?>" alt="<?= $row['Workout_name'] ?>" style="width: 100px"></td>
                  <td><?= $row['Workout_name'] ?></td>
                  <td><?= $row['Workout_description'] ?></td>
                  <td><?= $row['Difficulty'] ?></td>
                  <td><?= $row['Category'] ?></td>
                  <td>
                    <a href="#" class="btn btn-primary btn-sm w-100">Update</a>
                    <a href="#" class="btn btn-danger btn-sm w-100 mt-1">Delete</a>
                  </td>
                </tr>

                <!-- Hidden Input -->
                <input type="hidden" name="user_id" value="<?= $row['User_ID'] ?>">

                <?php $cnt = $cnt + 1; }?>

              </tbody>
            </table>
          </div>
          
				</main>

			</div>
		</div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add Workout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="workouts.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="file" class="form-control" id="" name="workout_image">
              <div class="form-floating mt-2">
                <input type="text" class="form-control" id="workoutName" name="workout_name" placeholder="Workout Name">
                <label for="workoutName">Workout Name</label>
              </div>
              <div class="form-floating mt-2">
                <textarea class="form-control" id="workoutDesc" name="workout_description" placeholder="Workout Description" style="height: 150px; resize: none"></textarea>
                <label for="workoutDesc">Workout Description</label>
              </div>
              <div class="form-floating mt-2">
                <select class="form-select" id="difficulty" name="difficulty" placeholder="Difficulty">
                  <option value="None">Choose...</option>
                  <option value="Easy">Easy</option>
                  <option value="Moderate">Moderate</option>
                  <option value="Hard">Hard</option>
                </select>
                <label for="difficulty">Difficulty</label>
              </div>
              <div class="form-floating mt-2">
                <select class="form-select" id="category" name="category" placeholder="Category">
                  <option value="None">Choose...</option>
                  <option value="Chest">Chest</option>
                  <option value="Back">Back</option>
                  <option value="Biceps">Biceps</option>
                  <option value="Triceps">Triceps</option>
                  <option value="Abs">Abs</option>
                  <option value="Shoulder">Shoulder</option> 
                  <option value="Legs">Legs</option>
                </select>
                <label for="category">Category</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="add_workout">Add Workout</button>
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
