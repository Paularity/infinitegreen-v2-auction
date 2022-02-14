<?php 
    include 'admin/db_connect.php';
    if (isset($_POST["updatePaymentMethod"])) {    
        if(isset($_POST['payment_method'])){
            $_SESSION['selected_payment_method'] = $_POST['payment_method'];
            return 1;
            exit();
        }
        return  2;
        exit();
    }    
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>Orders</b>
                </div>
                <div class="card-body">
                    <table class="table table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="" style="width: 30%;">Order</th>                                
                                <th class="" >Total Amount</th>                                
                                <th class="" >Order Status</th>                                
                                <th class="" >Actions</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
								$i = 1;
								$cat = array();
								$cat[] = '';
								$qry = $conn->query("SELECT * FROM categories ");
								while($row = $qry->fetch_assoc()){
									$cat[$row['id']] = $row['name'];
								}
								$books = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id WHERE b.user_id = ".$_SESSION['login_id']."");
								while($row=$books->fetch_assoc()):
									$get = $conn->query("SELECT * FROM bids where product_id = {$row['product_id']} order by bid_amount desc limit 1 ");
									$uid = $get->num_rows > 0 ? $get->fetch_array()['user_id'] : 0 ;
								?>
                            <?php if($row['status'] != 1): ?>
                            <tr>
                                <td class="text-center"><?php echo $i++ ?></td>
                                <td class="">
                                    <p> <b><?php echo ucwords($row['name']) ?></b></p>
                                </td>                                
                                <td class="text-right">
                                    <p> <b>₱ <?php echo number_format($row['bid_amount'],2) ?></b></p>
                                </td>
                                <td class="text-center">
                                    <?php if($row['status'] == 1): ?>
                                    <?php if(strtotime(date('Y-m-d H:i')) < strtotime($row['bdt'])): ?>
                                    <span class="badge badge-secondary">Bidding Stage</span>
                                    <?php else: ?>
                                    <?php if($uid == $row['user_id']): ?>
                                    <span class="badge badge-success">Wins in Bidding</span>
                                    <?php else: ?>
                                    <span class="badge badge-secondary">Loose in Bidding</span>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php elseif($row['status'] == 2): ?>
                                    <span class="badge badge-primary">Confirmed</span>
                                    <?php elseif($row['status'] == 3): ?>
                                    <span class="badge badge-warning">Paid</span>
                                    <?php elseif($row['status'] == 4): ?>
                                    <span class="badge badge-info">Shipped</span>
                                    <?php elseif($row['status'] == 5): ?>
                                    <span class="badge badge-info">Delivered</span>
                                    <?php else: ?>
                                    <span class="badge badge-danger">Canceled</span>
                                    <?php endif; ?>
                                </td>
                                <?php if($row['status'] == 2): ?>
                                    <td class="text-center">                                    
                                        <button class="btn btn-success btn-sm user-checkout" type="button"
                                            data-id='<?php echo $row['id'] ?>'>Pay Now</button>                                    
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php endif; ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Table Panel -->
    </div>
</div>


<script>
    $('.user-checkout').click(function() {
        uni_modal("<i class'fa fa-card-id'></i> Payment Method", "order_payment.php?id=" + $(this).attr('data-id'))
    })  
// $(document).ready(function() {
//     $('.show_messages').click(function() {
//         location.href = "index.php?page=manage_messages&id=" + $(this).attr('data-id')
//         // uni_modal("Message", "manage_messages.php?id=" + $(this).attr('data-id'), 'mid-large')
//     })

//     $('.new_message').click(function() {
//         uni_modal("New Message", "new_message.php", 'mid-large')
//     })
// })
</script>