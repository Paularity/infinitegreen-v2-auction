<?php 
include 'admin/db_connect.php';
if(isset($_GET['updatePaymentMethod'])){
	// $msgs = $conn->query("SELECT sender.name as sender, c.message, c.sender_id, c.receiver_id, receiver.name as receiver, c.date_created FROM `chatlog` as c LEFT JOIN users as sender ON c.sender_id = sender.id LEFT JOIN users as receiver ON c.receiver_id = receiver.id ORDER BY c.date_created ASC");
	// foreach($msgs->fetch_array() as $k =>$v){
	// 	$meta[$k] = $v;
	// }
}
?>
<style>
.row-checkout {
    display: -ms-flexbox;
    /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap;
    /* IE10 */
    flex-wrap: wrap;
    margin: 0 -16px;
}

.col-25 {
    -ms-flex: 25%;
    /* IE10 */
    flex: 25%;
}

.col-50 {
    -ms-flex: 50%;
    /* IE10 */
    flex: 50%;
}

.col-75 {
    -ms-flex: 75%;
    /* IE10 */
    flex: 75%;
}

.col-25,
.col-50,
.col-75 {
    padding: 0 16px;
}

.container-checkout {
    background-color: #f2f2f2;
    padding: 5px 20px 15px 20px;
    border: 1px solid lightgrey;
    border-radius: 3px;
}

input[type=text] {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

label {
    margin-bottom: 10px;
    display: block;
}

.icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
}

.checkout-btn {
    background-color: #4CAF50;
    color: white;
    padding: 12px;
    margin: 10px 0;
    border: none;
    width: 100%;
    border-radius: 3px;
    cursor: pointer;
    font-size: 17px;
}

.checkout-btn:hover {
    background-color: #45a049;
}



hr {
    border: 1px solid lightgrey;
}

span.price {
    float: right;
    color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
    .row-checkout {
        flex-direction: column-reverse;
    }

    .col-25 {
        margin-bottom: 20px;
    }
}

.gcash-container {
    width: 360px;
    padding: 8% 0 0;
    margin: auto;
    font-family: 'Comfortaa', cursive;
}

.gcash-form {
    position: relative;
    z-index: 1;
    background: #FFFFFF;
    border-radius: 10px;
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
}

.gcash-form input {
    outline: 0;
    width: 100%;
    border: 0;
    border-radius: 5px;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
    border: 1px solid;
}

.gcash-form input:focus {
    background: #cfcfcf;
}

.gcash-form button {
    text-transform: uppercase;
    outline: 0;
    background: #4b6cb7;
    width: 100%;
    border: 0;
    border-radius: 5px;
    padding: 15px;
    color: #FFFFFF;
    font-size: 14px;
    -webkit-transition: all 0.3 ease;
    transition: all 0.3 ease;
    cursor: pointer;
}

.gcash-form button:active {
    background: #395591;
}

.gcash-form span {
    font-size: 75px;
    color: #4b6cb7;
}

.gcash-form span img {
    max-width: 100%;
}

.gcash-info {
    background: #f2f2f2;
    padding: 20px;
    border-radius: 4px;
    margin-bottom: 10px;
}
</style>


