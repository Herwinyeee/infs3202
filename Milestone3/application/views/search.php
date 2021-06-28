<figure class="main-content">
    <h2 class="title">Search result</h2><hr><br>
    <?php
        if(isset($item)) {
            foreach($item as $row) {
                echo '
                <form method="GET" action = "' . base_url() . 'item/load/" class="flex-content">
                    <figure class="left-part">
                    <img width=40% src="'.  base_url() ."assets/img/mac.png" . '">
                    </figure>
                    <article class="right-part">
                        <input name="itemid" style="display:none" value="' . $row->itemid . '">
                        <input class="submit-btn" type="submit" value = "' . $row->itemname . '">
                    </article>
                </form> 
                <br><br><hr><br>
                
                
                ';
                
            }
        }
    ?>
    
</figure>