<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<section id="profile-content">
    <h2 class="title"> Personal Infomation</h2> <hr><br>
    <div class="flex-content">
        <figure id ="profile-photo">
            <img width=40% src="<?php echo base_url("uploads/". $verify_code ."_profile.jpg");?>">
            <?php echo form_open_multipart('profile/do_upload');?>
            <?php echo "<input type='file' name='userfile' size='20' />"; ?>
            <?php echo "<input type='submit' name='submit' value='upload' /> ";?>
            <?php echo form_close(); ?>
        </figure>

        <article id="user-info">
            <h3><b>Username: </b><?php echo $username?></h3><br>
            <form method="POST" action="<?php echo base_url();?>profile/setRegion">
                    <div class="container" style="width:500px;">  
                        <h3 align="center">Find your region</h3><br />  
                        <label>Enter Country Name</label>  
                        <input type="text" name="country" id="country" class="form-control" placeholder="Enter Country Name" />  
                        <br>
                        <input type="submit" class="submit-btn">

                        <div id="countryList"></div>  
                </div>
                <p>region:　<?php echo $region;?></p><br>
            </form>
            <h3><b>Email: </b><?php echo $email?></h3>
            <form method="POST" action="<?php echo base_url();?>profile/update_name">
            <label for="changed">Change your Username: </label>
            <input type="text" name="name" class="login-input">
            <input type="submit" class="submit-btn">
            </form>
        </article>
    </div>
</section>
<script>  
 $(document).ready(function(){  
      $('#country').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:'<?php echo base_url() . "search/findCountry"?>',  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#country').val($(this).text());  
           $('#countryList').fadeOut();  
      });  
 });  
 </script>  

