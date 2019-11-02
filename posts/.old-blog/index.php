<html>
<?php
include "getFromSlug.php";

$path = realpath($_GET["f"] ? $_GET["f"] : ".");
$contentonly = array_key_exists("c",$_GET);
$root = realpath(getcwd());
$title = "blog";

/* Not found, or forbidden... try slug */
if (0 !== strpos($path, $root)) {
	$path = "/home/alex/dixonary/blog/".getFromSlug($_GET["f"]).".html";
}

if (0 !== strpos($path, $root)) {
	?><h1> 404 Not Found </h1><?php
	http_response_code(404);
	exit();
}

include "../boilerplate.php";

$current = substr(realpath($path), strpos(realpath($path), "blog")-1);
$upone = substr(realpath(dirname($path)), strpos(realpath(dirname($path)), "blog")-1);

if (is_dir($path)) {
	$d = dir($path);
	if(basename($path) !== "blog" && !$contentonly) {
		?>
	<a href="<?=$upone?>">
			&lt;-- back to <?=basename(dirname($path))?>
&#8203;</a>
		<?php
	}
	echo "<h1>" . strtoupper(basename($path)) . "</h1>";
	echo "<div class='spacer small'></div>";
	if(is_file($path."/.info")) {
		$dirinfo = file_get_contents($path."/.info");
		echo "<p id='dirinfo'>".$dirinfo."</p>";
		echo "<div class='spacer small'></div>";
	}
	echo "<div id='listing'>";
	$files = explode("\n",shell_exec("ls --group-directories-first -1 $path"));
	foreach ($files as $file) {
		$fullpath = $path . "/" . $file;
		$fname = (strrpos($file,".") == 0) ? $file : substr($file,0,strrpos($file,"."));
		$externalpath = $current . "/" . $fname; 
		/* Only consider HTML files or directories*/
		if(!is_dir($fullpath) && pathinfo($fullpath)['extension'] == "html") {
			$f = fopen($fullpath, "r");
			$title = preg_replace('/<!--(.*)-->/','$1',fgets($f));
			?>
			<div class="direntry"><a href="<?=$externalpath?>">
				<?=$title?>
			</a></div>
			<?php
		}
		else if(is_dir($fullpath) && strlen($file) > 2) {
			?>
			<div class="direntry"><a href="<?=$externalpath?>">
				[<?=$file?>]
			</a></div>
			<?php
		}
	}
	echo "</div>";
	$d -> close();
}
else if (is_file($path)) {
        if($contentonly) {
?>
<link rel="stylesheet" href="/contentonly.css">
<?php
        }
	if(!$contentonly) {
	?>
	<a href="<?=$upone?>">&lt;-- back to <?=basename(dirname($path))?></a>
	<div class="spacer small"></div>
	<?php
	}
	echo file_get_contents($path);
}
else {
?>
<h1>404 - not found. </h1>
<?php
}
?>
<script>
$(".footnoteRef").hover(
	function() {
		var rid=$(this).attr("href").substr(3);
		var newtooltip=$('<div class="tooltip"></div>');
		newtooltip.appendTo($("body"));
		newtooltip.remove("[href*='#fnref']");
		$($("#fn"+rid).html()).appendTo(newtooltip);
		$(this).mousemove(function(event) {
			console.log(event.pageX);
			console.log(event.pageY);
			newtooltip.css("left", ""+(event.pageX+5));
			var top = (event.pageY - newtooltip.height());
			if(top>=0) newtooltip.css("top", ""+top);
			else	   newtooltip.css("top", 0);
			var right = $(window).width() - (newtooltip.width() + newtooltip.offset().left);
			if(right < 0) {
				newtooltip.css("left", ""+(event.pageX-50 - newtooltip.width()));
			}
			
		});
	},
	function() {$(".tooltip").remove();$(this).off("mousemove")} 
);

$(document).keydown(function(e) {
    if(e.keyCode == 69 && e.shiftKey && e.ctrlKey) {
        window.location = "/blogedit?e=<?=basename($path, ".html")?>";
    }
});
</script>

