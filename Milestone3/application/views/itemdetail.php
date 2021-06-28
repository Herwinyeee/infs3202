<h2>Item details</h2>
    <hr>
<section id="itemContent">
    
    <figure id="itemImg">
        <img width= 40% src="<?php echo base_url();?>assets/img/mac.png" alt="placehoder">
        <form method="GET" action = "<?php echo base_url();?>item/submit">
                <input name="itemid" style="display:none" value="<?php echo $itemid?>">
                <label for="rating">Rating: </label>
                <input class="login-input" required name="rating" type="number" min=1 max=5><br><br>
                <label for="comment">Comment: </label>
                <textarea class="login-input" required name="comment" cols="40" rows="5" placeholder="Comment here"></textarea><br>
                <input class="submit-btn" type="submit">
            </form>
    </figure>
    <div class="right-part">
        <form method="GET" action="<?php echo base_url();?>item/load" >
            <input name="itemid" style="display:none" value="<?php echo $itemid?>">
            <h2>Item name: <?php echo $itemname;?></h2><br>
            <p>Price:　<?php echo $price;?></p><br>
            <p>Description:　<?php echo $description;?></p><br>
            <p>SellerEmail: <b><?php echo $sellerEmail;?></b></p> 
            <p>Average rating: <?php echo $rating ?></p><br>
            <p>Good comment: <?php echo $comment ?></p><br>
        </form>
        <form method="POST" action="<?php echo base_url();?>contact">
            <input type="submit" value="contact seller">
        </form>
        <form method="POST" action = "<?php echo base_url();?>cart/addCart">
                <input name="itemid" style="display:none" value="<?php echo $itemid?>">
                <input class="submit-btn" type="submit" value="Add To shopping cart">
        </form>
    </div>
</section>
    
