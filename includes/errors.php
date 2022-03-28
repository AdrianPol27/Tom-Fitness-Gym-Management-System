<?php if (count($errors) > 0) : ?>
  <div class="alert alert-danger error" role="alert">
  	<?php foreach ($errors as $error) : ?>
			<ul class="m-0">
				<li><p class="m-0"><?php echo $error ?></p></li>
			</ul>
  	<?php endforeach ?>
  </div>
<?php endif ?>

<?php if (count($errorSuccess) > 0) : ?>
  <div class="alert alert-success error" role="alert">
  	<?php foreach ($errorSuccess as $error) : ?>
			<ul class="m-0">
				<li><p class="m-0"><?php echo $error ?></p></li>
			</ul>
  	<?php endforeach ?>
  </div>
<?php endif ?>

<?php if (count($errorInfo) > 0) : ?>
  <div class="alert alert-info error" role="alert">
  	<?php foreach ($errorInfo as $error) : ?>
			<ul class="m-0">
				<li><p class="m-0"><?php echo $error ?></p></li>
			</ul>
  	<?php endforeach ?>
  </div>
<?php endif ?>
