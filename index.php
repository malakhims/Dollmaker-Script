<!DOCTYPE HTML>
<html>
<head>
	
	<meta name="viewport" http-equiv="Content-Type">
	<title id="title">doll maker template</title>

	<!---THE STYLESHEET-->
	<link id="main-css" rel="stylesheet" type="text/css" href="styles/mainstylesheet.css" charset="utf-8">
	<link id="colors-css" rel="stylesheet" type="text/css" href="styles/colors.css" charset="utf-8">


	<!--JQUERY, JQUERYUI, TOUCH PUNCH, FILESAVER, HTML2CANVAS, HTML2CANVAS FORK, DRAGANDDROP-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js" integrity="sha256-AlTido85uXPlSyyaZNsjJXeCs07eSv3r43kyCVc8ChI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@rwap/jquery-ui-touch-punch@1.1.5/jquery.ui.touch-punch.min.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/lottev1991/html2canvas@1.6.5-custom/dist/html2canvas.min.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="scripts/drag.js"></script>

</head>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ignore = array(".", "..", ".htaccess", ".DS_Store");
/* This function now also accepts creating buttons for removing an image. It is no longer restricted to backgrounds alone.
To do this, just put the image button in the root folder of the clickable option.
You can name the button anything you like. */
function displayBase($path, $ignore) {
	$images = scandir("$path/thumbnails");
	$noneimg = scandir("$path"); // The button image that returns none should always go in the root folder
	$ignorefol = array("full", "thumbnails"); //Exclude subfolders
	// Defines "none"-buttons
	foreach ($noneimg as $curimg) {
		if (!in_array($curimg, $ignore) && !in_array($curimg, $ignorefol)) {
			$filetitle = pathinfo($curimg, PATHINFO_FILENAME);
			/* Replace specific characters to susbtitute characters PHP struggles with */
			$find = ['-slash-', '``', '`',];
			$replace = ['/', '"', "'"];
			echo "<a href=\"\"><img src=\"$path/$curimg\" alt=\"" . str_replace($find, $replace, ltrim(basename($filetitle), '1234567890')) . "\" title=\"" . str_replace($find, $replace, ltrim(basename($filetitle), '1234567890')) . "\"></a>";
		}
	}
	// Defines regular buttons that always return images
	foreach ($images as $curimg) {
		if (!in_array($curimg, $ignore)) {
			$filetitle = pathinfo($curimg, PATHINFO_FILENAME);
			$find = ['-slash-', '``', '`',];
			$replace = ['/', '"', "'"];
			echo "<a href=\"$path/full/$curimg\"><img src=\"$path/thumbnails/$curimg\" alt=\"" . str_replace($find, $replace, ltrim(basename($filetitle), '1234567890')) . "\" title=\"" . str_replace($find, $replace, ltrim(basename($filetitle), '1234567890')) . "\"></a>";
		}
	};
}
?>
<body>

<!----
===============
===============
===============

Title 
And Subtitle 
at top of page 


