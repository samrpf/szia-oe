<!--
szia
Copyright (c) 2022 samrpf. See the LICENSE file for more information.

v0.3.0-trunk. See the CHANGELOG.md file for more information.

█▓▒▒░░░ szia ░░░▒▒▓█
-->

<!-- trunk-specific changes
75 :: 'switch to release' button
320 :: 'about' menu with a trunk version number
363-369 :: pop-up swal reminding user of trunk switch
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
	<p><a id="trunk-link" href="/">switch to release</a></p>
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

<?php
/* add function 
 * used to add apps to the appbar
 */
function add($appURL, $appName, $iconURL, $id, $cHtml) {
  $script = "
  <!-- import jquery -->
  <script src='https://code.jquery.com/jquery-1.12.4.js'></script>
  <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>

  <!-- window style -->
  <style>
    #%id%draggable {
        outline: 1px solid white;
    }

    iframe {
        outline: none;
        border: none;
        resize: both;
        overflow: auto;
        position: auto;
    }

    #%id%draggable {
        position: absolute !important;
        top: 0;
        left: 50%;
    }

    img {
        display: inline-block;
    }
  </style>

  <script>
    // set the window as draggable
    $(function() {
      $('#%id%draggable').draggable();
    });
    // set the open button as draggable
    $(function() {
      $('#%id%button').draggable();
    });
    // set the window as resizable
    $(function() {
        $('#%id%draggable').resizable();
    });

    // 
    function %id%show() {
      $('#%id%draggable').show();
      document.getElementById('%id%button').style.backgroundColor = '#91c4ed';
    }
    function %id%hide() {
      $('#%id%draggable').hide();
      document.getElementById('%id%button').style.backgroundColor = 'transparent';
      }
    function %id%min() {
      document.getElementById('%id%button').style.backgroundColor = 'grey';
    }
    %id%z = 0;
    %id%x = 0;
    function %id%so() {
        if (%id%button.style.backgroundColor == 'grey') {
            %id%button.style.backgroundColor == 'blue';
            %id%show();
            return 0;
        }
        if (%id%z == 0) {
            %id%z = 1;
            %id%show();
        } else {
            %id%z = 0;
            %id%hide();
        }
        %id%x += 1;
        if (%id%x == 1) {
            // sets the iframe window to the url
            document.getElementById('%id%frame').src = '%url%';
        }
    }
    
    document.getElementById('%id%button').style.top = Math.floor((Math.random() * 230) + 1) + 'px';
    document.getElementById('%id%button').style.left = Math.floor((Math.random() * 200) + 1) + 'px';
    $(function() {
        $('#%id%frame').focusin(function() {
            // when the window earns focus, set the background to a distinct colour of 
            document.getElementById('%id%focus').style.backgroundColor = '#91c4ed';
        });
    });
    $('%id%frame').focusout(function() {
        // transparency 100 when window loses focus
        document.getElementById('%id%focus').style.backgroundColor = 'transparent';
    });
    function %id%reload() {
        // reloads the iframe window by changing the url just a tiny bit
        document.getElementById('%id%frame').src += '';
    }
  </script>

  <!-- opening button -->
  <button
      type='button'
      id='%id%button'
      onclick='%id%so()'
      style='
          border: 1px solid grey;
          outline: none;
          background-color: transparent;
          color: white;
          position: fixed;
          '>
      %name%
  </button>

  <br />

  <!-- window -->
  <div
    id='%id%draggable'
    class='ui-widget-content'
    style='width:50%; height:50%;'>

    <p style='color: white;'>[%name%]</p>

    <!-- minimize button -->
    <a
        onclick='
            %id%hide();
            %id%min();
            '
        style='color: white;'>
        [-]
    </a>
    <!-- close button -->
    <a
        onclick='
            %id%hide();
            document.getElementById('%id%frame').src += '';
            '
        style='color: white;'>
        [x]
    </a>

    <focus id='%id%focus'>‪ ‪</focus>

    <!-- reload button -->
    <a
        style='
            color: white;
            text-decoration: none;
            '
        id='%id%reload'
        href='javascript:%id%reload()'>
        [reload]
    </a>

    <!-- webpage button -->
    <a
        style='
            color: white;
            text-decoration: none;
            '
        href='%url%'>
        [webpage]
    </a>
    
    <!-- window iframe -->
    <iframe
        id='%id%frame'
        src='about:blank'
        style='width:100%; height:89%;'>
    </iframe>
    <script>
        $(function () {
            $('\#%id%draggable').resizable();
        });
    </script>
  </div>

  <script>
      $('#%id%button').draggable({cancel:false});
      %id%hide();
  </script>
  ";
  //%id %name %url
  $script = str_replace("%id%", $id, $script);
  $script = str_replace("%name%", $appName, $script);
  $script = str_replace("%url%", $appURL, $script);
  $script = str_replace("%img%", $iconURL, $script);
  echo $script.$cHtml;
}

add('/browser/browser.html', 'browser', '', 'wbr', '');
add('https://kim.samrcode.repl.co', 'kim', 'https://kim.samrcode.repl.co/static/img/kim-favicon.png', 'kimapp', '');
?>



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
		swal('about', 'v0.3.0-trunk\n\nszia is a project by samrpf to create an online operating environment based on zlinux.\nYou can find zlinux at https://zlinux.mkcodes.repl.co.');
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

<!-- trunk notice -->
<script>
	swal(
		'trunk',
		'You are using the trunk version of szia, which contains upcoming features.\nPlease note that some features may not work as intended in trunk mode.\nYou can always switch back by clicking the "Switch to release" button in the menu at the top-right.'
	);
</script>