<section class="section">
    <div class="container-fluid">
        <div class="row-checkout">
            <?php
        // $i=1;
        // $total=0;
        // $total_count=$_POST['total_count'];

        // function GUID()
        // {
        //     if (function_exists('com_create_guid') === true) {
        //         return trim(com_create_guid(), '{}');
        //     }

        //     return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        // }
        
            // TODO
            if (isset($_SESSION['payment_method']) && $_SESSION['payment_method'] == "card") {
                unset($_SESSION['payment_method']);
                $sql = "SELECT * FROM user_info WHERE user_id='$_SESSION[uid]'";
                $query = mysqli_query($con, $sql);
                $row=mysqli_fetch_array($query);
        
                echo'
			<div class="col-75">
				<div class="container-checkout">
				<form id="checkout_form" action="checkout_process.php" method="POST" class="was-validated">

					<div class="row-checkout">
					
					<div class="col-50">
						<h3>Billing Address</h3>
						<label for="fname"><i class="fa fa-user" ></i> Full Name</label>
						<input type="text" id="fname" class="form-control" name="firstname" pattern="^[a-zA-Z ]+$"  value="'.$row["first_name"].' '.$row["last_name"].'">
						<label for="email"><i class="fa fa-envelope"></i> Email</label>
						<input type="text" id="email" name="email" class="form-control" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$" value="'.$row["email"].'" required>
						<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
						<input type="text" id="adr" name="address" class="form-control" value="'.$row["address1"].'" required>
						<label for="city"><i class="fa fa-institution"></i> City</label>
						<input type="text" id="city" name="city" class="form-control" value="'.$row["address2"].'" pattern="^[a-zA-Z ]+$" required>

						<div class="row">
						<div class="col-50">
							<label for="state">State</label>
							<input type="text" id="state" name="state" class="form-control" pattern="^[a-zA-Z ]+$" required>
						</div>
						<div class="col-50">
							<label for="zip">Zip</label>
							<input type="text" id="zip" name="zip" class="form-control" required>
						</div>
						</div>
					</div>
					
					
					<div class="col-50">
						<h3>Payment</h3>
						<label for="fname">Accepted Cards</label>
						<div class="icon-container">
						<i class="fa fa-cc-visa" style="color:navy;"></i>
						<i class="fa fa-cc-amex" style="color:blue;"></i>
						<i class="fa fa-cc-mastercard" style="color:red;"></i>
						<i class="fa fa-cc-discover" style="color:orange;"></i>
						</div>
						
						
						<label for="cname">Name on Card</label>
						<input type="text" id="cname" name="cardname" class="form-control" pattern="^[a-zA-Z ]+$" required>
						
						<div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                    </div>
						<label for="expdate">Exp Date</label>
						<input type="text" id="expdate" name="expdate" class="form-control" pattern="^((0[1-9])|(1[0-2]))\/(\d{2})$" placeholder="12/22"required>
						

						<div class="row">
						
						<div class="col-50">
							<div class="form-group CVV">
								<label for="cvv">CVV</label>
								<input type="text" class="form-control" name="cvv" id="cvv" required>
						</div>
						</div>
					</div>
					</div>
					</div>
					<label><input type="CHECKBOX" name="q" class="roomselect" value="conform" required> Shipping address same as billing
					</label>';
                $trx_id = GUID();
                $id_stock_card = array();
                $card_user_id = $_SESSION['uid'];
                while ($i<=$total_count) {
                    $item_name_ = $_POST['item_name_'.$i];
                    $amount_ = $_POST['amount_'.$i];
                    $quantity_ = $_POST['quantity_'.$i];
                    $total=$total+$amount_ ;
                    $sql = "SELECT product_id, seller_id,stock FROM products WHERE product_title='$item_name_'";
                    $query = mysqli_query($con, $sql);
                    $row=mysqli_fetch_array($query);
                    $product_id=$row["product_id"];
                    $seller_id=$row["seller_id"];

                    $newStock = $row["stock"] - $_POST['quantity_'.$i];
                    array_push($id_stock_card, array( "id"=>$row["product_id"], "stock"=>$newStock ));
                
                    echo "	
						<input type='hidden' name='prod_id_$i' value='$product_id'>
						<input type='hidden' name='prod_price_$i' value='$amount_'>
						<input type='hidden' name='prod_qty_$i' value='$quantity_'>
						";

                    $sqlOrders = "INSERT INTO `orders`
							(`product_id`, `seller_id`, `user_id`, `qty`, `trx_id`, `p_status`, `p_type`) 
							VALUES ('$product_id', '$seller_id', '$card_user_id', '$quantity_', '$trx_id', 'Pending', 'card')";
                    if (mysqli_query($con, $sqlOrders)) {
                        // reduce stock
                        foreach ($id_stock_card as $p) {
                            $sqlP = "UPDATE `products` SET `stock` = ".$p['stock']." WHERE `products`.`product_id` = ".$p['id'].";";
                            mysqli_query($con, $sqlP);
                        }
                    }
                    $i++;
                }
                    
                echo'	
				<input type="hidden" name="total_count" value="'.$total_count.'">
					<input type="hidden" name="total_price" value="'.$total.'">
					
					<input type="submit" id="submit" value="Continue to checkout" class="checkout-btn">
				</form>
				</div>
			</div>
			';
            } elseif (isset($_SESSION['payment_method']) && $_SESSION['payment_method'] == "gcash") {
                unset($_SESSION['payment_method']);
                $selectedBidId = $_SESSION['selectedBidId'];
                if(isset($selectedBidId)){
                    // unset($_SESSION['selectedBidId']);
                    $bidQuery = $conn->query("SELECT b.*, u.name as uname,p.seller_id,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id WHERE b.id = ".$selectedBidId."");
                    foreach($bidQuery->fetch_array() as $k =>$v){
                        $meta[$k] = $v;
                    }
                    $_SESSION['gcash_seller_id'] = $meta['seller_id'];
                    $_SESSION['gcash_product_id'] = $meta['id'];
                    // $_SESSION['gcash_product_qty'] = $quantity_;
                    // $_SESSION['gcash_products'] = $id_stock;
                }
                
                // $id_stock = array();
                // while ($i<=$total_count) {
                //     $item_name_ = $_POST['item_name_'.$i];
                //     $amount_ = $_POST['amount_'.$i];
                //     $quantity_ = $_POST['quantity_'.$i];
                //     $total=$total+$amount_ ;
                //     $sql = "SELECT product_id, seller_id, stock FROM products WHERE product_title='$item_name_'";
                //     $query = mysqli_query($con, $sql);
                //     $row=mysqli_fetch_array($query);
                //     $product_id=$row["product_id"];
                
                //     $newStock = $row["stock"] - $_POST['quantity_'.$i];
                //     array_push($id_stock, array( "id"=>$row["product_id"], "stock"=>$newStock ));

                //     echo "	
				// <input type='hidden' name='prod_id_$i' value='$product_id'>
				// <input type='hidden' name='prod_price_$i' value='$amount_'>
				// <input type='hidden' name='prod_qty_$i' value='$quantity_'>
				// ";

                //     $_SESSION['gcash_seller_id'] = $row['seller_id'];
                //     $_SESSION['gcash_product_id'] = $row['product_id'];
                //     $_SESSION['gcash_product_qty'] = $quantity_;
                //     $_SESSION['gcash_products'] = $id_stock;
                
                //     $i++;
                // } ?>
            <div class="col-md-12">
                <div class="container-checkout">
                    <div class="gcash-container">
                        <div class="form" id="gcash-checkout">
                            <form class="gcash-form" id="form-gcash">
                                <span><img src="admin/assets/uploads/gcash.png" alt="gcash/logo"></span>
                                <div class="gcash-info">
                                    <p>Amount Due <b style="margin-left: 5px;"
                                            class="text-info">₱<?= number_format($meta['bid_amount'],2) ?></b></p>
                                </div>
                                <p class="text-left" style="margin-bottom: 10px;"><b>Login to pay with GCash</b></p>
                                <input type="tel" name="telphone" placeholder="Account Mobile Number" maxlength="11"
                                    title="11 digits code" required />
                                <input type="hidden" name="total" value="<?= $meta['bid_amount']; ?>" />
                                <button type="submit">NEXT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            } elseif (isset($_SESSION['payment_method']) &&  $_SESSION['payment_method'] == "cod") {
                unset($_SESSION['payment_method']);
                $id_stock_cod = array();
                $trx_id = GUID();
                while ($i<=$total_count) {
                    $item_name_ = $_POST['item_name_'.$i];
                    $amount_ = $_POST['amount_'.$i];
                    $quantity_ = $_POST['quantity_'.$i];
                    $total=$total+$amount_ ;
                    $sql = "SELECT product_id, seller_id, stock FROM products WHERE product_title='$item_name_'";
                    $query = mysqli_query($con, $sql);
                    $row=mysqli_fetch_array($query);
                    $product_id=$row["product_id"];
                    $seller_id=$row["seller_id"];

                    $newStock = $row["stock"] - $_POST['quantity_'.$i];
                    array_push($id_stock_cod, array( "id"=>$row["product_id"], "stock"=>$newStock ));

                    echo "	
				<input type='hidden' name='prod_id_$i' value='$product_id'>
				<input type='hidden' name='prod_price_$i' value='$amount_'>
				<input type='hidden' name='prod_qty_$i' value='$quantity_'>
				";

                    $cod_user_id = $_SESSION['uid'];
                    $p_status = "Pending";

                    $sqlOrders = "INSERT INTO `orders`
					(`product_id`, `seller_id`, `user_id`, `qty`, `trx_id`, `p_status`, `p_type`) 
					VALUES ('$product_id', '$seller_id', '$cod_user_id', '$quantity_', '$trx_id', '$p_status', 'cod')";
                    if (mysqli_query($con, $sqlOrders)) {
                        // reduce stock
                        foreach ($id_stock_cod as $p) {
                            $sqlP = "UPDATE `products` SET `stock` = ".$p['stock']." WHERE `products`.`product_id` = ".$p['id'].";";
                            mysqli_query($con, $sqlP);
                        }
                    }

                    $i++;
                }
                $user_id = $_SESSION['uid'];
                $address = $_SESSION['address'];
                $account_name = $_SESSION['fullname'];
                $p_status = "Pending";

                $sql = "INSERT INTO `order_info_cod`
            (`order_id`, `user_id`, `address`, `total_amt`, `trx_id`) 
            VALUES ('$trx_id', '$user_id', '$address', '$total', '$trx_id')";

                if (mysqli_query($con, $sql)) {
                    $del_sql="DELETE from cart where user_id=$user_id";
                    if (mysqli_query($con, $del_sql)) {
                        $_SESSION['cod_success'] = 1;
                        echo "<script> location.href='success-payment.php'; </script>";
                    } else {
                        echo(mysqli_error($con));
                    }
                }
            }
            else{
                echo "<script> location.href='index.php'; </script>";
            }
        
        ?>
        </div>
    </div>
