<html>
        <head>
                <title>Let's do shopping</title>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
                <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css"> -->

                <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        </head>
        <body>
  <script>
        // Show select image using file input.
        function readURL(input) {
            $('#default_img').show();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#select')
                        .attr('src', e.target.result)
                        .width(300)
                        .height(200);

                };

                reader.readAsDataURL(input. files[0]);
            }
        }
    </script>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Let's do shopping</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a href="<?php echo base_url(); ?>"> Home </a>
            &nbsp;|&nbsp;
            <a href="<?php echo base_url(); ?>contact/send"> Email&nbsp; </a>
            <a href="<?php echo base_url(); ?>encryptionDecryption"> |&nbsp; encrypt test &nbsp; </a>

        </li>
    </ul>
    <ul class="navbar-nav my-lg-0">
    <a href="<?php echo base_url(); ?>fullcalendar/"> Calendar &nbsp;</a>|&nbsp;

    <a href="<?php echo base_url(); ?>profile/"> Profile&nbsp;</a>|&nbsp;
    <?php if(!$this->session->userdata('logged_in')) : ?>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>login"> &nbsp;Login&nbsp;  </a>
            <?php echo " "?>
          </li>
          <?php endif; ?>
          <?php if($this->session->userdata('logged_in')) : ?>
            <li class="nav-item">
            <a href="<?php echo base_url(); ?>login/logout"> Logout&nbsp;  </a>
           </li>
           <?php endif; ?>
           | <?php echo " "?>
            <a href="<?php echo base_url(); ?>register">  &nbsp;Register&nbsp; </a>
    </ul>
    </div>
    <?php
      if (isset($this->session->active_time)) {
        if (time() - $this->session->userdata('active_time') >= 600) {
            redirect(base_url() . "login/logout");
        } else {
          $_SESSION['active_time'] = time();
        }
      }
      ?>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<div class="container">

