<footer>
<div id="footbar">
        <div class="row" id="foot-row">
            <div class="col-sm-4">
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">xxxx</a></li>
                    <li><a href="#">xxxx</a></li>
                    <li><a href="#">xxxx</a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <ul>
                    <li><a href="#">Legal Info</a></li>
                    <li><a href="#">xxxx</a></li>
                    <li><a href="#">xxxx</a></li>
                    <li><a href="#">xxxx</a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <ul>
                    <li><a href="#">News</a></li>
                    <li><a href="#">xxxx</a></li>
                    <li><a href="#">xxxx</a></li>
                    <li><a href="#">xxxx</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="footer">
        &copy;Weihao YE - 44682370 [INFS3202]
    </div>
</body>
<script src="<?php echo base_url('js/jquery-3.3.1.min.js');?>"></script>
    	<script src="<?php echo base_url('js/script.js');?>"></script>

    	<!-- Search ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script type='text/javascript'>
            $(document).ready(function(){
                $( "#search-box" ).autocomplete({
                    source: function( request, response ) {
                      // Fetch data
                      $.ajax({
                        url: '<?php echo base_url() . "search/auto"?>',
                        type: 'get',
                        dataType: "json",
                        data: {
                          search: $("#search-box").val()
                        },
                        success: function( data ) {
                          response( data );
                        }
                      });
                    },
                    select: function (event, ui) {
                      $('#search').val(ui.item.label); 
                      return false;
                    }
                  });
            });
        </script>
</html>
    <div class="container">
        <div class="row vcenter">
            <div class="col-xs-6">
                <p>&copy; 2021-<?php echo date("Y"); ?></p>
            </div>
        </div>
    </div>
    <a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?app_id=https://infs3202-b47e29e6.uqcloud.net/Milestone2/&display=popup&ref=plugin&src=share_button" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=580')"><img src="<?php echo base_url(); ?>assets/img/face.png"></a>
    <br>
    
    <div><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-show-count="false">Twitter</a><script async width=640 height=580 src="https://platform.twitter.com/widgets.js" charset="utf-8"></script><div>

</footer>
</body>
</html>
