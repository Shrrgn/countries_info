<h3>Main page</h3>


<?php if ($userLogIn) : ?>
	<h3>Welcome <?php echo $user_nick; ?></h3>
	<p>In this place will be form for country name</p>
<?php else: ?>
	<div class="side-box">
		<h3>Choose</h3>
		<ul class="list">
			<li><a href="registration">Registration</a></li>
			<li><a href="signin">Signin</a></li>
		</ul>
	</div>
<?php endif; ?>