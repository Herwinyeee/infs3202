<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
<title>milstone 2</title>
</head>
<section id="main-content">
    <a <?php echo 'href="'.base_url().'post"'?>>Post/Bid</a>
    <a <?php echo 'href="'.base_url().'products"'?>>Products</a>
    <a <?php echo 'href="'.base_url().'cart"'?>>Cart</a>

    <a href="">Login</a>
</section>
<div id="home">

</div>
<br>
<br>
<br>
<br>
<form id="search" method="GET" action="<?php echo base_url();?>search">
    <input id="search-box" name="search" type="search" placeholder="Search items" aria-label="Search">
</form>  


</html>