</section>
<script>
// gcash-form
$("#form-gcash").submit(function(e) {
    e.preventDefault();
    start_load();
    var accountNumber = event.target[0].value;
    var total = event.target[1].value;
    $.ajax({
        url: 'admin/ajax.php?action=checkout_gcash',
        method: "POST",
        data: {
            accountNumber: accountNumber,
            total: total
        },
        success: function(data) {
            setTimeout(() => {
                end_load();
            }, 1500);
            console.log(data);
            location.href = data;
        }
    })
    // $.ajax({
    //     url: 'admin/ajax.php?action=update_payment_method',
    //     method: "POST",
    //     data: {
    //         updatePaymentMethod: 2,
    //         bidId: $(this).attr('data-id')
    //     },
    //     success: function(resp) {
    //         if (resp == 1) {
    //             location.href = "index.php?page=checkout"
    //         } else {
    //             $('#msg').html(
    //                 '<div class="alert alert-warning">Please select one payment method below!<div>'
    //             )
    //         }
    //         // $("#cart_msg").html(data);
    //         // checkOutDetails();
    //     },
    //     // error: function(err) {
    //     //     $('#msg').html(
    //     //         '<div class="alert alert-warning">Please select one payment method below!<div>'
    //     //     )
    //     // }
    // })
})
</script>