===============
===============
===============
---->

	<h1 id="page-header">DOLLMAKER TEMPLATE</h1>
	<h2 id="page-subheader">YIPPIE YIPPIE YAYAY</a></h2>


	<!-- 
	=================
	
	You may not wanna mess with this too much
	 
	Edit styling in styles/mainstylesheet.css) 
	
	=================
	-->
	<div id="dollmaker_container">
		<div id="bodyArea" class="ui-corner-all" title="Make your doll here.">
			<?php
			/* Find-and-replace options for variable names. */
			$ignore = array(".", "..", ".htaccess", ".DS_Store");
			$randfol = "(random)";  /* The "(random)" suffix is for images you don't want to see randomized. Any folder that doesn't have this suffix will have randomized settings on page load (you can change them manually later). */
			$find = ['-slash-', '``', '`', $randfol];
			$replace = ['/', '"', "'", ''];
			$cssfind = [" $randfol", ' '];
			$cssreplace = ['', '-'];
			$folders = scandir("base/");
			foreach ($folders as $key => $curfol) {
				if (!in_array($curfol, $ignore)) {
					$key = $key - 1;
					$imageDir = "base/$curfol/full/";
					$images = glob($imageDir . '*.*', GLOB_BRACE);
					$randomImage = $images[array_rand($images)]; /* Randomize relevant parts. You can change these manually later if you want. */
					$filetitle = pathinfo($randomImage, PATHINFO_FILENAME);
					// Different settings for static vs. randomized images
					if (str_ends_with($curfol, $randfol)) { // Randomized images
						echo "<img id=\"" . ltrim(str_replace($cssfind, $cssreplace, $curfol), '1234567890') . "\" src=\"" . $randomImage . "\" alt=\"" . $filetitle ."\" title=\"" . $filetitle ."\" class=\"clickable\">\n";
					} else { // Static non-randomized images
						foreach ($images as $key => $curimg) {
							if (!in_array($curimg, $ignore)) {
								$key = $key - 1;
								echo "<img id=\"" . ltrim(str_replace($cssfind, $cssreplace, $curfol), '1234567890') . "\" class=\"clickable\">\n";
							}	
						}	
					}
				}
			}
			?>



			<!----
			===============
			===============
			===============

			You edit these in the CSS file.
			I really recommend not touching area in the HTML itself
			if you're not good at bug fixing


			===============
			===============
			===============
			---->

			<div id="avi-area"></div>
			</div>


				<!----
				===============
				===============
				===============

				The sidebar containing the avatar and instructions. 
				Edit the lis freely but know they have weird default 
				styling (can easily be changed)

				Buttons are defined in drag.js so you can add more if you'd
				like 

				I commented out an instruction. You can put it back. More context further down.
				===============
				===============
				===============
				---->

			<div id="swatchesArea" class="ui-corner-all">
				
			
			<button id="instrBtn" alt="Click here to toggle the instructions for the dollmaker." title="Click here to toggle the instructions for the dollmaker.">Dollmaker instructions</button>
				<div id="instructions">
					<ul id="instructions-list">
						<li>Drag and drop the <b>items</b> from the middle-right of the page onto the doll above.</li>
						<li>For easy navigation among the different items, you can click on the <b>tab of your choice</b> at the top of the page.</li>
						<li>You're encouraged to zoom in and out to make placing things easier.</li>
						<li>Click on the <b>swatches</b> below to change skin and eye color, as well as the doll background. You choose the eye color per eye, so that you can easily give your doll two different eye colors with any combination of colors.</li>
						<li>Click on the <b>"Download doll"</b> button below to download your finished doll.</li>
						<!-- Make sure to adjust the listed avatar dimensions here too! -->
						<!---
						<li>Click on the <b>"Download avatar (100x100)"</b> button to download a cropped avatar of your doll.</li>
						-->
						<li>Click on the <b>"Reset dollmaker"</b> button to reset the dollmaker.</li>
						<li>Click on the <b>"Toggle fullscreen"</b> button to toggle between fullscreen and windowed mode.</li>
					</ul>
				</div>
			
			<br>

			
		<button id="termBtn" alt="Click here for terms" title="Click here for terms.">Terms of Use</button>
			<div id="terms">
				<ul id="terms-list">
					<li>List your terms here</li>
					<li>Or don't. I'm not your mom.</a>
					<li>Remember you can include things like if you're okay with recoloring, your repost perms, etc etc</li>
				</ul>
			</div>
			

			<!--- 
			=========
			==========
			=========
			Quality of Life tools for doll maker players.
			The original download comes with a download 100x100 icon
			but I don't think this is a good feature so I've commented it out.
			======
			======
			======
			-->


			<h3>Tools:</h3>
				<button id="downloadDoll" alt="Click here to download your finished doll." title="Click here to download your finished doll.">Download doll</button>
				<button id="downloadAvi" alt="Click here to download a 100x100 avatar of your doll." title="Click here to download a 100x100 avatar of your doll.">Download avatar (100x100)</button> -->
				<button id="fullscreen" alt="Click here to toggle between fullscreen and windowed mode. (On desktop, you can also press F11.)" title="Click here to toggle between fullscreen and windowed mode. (On desktop, you can also press F11.)" onclick="toggleFullScreen()">Toggle fullscreen</button>
				<button id="reset" alt="Click here to reset the dollmaker to its default settings." title="Click here to reset the dollmaker to its default settings.">Reset dollmaker</button>


			
			<!--- 
			=========
			==========
			Below is PHP I had to fuck around with a lot.
			If you have any PHP knowledge, you may want to clean it up
			yourself, but it works very well for me.
			This is for scanning the image directories and making the arrays used in the dollmaker


			
			======
			======
			======
			-->

				<?php 
				$folders = scandir("base/");
				$ignore = array(".", "..", ".htaccess", ".DS_Store");
				foreach ($folders as $key => $curfol) {
					if (!in_array($curfol, $ignore)) {
						$key = $key - 1;
						$find_id = [' (random)', ' '];
						$replace_id = ['', '-'];
						$find_title = [' (random)'];
						$replace_title = [''];
						$id = str_replace($find_id, $replace_id, ltrim($curfol, '1234567890'));
						$title = str_replace($find_title, $replace_title, ltrim($curfol, '1234567890'));
						echo "<div id=\"" . $id . "-switch\" class=\"switcher\">\n"; // The "switcher" class is so that the switchers can be easily found with JavaScript
						echo "<h3>" . $title . ":</h3>\n";
						echo displayBase("base/$curfol", $ignore);
						echo "</div>\n";
					}
				}
				?>


			<!--- 
			=========
			==========
			You may want to give this a quick look
			through to see how directories 
			are set up if it makes sense to you, 
			but from here on out, you're free to do as you like.

			Just set up your images and put them in the directories. Be sure to trim them.
			
			======
			======
			======
			-->
				
		</div>
			<div id="piecesArea" alt="You can drag pieces from this area." title="You can drag pieces from this area.">
				<?php
				$folders = scandir("images/");

				/*Display the tabs according to folder names*/
				echo "<ul id=\"tabsbar\">";
				foreach ($folders as $key => $curfol) {
					if (!in_array($curfol, $ignore)) {
						$curfol = str_replace($find, $replace, ltrim($curfol, '1234567890')) ;
						$find = ['-slash-', '``', '`',];
						$replace = ['/', '"', "'"];
						$key = $key - 1;
						echo "<li><a href=\"#tabs-" . $key . "\">" . $curfol . "</a></li>\n";
					}
				};
				echo "</ul>";

				/*For each tab, display the props*/
				foreach ($folders as $key => $curfol) {
					if (!in_array($curfol, $ignore)) {
						$key = $key - 1;
						echo "<div id=\"tabs-" . $key . "\">\n";
						
						$images = scandir("images/" . $curfol);
						foreach ($images as $curimg) {
							if (!in_array($curimg, $ignore)) {
								$filetitle = pathinfo($curimg, PATHINFO_FILENAME);
								echo "<img alt=\"" . str_replace($find, $replace, basename($filetitle)) . "\" src=\"images/" . $curfol . "/" . $curimg . "\" title=\"" . str_replace($find, $replace, basename($filetitle)) . "\" class=\"draggable\">";
							}
						}
						echo "</div>\n";
					}
				};
				?>
			</div>
	</div>

</body>
</html>