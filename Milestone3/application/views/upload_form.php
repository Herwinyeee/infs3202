<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('profile/do_upload');?>

<input type="file" name="userfile" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>