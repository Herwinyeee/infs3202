<h2>Post Item</h2>
<div class="post-content">    
    <figure>
        <img width= 40% src="<?php echo base_url();?>assets/img/mac.png" alt="placehoder">
    </figure>
    <figure>
        <form method="GET" action="<?php echo base_url();?>post/check_post">
        <label class="item-label" for="item-name">Item Name:</label><br>
        <input class="item-input" type="text" name="itemname" placehoder="please enter Item name"><br>
        <label class="item-label" for="item-price">Price: </label><br>
        <input class="item-input" type="text" name="itemprice"placehoder="please enter Item price"><br>
        <label for="Description">Description</label><br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
        <input type="checkbox" checked name="hide">
        <label class="remind" for="hide">Hide my email</label><br>
        <input class="submit-btn" type="submit">
        </form>
    </figure>
    
</div>