<?php 
	function getNumOfProdInCat($con, $cat_id){
		$sql = "SELECT id FROM products 
		WHERE category_id = $cat_id AND product_status = 1 AND status = 1";
		$rs = mysqli_query($con, $sql);
		return mysqli_num_rows($rs);
	}

	function qty_label_color($qty){
        $label_color = "";
        switch ($qty) {
          case  0:
              $label_color = 'label-danger'; 
              break;
          case ($qty > 0 && $qty< 2):
              $label_color = 'label-warning';
              break;
         case ($qty >= 2):
              $label_color = 'label-success';
              break;
          default:
              $label_color = 'label-primary';
          }

          return $label_color;
      }

      function uploadImage($file, $uniqueName, $directory){
   $response = array();

      $file_name = $file['name'];
      $file_size =$file['size'];
      $file_tmp_path =$file['tmp_name'];
      $file_type=$file['type'];
      $file_ext=strtolower(end(explode('.',$file['name'])));
    
      $extensions= array("png", "jpg", "jpeg");
    
      if(in_array($file_ext,$extensions)=== false){
        $errors[]="Invalid file type, please choose a PNG/JPG/JPEG.";
      }
    
       
      $MB = 1048576;  // 1048576 = 1MB
      // max size 2 MB
      if($file_size > 2*$MB || $file_size == 0){
        $errors[]='Image size must be less than 2 MB';
      }

      if(empty($errors)){
      $new_name = $uniqueName.rand(100,10000).'.'.$file_ext;
      $path = $directory.$new_name;

      if(move_uploaded_file($file_tmp_path, $path)){
        $response['success'] = true;
        $response['path'] = $path;
      }else{
        $response['success'] = false;
        $response['msg'] = "Error uploading file!";
      }

      
    }else{
          $response['success'] = false;
        $response['msg'] = implode(' | ',$errors);
    }

    return $response;

}

function getMaxOrderId($con){
  $sql = "SELECT MAX(order_id) FROM orders
              WHERE order_status = 1";
    $rs = $con->query($sql);
    return $rs->fetch_row()[0];
}

function getMaxProductId($con){
  $sql = "SELECT MAX(id) FROM products";
    $rs = $con->query($sql);
    return $rs->fetch_row()[0];
}

function getCategoryNameFromId($con, $cat_id){
  $sql = "SELECT category_name FROM product_categories 
  WHERE id = $cat_id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];

}

function getCustomerNameFromId($con, $cus_id){
  $sql = "SELECT uname FROM users 
  WHERE uid = $cus_id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];

}

function getProductNameFromId($con, $product_id){
  $sql = "SELECT product_name FROM products 
  WHERE id = $product_id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];

}

function getOrderItemQty($con, $order_id){
  //Get username from user ID
    $sql = "SELECT SUM(quantity) FROM order_item WHERE order_id = $order_id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_row($result)[0];
}

function create_summary($cont,$num){
      $text = strip_tags($cont);

      if(strlen($text) > $num){
            $endpos = strpos($text,' ',$num);
      $dots = '...';
      if(!$endpos){
              $endpos = strlen($text);
              $dots = '';
          }
      }else{
          $endpos = strlen($text);
                      $dots ='';
      }                   
      return substr($text,0,$endpos).$dots;
  }

  function getSiteVisits($con){
    $rs = mysqli_query($con, "SELECT count FROM site_visits 
    WHERE id = 1");
    return mysqli_fetch_row($rs)[0];
  }

  function incrementSiteVisit($con){
    $rs = mysqli_query($con, "SELECT count FROM site_visits 
    WHERE id = 1");
    $count = mysqli_fetch_row($rs)[0];
    $count++;
    mysqli_query($con, "UPDATE site_visits 
    SET count = $count 
    WHERE id = 1");
  }

?>