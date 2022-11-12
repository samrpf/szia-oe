<!--
szia
Copyright (c) 2022 samrpf. See the LICENSE file for more information.

v0.2.0. See the CHANGELOG.md file for more information.

█▓▒▒░░░ szia ░░░▒▒▓█
-->

<!-- SETUP START -->

<link rel="favicon" type="image/png" href="/favicon.png" />

<!-- get swal -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- get bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

<style>
	/* using Roboto in this particular project */
	@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap');

	body {
		font-family: Roboto, sans-serif;
		font-weight: 400;
		/* set background */
		background-image: url("/background.jpg");
		/* since the text is going to be on a dark background, it should be light */
		color: white;
	}

	#trunk-link {
		color: white;
	}

	#trunk-link:hover {
		color: lightblue;
	}

	#trunk-link:visited {
		color: white;
	}
	
	#menu	{
  	position: absolute;
		top: 5px;
		right: 5px;
		text-align: right;
		padding-top: 0%;
	}

	#menu-title {
		font-weight: 100;
		font-size: 40px;
	}
	
	button {
		font-size: 13.6px;
	}
</style>

<!-- BODY START -->

<!-- menu -->
<div id="menu">
	<!-- title! -->
	<p id="menu-title">szia</p>
	<!-- trunk/release switcher -->
	<p><a id="trunk-link" href="/trunk.php">switch to trunk</a></p>
	<!-- time box -->
	<div id="time">::placeholder::</div>
	<script>
		function updateTime() {
  		const timeElapsed = Date.now();
  		const todayObject = new Date(timeElapsed);
  		const today = todayObject.toUTCString();
  		document.getElementById("time").innerHTML = today;
			setTimeout(updateTime, 1000);
		}
	
		function sleep(milliseconds) {
  		const date = Date.now();
  		let currentDate = null;
  		do {
    		currentDate = Date.now();
  		} while (currentDate - date < milliseconds);
		}
		
		updateTime();
	</script>
</div>

<!-- window management and button placement -->

<p>Window management is currently a trunk feature.</p>

<!-- toolbar -->

<?php
	/* function add2bar
	 * used to add buttons to the toolbar
	 * - barfn :: javascript function ran when button clicked
	 * - barname :: name that shows on button
	 */
	function add2bar($barname, $barfn) {
  	echo '    <button type="button" class="btn btn-secondary" onclick="'.$barfn.'">'.$barname.'</a></button>';
	}
?>

<script>
	/* functions used in toolbar */
	function openp(url) {
		window.location.href = url;
	}
	function showAbout() {
		swal('about', 'v0.2.0\n\nszia is a project by samrpf to create an online operating environment based on zlinux.\nYou can find zlinux at https://zlinux.mkcodes.repl.co.');
	}
	function showCredits() {
		swal('Credits', 'Base - zlinux (https://zlinux.mkcodes.repl.co)');
	}
	function showLicense() {
		swal('License', 'This piece of software follows the terms of the MIT License.\nYou can find at in the LICENSE file.');
	}
</script>


<style>
	* {
		opacity: 90%;
	}
	
	body {
		opacity: 100%;
	}
	
	body {
  	margin-bottom: -1px;
  	-webkit-background-clip: padding-box; /* for Safari */
  	background-clip: padding-box; /* for IE9+, Firefox 4+, Opera, Chrome */
	}
	
	.center {
		//position fixed
		bottom: 100%;
	}
</style>

<div class="btn-toolbar center fixed-bottom" role="toolbar" aria-label="Toolbar with button groups">
	<div class="btn-group mr-2" role="group" aria-label="First group">
		<?php
			add2bar('about', 'showAbout();');
			add2bar('credits', 'showCredits();');
			add2bar('license', 'showLicense();');
			add2bar('samrpf', 'openp("https://samrpf.wordpress.com");');
		?>
	</div>
</div>
