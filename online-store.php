
<?php require_once('includes/onlinestore_header.php') ?>
<?php
  $cat_id = 0; // 0 for all categories
  $subcat_id = 0; // when subcat_id = 0, means searched by category
  $searchStr = '';
  if(isset($_GET['cat_id'])){
    $cat_id = $_GET['cat_id'];
  }
  if(isset($_GET['searchStr'])){
    $searchStr = $_GET['searchStr'];
  }

  if(isset($_SESSION['cartManager'])){
    $cartManager = $_SESSION['cartManager'];
  }else{
    // empty cart
  }
 ?>

<div id="body">

  <div id="content">
    <div id="search-box" class="container" style="padding: 30px;background: #A51D23">
      <form action="" method="GET">
        <div class="row">
          <div class="col-md-3">
            <select  class="form-control"  name="cat_id" id="">
        <option value=""> ----------- Select Category ----------- </option>
        <option value="0">All</option>
        <?php 
        $sqlCategory = "SELECT id, category_name
              FROM product_categories
              WHERE status = 1 AND is_active = 1
              ORDER BY category_name";
              $resultCategory=mysqli_query($con,$sqlCategory);
              //start category while
              while ($cat = mysqli_fetch_assoc($resultCategory)) {
                echo '<option value="'.$cat['id'].'">'.ucfirst($cat['category_name']).'</option>';
              }
         ?>
      </select>
          </div>
          <div class="col-md-6">
             <input type="text" name="searchStr" class="form-control" style="background: #fff; padding: 10px" placeholder=" Search for medicine....">
          </div>
          

          <div class="col-md-3">
             <button  class="form-control col-md-3  btn btn-primary">GO</button>
          </div>
      </div>
      </form>
    </div>

    <br><br>

    <div class="content">
      <div class="container">
      <div class="row">
      <div class="col-md-3">
        <div>
          <a href="?cat_id=0" class="list-group-item text-center" style="font-weight: 700; background: #A51D23; color: white"> All Categories
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
                    <a href="?cat_id=<?=$cat['id']  ?>" class="list-group-item" style="margin: 2px; font-weight: 700;border-radius: 0px; color:#866"><?=ucfirst($cat['category_name'])  ?> <span class="label <?=qty_label_color($numOfProds) ?> pull-right" style="padding: 4px 14px"><?=$numOfProds ?></span>
                    </a>
                </div>
                <!-- /.div -->
                <?php }// end category while 
                ?>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div>
                    <ol class="breadcrumb">
                        <li><a href="?cat_id=0" style="color: #26B"><b>Home</b></a></li>
                        <?php
                        if($subcat_id != 0){
                          $sqlSubCategory = "SELECT cat.id AS cat_id, subcat.id AS subcat_id, subcat.subcat_name, cat.category_name
                          FROM product_subcategories AS subcat JOIN 
                          product_categories AS cat 
                          ON subcat.cat_id = cat.id
                          WHERE subcat.id = $subcat_id";
                          $resultSubCategory=mysqli_query($con,$sqlSubCategory);
                          
                          $subCategory = mysqli_fetch_assoc($resultSubCategory);
                          echo '
                          <li><a href="?cat_id='.$subCategory['cat_id'].'">'.$subCategory['category_name'].'</a></li>
                          <li><a href="?subcat_id='.$subCategory['subcat_id'].'">'.$subCategory['subcat_name'].'</a></li>';
                        }else{
                          if($cat_id != 0){
                          $sqlCategory = "SELECT id, category_name
                          FROM product_categories
                          WHERE id = $cat_id";
                          $resultCategory=mysqli_query($con,$sqlCategory);
                          
                          $category = mysqli_fetch_assoc($resultCategory);
                          echo '<li><a href="?cat_id='.$category['id'].'">'.$category['category_name'].'</a></li>';
                        }
                        }
                         ?>
                        
                    </ol>
                    <div id="add-to-cart-messages"></div>
                </div>
                <!-- /.div -->
                <div class="row">
                <?php 
                   $sqlTotalItems = "SELECT id FROM products 
                   WHERE product_status = 1";
                  
                  $resultTotalItems = mysqli_query($con,$sqlTotalItems);
                    $totalItems = mysqli_num_rows( $resultTotalItems );
                 ?>
                    
                </div>
                <!-- /.row -->
                <div id="all_products" class="row">
                <?php
                if($subcat_id != 0){
                 $sqlProducts = "SELECT * FROM products 
                  WHERE subcategory_id = $subcat_id AND product_status = 1  AND status = 1";
                }else{   
                  if($cat_id != 0){
                    $sqlProducts = "SELECT * FROM products 
                    WHERE (product_name LIKE '%$searchStr%' OR product_desc LIKE '%$searchStr%') AND category_id = $cat_id  AND product_status = 1  AND status = 1";
                  }else{
                    // if $cat_id = 0 Show ALL Products
                    $sqlProducts = "SELECT * FROM products 
                    WHERE  (product_name LIKE '%$searchStr%' OR product_desc LIKE '%$searchStr%') AND product_status = 1  AND status = 1";
                  }
                }
                $resultProducts=mysqli_query($con,$sqlProducts);
                    while ($products = mysqli_fetch_assoc($resultProducts)) {
                      echo '
                      <div class="col-md-4 text-center col-sm-6 col-xs-6">
                      <form action="ajax_calls/add-to-cart.php" method="post">
                        <input type="hidden" name="product_id" value="'.$products['id'].'">
                        <div class="thumbnail product-box">
                        <a class="product-link" href="single_item.php?product_id='.$products['id'].'">
                            <img src="productImage/'.$products['image_1'].'" alt="" />
                            <input type="hidden" name="image" value="'.$products['image_1'].'">
                            <div class="caption">
                                <h4>'.create_summary($products['product_name'],25).'</h4>

                              <input type="hidden" name="name" value="'.$products['product_name'].'">
                                <p>Price : <strong> BD '.number_format($products['product_price'], 3).' </strong></p>
                                <input type="hidden" name="price" value="'.$products['product_price'].'">
                                <p>Product code : <strong>'.$products['product_code'].'</strong> </p>
                                <p>'.create_summary($products['product_desc'], 40).'</p>

                                <input type="hidden" name="qty_value" value="1">
                                <div><button id="addToCartBtn" type="submit" class="btn btn-danger">Add To Cart</button> 
                                <a href="single_item.php?product_id='.$products['id'].'" class="btn btn-default " role="button">See Details</a></div>
                            </div>
                            </a>
                        </div>
                        </form>                        
                    </div>
                    <!-- /.col -->
                      ';
                    }
                 ?>
                    
                </div>
                <!-- /.row -->
                <!-- /.div -->
                
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <br><br><br>  
</div>
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

    $("#all_products").on("submit", 'form', function() {
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
              '<strong><i class="fa fa-check"></i></strong> '+ response.messages +
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
  });
</script>
</body>
</html>
