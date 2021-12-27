<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = base_url();
		
?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<link rel="icon" type="image/png" href="{setting=style_path}images/favicon.png">
<meta name="viewport" content="width=device-width,initial-scale=1.0" />

  <meta charset="UTF-8">
  <title>{language=error_title}</title>
  <link rel="stylesheet" href="{setting=style_path}css/error.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="mars"></div>
<img src="{setting=style_path}images/error/404.svg" class="logo-404" />
<img src="{setting=style_path}images/error/meteor.svg" class="meteor" />
<p class="title">{language=error_header}</p>
<p class="subtitle">
	{language=error_message}
</p>
<div align="center">
	<a class="btn-back" href="{base_url}">{language=error_back_home}</a>
</div>
<img src="{setting=style_path}images/error/astronaut.svg" class="astronaut" />
<img src="{setting=style_path}images/error/spaceship.svg" class="spaceship" />
</body>
</html>