<figure class="main-content">
    <h2 class="title">Forget Password</h2><hr><br>
    <form method="GET" action = "<?php echo base_url();?>password/sendTokens">
        <label for="email" class="login-label">Email: </label><br>
        <input class="login-input" type="email" name="email" placeholder="Enter your email" required>
        <input class="submit-btn" type="submit" value="Send restet tokens">
        <br>
        <strong class="remind" style="color:red"><?php echo $status ?></strong><br>
    </form>  
    <br>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <?php if ($show == true) {
        echo '<form method="POST" action = "' . base_url() . 'password/show_result">
        ';
        echo '<input class="login-input" type="email" name="email" placeholder="Enter your email before and receive the tokens" value="'. $email .'" style="display:none" required readonly="readonly">';
        
        echo '
        <label for="tokens" class="login-label">Reset token: </label><br>
        <input class="login-input" type="text" name="tokens" placeholder="Enter reset tokens" required>
        <br>
        <label for="password" class="login-label">New password: </label><br>
        <input class="login-input" type="password" name="password" placeholder="Enter your new password" required><br>
        <label for="password" class="login-label">Confirm password: </label><br>
        <input class="login-input" type="password" name="re-password" placeholder="Enter your password" required><br>
        <strong class="remind" style="color:red">'. $repeat .'</strong><br>
        <input class="submit-btn" type="submit" value="confirm"><br>
        <strong class="remind" style="color:red">'. $status1 .'</strong><br>
    </form>' ;
    }?>
     
</figure>


		