<?php require_once 'includes/header.php'; ?>
<?php 
    $edit = null;
    $edit_id = null;
    if($_GET['edit_id']){
        $edit_id = $_GET['edit_id'];
        $selSql = "SELECT * FROM orders 
        WHERE order_id = $edit_id";
        $rs = mysqli_query($con, $selSql);
        $edit = mysqli_fetch_assoc($rs);
    }else{
        header('location: orders.php?success=false&msg=Requested record not found !');
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $sql = "UPDATE orders 
        SET process_status = $status
        WHERE order_id = $edit_id ";
        if(mysqli_query($con, $sql)){
            $valid = true;
            $msg = "Order status changed successfully";
        }

        header('location: orders.php?success='.$valid.'&msg='.$msg);
    }
 ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
        <div class="row">
            <ol class="breadcrumb top-bar-margin">
                <li><a href="orders.php"><span class="glyphicon glyphicon-shopping-cart"></span> </a></li>
                <li class="active">Manage Orders</li>
            </ol>
        </div><!--/.row-->
        <br>
        <div class="panel panel-warning">
        <div class="panel-heading">
            <h3><span class="glyphicon glyphicon-shopping-cart"></span> Order Details</h3>
            <div id="errorDiv" class="col-sm-8 col-sm-offset-2">
    <?php
                if(isset($_GET['success'])){
                    if($_GET['success'] == 1){
                        echo '
                            <div class="alert alert-success text-center">'.$_GET['msg'].'
            </div>';
                    }else{
                        echo '
            <div class="alert alert-danger text-center">'.$_GET['msg'].'
            </div>';
                    } 
                }
                 ?>
      </div>
      <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <br>
            <div class="col-sm-8"  style="padding: 10px; border-right: 1px solid #ccc;border-bottom: 1px solid #ccc">

                <form action="" method="post">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 25%">
                             Customer Name    
                            </th>
                            <td>
                                <?php echo ($edit['customer_id'] == -1) ? 'GUEST' : ucfirst(getCustomerNameFromId($con, $edit['customer_id'])); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Customer Contact    
                            </th>
                            <td>
                                <?= $edit['customer_contact']?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Shipping Address    
                            </th>
                            <td>
                                <?= $edit['customer_ship_address']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Attachments
                            </th>
                            <td>
                                <a href="../<?=$edit['prescription'] ?>">prescription</a> 
                            </td>
                        </tr>


                        <tr>
                            <th>
                             Total Qty    
                            </th>
                            <td>
                                <?=getOrderItemQty($con, $edit['order_id']) ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Total Amount(BD)   
                            </th>
                            <td>
                                <?= $edit['grand_total']?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Order Date    
                            </th>
                            <td>
                                <?=date('d/M/Y', strtotime($edit['order_date'])) ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Items    
                            </th>
                            <td>
                                <table class="table">
                                    <tr>
                                        <td>Item Name</td>
                                        <td>Price</td>
                                        <td>Qty</td>
                                        <td>Total</td>
                                    </tr>
                                    <?php
                                        $sql = "SELECT * FROM order_item 
                                        WHERE order_id = {$edit['order_id']}";
                                        $rs = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_assoc($rs)) {
                                             echo '<tr>
                                        <td>'.ucfirst(getProductNameFromId($con,$row['product_id'])).'</td>
                                        <td>'.$row['rate'].'</td>
                                        <td>'.$row['quantity'].'</td>
                                        <td>'.$row['total'].'</td>
                                    </tr>';
                                         } 
                                     ?>
                                    
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <th>Payment Status</th>
                            <td>
                            <select class="form-control" name="payment_status" id="" required>
                                <option value="">--Select Status--</option>
                                <option value="1" <?=$edit['payment_status'] ? 'selected' : '' ?>>Payed</option>
                                <option value="0" <?=$edit['payment_status'] ? '' : 'selected' ?>>Not payed</option>
                            </select>
                            </td>
                        </tr>

                        <tr>
                            <th>Update Order Status</th>
                            <td>
                            <select class="form-control" name="status" id="" required>
                                <option value="">--select status--</option>
                                <option value="1" <?=($edit['process_status'] == 1) ? 'selected' : '' ?>>Pending</option>
                                <option value="2" <?=($edit['process_status'] == 2) ? 'selected' : '' ?>>Completed</option>
                                <option value="3" <?=($edit['process_status'] == 3) ? 'selected' : '' ?>>Canceled</option>
                            </select>
                            </td>
                   

                    
                        </tr>
                        
                    </tbody>
                </table>
                <div class="pull-right">
                    <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
                
                <br>
            </div>
        </div>
      </div>    
                                
    </div>  <!--/.main-->

    <?php require_once 'includes/import_scripts.php'; ?>
    <script>
        $(document).ready(function(){
            $('#navOrders').addClass('active');
        });
    </script>
</body>

</html>
