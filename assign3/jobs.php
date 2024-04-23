<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" >
  <meta name="description" content="Assignment 1" >
  <meta name="keywords" content="Position Descriptions" >
  <meta name="author" content="Joshua Lillington-Moore"  >
  <title>Jobs</title>
  <!-- References to external font 'Blade Runner Font' -->
  <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' >
  <!-- References to external font 'Fallout 3 Computer Style Font' -->
  <link href='https://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' >
  <!-- References to external font 'Cyberpunk 2077 Font -->
  <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet' >
  <!-- References to external basic CSS file -->
  <link href= "styles/style.css" rel="stylesheet" >
  <script src="scripts/apply.js"></script>
</head>

<body>
	<?php
		include 'header.inc';
		include 'menu.inc';
	?>
<main>
	<section class="job_listing">
		<div class="basic_info">
			<div class="job_description">
				<h2>.NET Developer </h2>
				<p>Reference Number : <span id="job1id">10001</span></p> <!--sets the values of the job1id equal too 10001, so it can be prefilled in the form, same done for job 2 -->
			<div class="applybutton1">
			<a id="applyJob1" href="apply.php" >Apply</a> <!--adds apply button, refers user to apply page-->
			</div>
				<p>In general the role of a .NET Developer is to use Microsoft's .NET framework, with the goal of designing, developing and maintaining a wide range of applications, such as web, desktop, mobile and the cloud. At Night City Creations we are looking for a .NET Developer who is willing to do Cross-platform implementation in our games, as well creating tools used during development such as level design, debugging and opitimization. We will also need them to be able to do API development, having the ability to integrate multiple game systems together, such as physics engines, audio libraries or even AI components. They may also be asked to help with backend services and infrastructure involved with any multiplayer features such as leaderboards or player accounts, making them accessible on a wide range of devices. </p>
			</div>
				<aside class="requirements">
					<ol>
						<li>Salary Bracket
							<ul>
								<li>$80,000-120,000 AUD</li>
							</ul>
						</li>
						<li>Reports To
							<ul>
								<li>Technical Lead</li>
								<li>Lead Developer</li>
							</ul>
						</li>
					</ol>	
				</aside>
		</div>
		<div class="resp_qual">
			<div class="responsibilities">
				<h3>Key Responsibilities</h3>
				<ul>
					<li>Cross-Platform Implementation</li>
					<li>Tool Development</li>
					<li>Integration of Game Systems</li>
					<li>Backend Services and Infrastructure</li>
				</ul>
			</div>
			<div class="qualification">
				<h3>Qualifications</h3>
				<table>
					<thead>
						<tr>
							<th>Essential</th>
							<th>Preferable</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>2 Years of .NET Development</td>
							<td>Experience in the Games Industry</td>
						</tr>
						<tr>
							<td>Bachelor's Degree in Computer Science of Equivalent</td>
							<td>Portfolio of Past Work</td>
						</tr>
						<tr>
							<td>.NET Framework Expertise</td>
							<td>Cloud Tech Experience</td>
						</tr>
						<tr>
							<td>Experience with one of C#, F# or VB.NET</td>
							<td>Good Problem Solving and Communication Skills</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<section class="job_listing">
		<div class="basic_info">
			<div class="job_description">
				<h2>Graphics Programmer </h2>
				<p>Reference Number : <span id="job2id">120387</span></p>
			<div class="applybutton2">
			<a id="applyJob2" href="apply.php" >Apply</a>
			</div>
				<p>Night City Creations is searching for a highly skilled programmer, with a specialty working in the games industry with past experience and strong passion. They will work with the entire team including artists in order to bring our artistic vision to life. Focusing on a wide range of tasks, these include rendering, defining 3D models, textures and effects that need to be processed and displayed on the screen ; shaders, this is more to do with lighting, how objects are shaded, lit and textured ; visual effects and of course optimization, making sure to improve the performance of games on a wide range of targets devices so the game can still run well. It is essential you are capable of working well in a team environment. </p>
			</div>
				<aside class="requirements">
					<ol>
						<li>Salary Bracket
							<ul>
								<li>$70,000-100,000 AUD</li>
							</ul>
						</li>
						<li>Reports To
							<ul>
								<li>Programming Team</li>
								<li>Lead Developer</li>
								<li>Artsits</li>
							</ul>
						</li>
					</ol>	
				</aside>
		</div>
		<div class="resp_qual">
			<div class="responsibilities">
				<h3>Key Responsibilities</h3>
				<ul>
					<li>Rendering, Lighting</li>
					<li>Game Graphics</li>
					<li>Achieve Artistic Vision</li>
					<li>Optimization</li>
					<li>Develop and Maintain new and existing tools for artists</li>
				</ul>
			</div>	
			<div class="qualification">
				<h3>Qualifications</h3>
				<table>
					<thead>
						<tr>
							<th>Essential</th>
							<th>Preferable</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Passionate Gamer</td>
							<td>Strong Math Ability</td>
						</tr>
						<tr>
							<td>Bachelors Degree or equivalent in Computer Science</td>
							<td>Optimization and Debugging</td>
						</tr>
						<tr>
							<td>3+ Years of Industry Experience for PC/Consoles</td>
							<td>Multi-thread Programming</td>
						</tr>
						<tr>
							<td>C/C++ Proficiency</td>
							<td>Keeps up to date with latest graphics tech</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</main>
	<?php
		include 'footer.inc';
	?>
</body>
</html>