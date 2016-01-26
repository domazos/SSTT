<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$titulo}</title>

{if isset($css_files)}
	{foreach from=$css_files item=css_uri}
		<link href="{$css_uri}" rel="stylesheet" type="text/css" media="screen" />
	{/foreach}
{/if}

{if isset($js_files)}
	{foreach from=$js_files item=js_uri}
		<script type="text/javascript" src="{$js_uri}"></script>
	{/foreach}
{/if}

</head>

<body>
	<div class="header">
    	<div class="logo">{$logo}</div>
    	<div class="logout">{$logout}</div>
    </div>
    
    <div class="linea">&nbsp;</div>
    
    <div class="main">