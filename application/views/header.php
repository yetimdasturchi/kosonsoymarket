<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($transparent_header)) {
   $transparent_header = 'colored-header';
}
?>
<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
   <head>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
      {02bd92faa38aaa6cc0ea75e59937a1ef}
      <meta http-equiv="Cache-control" content="public">

      <meta name="description" content="<?=$header['description'];?>">
		<meta name="keywords" content="<?=$header['keywords'];?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta property="og:title" content="<?=$header['title'];?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?=base_url();?>">
		<meta property="og:description" content="<?=$header['description'];?>">
		<meta property="og:image" content="<?=$header['og_image'];?>">    
		<meta property="og:image:width" content="200" />
		<meta property="og:image:height" content="200" />
       	
      <title><?=$header['title'];?></title>
      <!-- =-=-=-=-=-=-= Favicons Icon =-=-=-=-=-=-= -->
      <link rel="icon" type="image/png" href="{setting=style_path}images/favicon.png">
      <!-- =-=-=-=-=-=-= Mobile Specific =-=-=-=-=-=-= -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <!-- =-=-=-=-=-=-= CSS Style =-=-=-=-=-=-= -->
     	<!-- <link rel="stylesheet" href="<?=base_url()?>style.css">-->
     	<?
     		$css = $this->config->item('style_css');
     		foreach ($css as $row) {
     			//echo '<link rel="stylesheet" href="'.$row.'">'.PHP_EOL;
     		}
     	?>
      <link rel="stylesheet" href="{setting=style_path}css/site.css">
      <!-- JavaScripts -->
      <script src="{setting=style_path}js/modernizr.js"></script>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
     <!-- =-=-=-=-=-=-= Transparent Header =-=-=-=-=-=-= -->
      <div class="<?=$transparent_header;?>">
         <!-- Top Bar -->
         <div class="header-top">
            <div class="container">
               <div class="row">
                  <!-- Header Top Left -->
                  <div class="header-top-left col-md-8 col-sm-6 col-xs-6">
                     <ul class="listnone">
                        <li><a href="<?=base_url('p/about')?>"><i class="fa fa-info" aria-hidden="true"></i> {language=about_us}</a></li>
                     </ul>
                  </div>
                  <!-- Header Top Right Social -->
                  <div class="header-right col-md-4 col-sm-6 col-xs-6 ">
                     <div class="pull-right">
                        <ul class="listnone">
                           <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe" aria-hidden="true"></i> <?=get_languge_name(getDefaultLang());?> <span class="caret"></span></a>
                              <ul class="dropdown-menu language-list">
                              <?
                                 $languages = $this->config->item('languages_list');
                                 foreach ($languages as $key => $value) {
                                    if (getDefaultLang() != $key) {
                                       echo '<li><a href="'.base_url('l/'.$key).'">'.$value.'</a></li>';
                                    }
                                 }
                              ?>
                           </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Top Bar End -->
         <!-- Navigation Menu -->
         <nav id="menu-1" class="mega-menu">
               <!-- menu list items container -->
               <section class="menu-list-items">
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-12 col-md-12">
                           <!-- menu logo -->
                           <ul class="menu-logo">
                              <li>
                                 <a href="<?=base_url();?>"><img src="{setting=style_path}images/logo-1.png" alt="logo"> </a>
                              </li>
                           </ul>
                           <!-- menu links -->
                           <ul class="menu-links">
                              <!-- active class -->
                              <li><a href="<?=base_url();?>">{language=home}</a></li>
                              
                              <li><a href="<?=base_url('ads');?>">{language=ads}</a></li>   

                              <li><a href="<?=base_url('p/news');?>">{language=news}</a></li>
                              <li><a href="<?=base_url('p/about#advertising');?>">{language=advertising}</a></li>
                              <li class="visible-xs visible-md visible-sm"><a href="<?=base_url('p/about')?>">{language=about_us}</a></li>
                              <li><a href="<?=base_url('p/contact');?>">{language=contact} </a></li>
                           </ul>
                           <ul class="menu-search-bar">
                              <li>
                                 <a href="<?=base_url('post-ad');?>" class="btn btn-light"><i class="fa fa-plus" aria-hidden="true"></i> {language=post_ad}</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </section>
            </nav>
      </div>
      <!-- Navigation Menu End -->
      <!-- =-=-=-=-=-=-= Transparent Header End =-=-=-=-=-=-= -->