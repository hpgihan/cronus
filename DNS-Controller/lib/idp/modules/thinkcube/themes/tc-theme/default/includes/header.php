<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php



/**
 * Support the htmlinject hook, which allows modules to change header, pre and post body on all pages.
 */
$this->data['htmlinject'] = array(
	'htmlContentPre' => array(),
	'htmlContentPost' => array(),
	'htmlContentHead' => array(),
);


$jquery = array();
if (array_key_exists('jquery', $this->data)) $jquery = $this->data['jquery'];

if (array_key_exists('pageid', $this->data)) {
	$hookinfo = array(
		'pre' => &$this->data['htmlinject']['htmlContentPre'], 
		'post' => &$this->data['htmlinject']['htmlContentPost'], 
		'head' => &$this->data['htmlinject']['htmlContentHead'], 
		'jquery' => &$jquery, 
		'page' => $this->data['pageid']
	);
		
	SimpleSAML_Module::callHooks('htmlinject', $hookinfo);	
}
// - o - o - o - o - o - o - o - o - o - o - o - o -




?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/script.js"></script>
<title><?php
if(array_key_exists('header', $this->data)) {
	echo $this->data['header'];
} else {
	echo 'Thinkcube Single sign-on';
}
?></title>

	
        <link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/tc-theme/default.css" />
	<link rel="icon" type="image/icon" href="/<?php echo $this->data['baseurlpath']; ?>resources/tc-theme/icons/favicon.ico" />

<?php

if(!empty($jquery)) {
	$version = '1.5';
	if (array_key_exists('version', $jquery))
		$version = $jquery['version'];
		
	if ($version == '1.5') {
		if (isset($jquery['core']) && $jquery['core'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery.js"></script>' . "\n");
	
		if (isset($jquery['ui']) && $jquery['ui'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-ui.js"></script>' . "\n");
	
		if (isset($jquery['css']) && $jquery['css'])
			echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] . 
				'resources/uitheme/jquery-ui-themeroller.css" />' . "\n");	
			
	} else if ($version == '1.6') {
		if (isset($jquery['core']) && $jquery['core'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-16.js"></script>' . "\n");
	
		if (isset($jquery['ui']) && $jquery['ui'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-ui-16.js"></script>' . "\n");
	
		if (isset($jquery['css']) && $jquery['css'])
			echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] . 
				'resources/uitheme16/ui.all.css" />' . "\n");	
	}
}

if(!empty($this->data['htmlinject']['htmlContentHead'])) {
	foreach($this->data['htmlinject']['htmlContentHead'] AS $c) {
		echo $c;
	}
}




?>

	
	<meta name="robots" content="noindex, nofollow" />
	

<?php	
if(array_key_exists('head', $this->data)) {
	echo '<!-- head -->' . $this->data['head'] . '<!-- /head -->';
}
?>
</head>
<?php
$onLoad = '';
if(array_key_exists('autofocus', $this->data)) {
	$onLoad .= 'SimpleSAML_focus(\'' . $this->data['autofocus'] . '\');';
}
if (isset($this->data['onLoad'])) {
	$onLoad .= $this->data['onLoad']; 
}

if($onLoad !== '') {
	$onLoad = ' onload="' . $onLoad . '"';
}
?>
<body<?php echo $onLoad; ?>>

<div id="wrap">
	
	<div id="header">
		<h1><a style="text-decoration: none; color: black" href="/<?php echo $this->data['baseurlpath']; ?>"><?php 
			echo (isset($this->data['header']) ? $this->data['header'] : 'Thinkcube Single sign-on'); 
		?></a></h1>
	</div>

	<div id="content">



<?php

if(!empty($this->data['htmlinject']['htmlContentPre'])) {
	foreach($this->data['htmlinject']['htmlContentPre'] AS $c) {
		echo $c;
	}
}
