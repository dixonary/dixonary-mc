<?php

function getFromSlug($slug) {

	$basedir = "/home/alex/dixonary/blog/";
	$res = shell_exec("find $basedir -name $slug.md | head -n1 ");
	if ($res == "") {
		return "$slug";
	}
	else {
		$info = pathinfo($res);
		$dn = substr($info['dirname'], strlen($basedir)); $bn = $info['filename'];
		return "$dn/$bn";
	}

}

?>
