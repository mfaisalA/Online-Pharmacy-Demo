
<?php require_once('includes/onlinestore_header.php') ?>
<?php
  $product_id = null; 
  if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
  } 

  if(isset($_SESSION['cartManager'])){
    $cartManager = $_SESSION['cartManager'];
  }else{
    // empty cart
  }

 ?>
  <br>
  <!-- Categories -->
  <!--Vertical Tab-->
  <!-- //Categories -->
  <!-- row -->
  <div class="container">
  <br><br><br><br>
  <div class="row">
    <div class="col-md-3">
        <div>
          <a href="online-store.php?cat_id=0" class="list-group-item text-center" style="font-weight: 700; background: #A51D23; color: white"> All Categories
          </a>
        </div>
        <br>

      <?php
      $sqlCat = "SELECT id, category_name, label_color
              FROM product_categories
              WHERE status = 1 AND is_active = 1
              ORDER BY category_name";
              $resultCat=mysqli_query($con,$sqlCat);
              //start category while
              while ($cat = mysqli_fetch_assoc($resultCat)) {
                $numOfProds = getNumOfProdInCat($con, $cat['id']);
                ?>
                
                <div>
                    <a href="online-store.php?cat_id=<?=$cat['id']  ?>" class="list-group-item" style="margin: 2px; font-weight: 700;border-radius: 0px; color:#866"><?=ucfirst($cat['category_name'])  ?> <span class="label <?=qty_label_color($numOfProds) ?> pull-right" style="padding: 4px 14px"><?=$numOfProds ?></span>
                    </a>
                </div>
                <!-- /.div -->
                <?php }// end category while 
                ?>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
  <!-- page content -->

  <?php 

    $sql = "SELECT * FROM products
    WHERE id = $product_id";
    $result = mysqli_query($con, $sql);
    $product = mysqli_fetch_assoc($result);
   ?>
        <div class="right_col" role="main">

          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                <div id="add-to-cart-messages"></div>
                  
                  <div class="x_content">
                  <form id="add-to-cart-form" action="ajax_calls/add-to-cart.php" method="post">
                  <!-- hidden ID field for add to cart -->
                  <input type="hidden" name="product_id" value="<?=$product['id'] ?>">
                    <div class="col-md-6 col-sm-7 col-xs-12">
                      <div class="product-image">
                        <img class="img-responsive" id="img-large" src="productImage/<?=$product['image_1'] ?>" alt="..." />
                        <input type="hidden" name="image" value="<?=$product['image_1'] ?>">
                      </div>
                      <div id="product_gallery" class="product_gallery">
                        <a>
                          <img id="img-small" src="productImage/<?=$product['image_1'] ?>" alt="..." />
                        </a>

                        <?php 
                        // if more images exist
                        if(!empty($product['image_2'])){
                          echo '
                          <a>
                          <img id="img-small" src="productImage/'.$product['image_2'].'" alt="..." />
                          </a>
                          ';                         
                        }
                        if(!empty($product['image_3'])){
                          echo '
                          <a>
                          <img id="img-small" src="productImage/'.$product['image_3'].'" alt="..." />
                          </a>
                          ';                         
                        }
                        ?>
                      </div>
                    </div>

                    <div class="col-md-6 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                    
                      
                      <h3 class="prod_title"><?=$product['product_name'] ?></h3>
                      <input type="hidden" name="name" value="<?=$product['product_name'] ?>">


                      <p class="prod_desc"><?php echo create_summary($product['product_desc'], 200); ?></p>

                      <div class="">
                        <div class="prod_price">
                          <h1 class="price">BD <?= number_format($product['product_price'], 3) ?></h1>
                          <input type="hidden" name="price" value="<?=$product['product_price'] ?>">
                        </div>
                      </div>

                      <div class="">
                        <div class="prod_qty">
                          <button type="button" class="btn btn-lg btn-qty"  onclick="subQty()"><span class="fa fa-minus"></span></button>
                          <input id="qty_value" name="qty_value" type="number" value="1" />
                          <button type="button" class="btn btn-lg  btn-qty"  onclick="addQty()"><span class="fa fa-plus"></span></button>
                        </div>
                        <button type="submit" class="btn btn-lg btn-lg-addtocart"><span class="fa fa-cart-plus"></span> Add to Cart</button><!-- 
                        <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button> -->
                      </div>
                    </div>
                    </form>

                    <div class="col-xs-12">
                    <br><br>

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Description</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in detailed-desc" id="tab_content1" aria-labelledby="home-tab">
                            <p><?=$product['product_desc'] ?></p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        </div>
  </div>
  </div>
    <!-- ./container -->


    <br><br><br>
    <!--footer section start-->   
    <div id="footer">  
      <?php require_once('includes/footer.php'); ?>
    </div>  

    
    <script src="js/vendor/jquery-1.11.2.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/vendor/jquery.jcarousel.js"></script>
    <script src="js/vendor/jquery.jcarousel-autoscroll.js"></script>
    <script src="js/vendor/main.js"></script>
  
  <script src="assets/js/owl.carousel.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>

    <script>
      $(document).ready(function(){
        $('#navPetmart').addClass('active');
      });
    </script> 
      <script type="text/javascript">
       function addQty(){
            
            var prevValueStr = $('#qty_value').val();
            var prevValue = parseInt(prevValueStr);
            $('#qty_value').val(prevValue + 1);
          }
          function subQty(){
            
            var prevValueStr = $('#qty_value').val();
            var prevValue = parseInt(prevValueStr);
            if(prevValue > 1 ){
              $('#qty_value').val(prevValue - 1);
            }
            
          }

          $('#product_gallery').on(
            'click','img', function(){
                var selImg = $(this).attr('src');
                $('#img-large').attr('src', selImg);
            }
          );
      </script>

      <script type="text/javascript">
      $(document).ready(function(){

        $("#add-to-cart-form").on("submit", function() {
            var form = $(this);
            $.ajax({
          url : form.attr('action'),
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success:function(response) {
            $("#cart_qty").html(response.totalCartQty);
              
              $('#add-to-cart-messages').html('<div class="alert alert-success">'+
              '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
              '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
              '</div>');

              $(".alert-success").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                  $(this).remove();
                });
              }); // /.alert

          } // /success
        }); // /ajax  
      return false;
          });

          $(".scroll").click(function(event){   
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
          });
        });
      </script>
</body>
</html>