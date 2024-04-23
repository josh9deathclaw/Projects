<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" >
  <meta name="description" content="Assignment 1" >
  <meta name="keywords" content="About Info" >
  <meta name="author" content="Joshua Lillington-Moore" >
  <title>About</title>
  <!-- References to external font 'Blade Runner Font' -->
  <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' >
  <!-- References to external font 'Fallout 3 Computer Style Font' -->
  <link href='https://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' >
  <!-- References to external font 'Cyberpunk 2077 Font -->
  <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet' >
  <!-- References to external basic CSS file -->
  <link href= "styles/style.css" rel="stylesheet" >
</head>

<body>
	<?php
		include 'header.inc';
		include 'menu.inc';
	?>
<div class="about_me">
	<dl>
		<dt>Name</dt>
			<dd>Joshua Lillington-Moore</dd>
		<dt>Student Number</dt>
			<dd>103666887</dd>
		<dt>Tutors Name</dt>
			<dd>Unknown</dd>
		<dt>Course</dt>
			<dd>BB-ENGSC - Bachelor of Engineering(Honours)/Bachelor of Science</dd>
	</dl>
	<div class="img_me">
		<figure class="image_figure">
			<img src="images/me.JPG" alt="Image of Myself">
			<figcaption>Recent Image of Myself</figcaption>
		</figure>
	</div>
</div>
<div class="timetable">
	<h3>Swinburne Timetable</h3>
	<table>
		<thead>
			<tr>
				<th>Day</th>
				<th>Classes</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Monday</td>
				<td>Data 8.30am-9.30am Live Online, User 9.30am-10.30am Live Online</td>
			</tr>
			<tr>
				<td>Tuesday</td>
				<td>Web 12.30pm-2.30pm Live Online</td>
			</tr>
			<tr>
				<td>Wednesday</td>
				<td>Web 10.30am-12.30pm Tutorial</td>
			</tr>
			<tr>
				<td>Thursday</td>
				<td>User 10.30am-12.30pm Tutorial, Data 2.30pm-4.30pm Tutorial</td>
			</tr>
			<tr>
				<td>Friday</td>
				<td>No Classes</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="email">
	<dl class="contact_list">
		<dt> Email :</dt>
		<dd><a href="mailto:103666887@student.swin.edu.au">103666887@student.swin.edu.au</a></dd>
	</dl>
</div>
<section class="photo_grid">
	<div class="photo_item">
		<img src="images/arcade.jpg" alt="Image of Me at Arcade in Germany" >
	</div>
	<div class="photo_item">
		<img src="images/bday.jpg" alt="Image of Me on my 20th Bday" >
	</div>
	<div class="photo_item">
		<img src="images/fbprofile.JPG" alt="Image of Me in France" >
	</div>
	<div class="photo_item">
		<img src="images/fountain.JPG" alt="Images of Me in Italy" >
	</div>
	<div class="photo_item">
		<img src="images/frenchbball.JPG" alt="Images of Me playing bball in France" >
	</div>
	<div class="photo_item">
		<img src="images/longhair.JPG" alt="Images of Me with Long Hair" >
	</div>
	<div class="photo_item">
		<img src="images/niceview.JPG" alt="Images of Me at beach in Borneo" >
	</div>
	<div class="photo_item">
		<img src="images/borneo.jpg" alt="Image of Me with Wild Monkeys in Borneo" >
	</div>
</section>

	<?php
		include 'footer.inc';
	?>
</body>
</html>