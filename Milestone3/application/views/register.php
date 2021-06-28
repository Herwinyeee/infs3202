<html>
<head>
    <title>Sign up</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> -->
</head>
<figure class="main-content">
    <h2 class="title">Sign up</h2><hr><br>
    <?php
                if($this->session->flashdata('message'))
                {
                ?>
                    <div class="alert alert-danger">
                        <?php
                        echo $this->session->flashdata('message');
                        ?>
                    </div>
                <?php
                }

                if($this->session->flashdata('success_message'))
                {
                ?>
                    <div class="alert alert-success">
                        <?php
                        echo $this->session->flashdata('success_message');
                        ?>
                    </div>
                <?php
                }
                ?>
    <form method="POST" id="captcha_form" action = "<?php echo base_url();?>register/submit">
        <label for="email"  class="login-label"><b>Email:</b> </label><br>
        <input class="login-input" type="email" name="email" placeholder="Enter your email" required>
        <br>
        
        <?php echo $exist ?>
        <label for="text" class="login-label"><b>Username:</b> </label><br>

        <input class="login-input" type="text" name="username" placeholder="Enter your name" required><br>
        <label for="password" class="login-label"><b>Password:</b> </label><br>
        <input class="login-input" type="password" name="password" placeholder="Enter your password" required><br><br>
        <?php echo $error ?>
        
        <strong class="remind" style="color:green"><?php echo $status ?></strong><br>
        <br>
        
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6Lfi67waAAAAADcxovbcwMRMAHUkiVQy8NXdze6i"></div>
            </div>
            <div class="form-group">
                <input type="submit" name="send" class="btn btn-success" value="Send" />
        </div>
    </form>  
</figure>
