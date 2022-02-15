<?php 
include 'admin/db_connect.php';
session_start();
if(isset($_GET['id'])){
	// $msgs = $conn->query("SELECT * FROM ");
    $bid = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id WHERE b.id = ".$_GET['id']."");
	foreach($bid->fetch_array() as $k =>$v){
		$meta[$k] = $v;
	}
}

?>
<style>
#uni_modal .modal-footer {
    display: none;
}

a.btn.btn-payment-method {
    /* width: 160px !important; */
    width: 100%;
    border: 1px solid !important;
    margin-bottom: 10px !important;
}

a.btn.btn-payment-method.selected {
    border: 1px solid #ee4d2d !important;
    color: #ee4d2d !important;
    font-weight: bold;
}

a.btn.btn-payment-method:hover {
    transition: 200ms;
    font-weight: bold;
    border: 2px solid !important;
    background-color: #eaeae1 !important;
}
</style>
<div class="container-fluid">
    <div class="row p-4 bg-light">        
        <div class="col-md-12">
            <div id="msg"></div>
            <a href="javascript:void(0)" id="btn-gcash"
                class="btn btn-payment-method <?= (isset($_SESSION['payment_method']) && $_SESSION['payment_method'] == 'gcash') ? 'selected' : '' ?>"> Gcash
            </a>
        </div>
    </div>
    <hr>
    <div class="col-md-12 text-right">
        <button class="btn btn-success text-right" id="btn-checkout" data-id="<?php echo $meta['id'] ?>">Proceed to checkout</button>
    </div>
</div>
<script>
// $('#send-message').submit(function(e){
// 	e.preventDefault();
// 	start_load()
// 	$.ajax({
// 		url:'admin/ajax.php?action=send_message',
// 		method:'POST',
// 		data:$(this).serialize(),
// 		success:function(resp){
// 			if(resp ==1){
// 				alert_toast("Message successfully sent!",'success')
// 				setTimeout(function(){
// 					location.reload()
// 				},1500)
// 			}else{
// 				$('#msg').html('<div class="alert alert-danger">Error. Please contact support.</div>')
// 				end_load()
// 			}
// 		}
// 	})
// })
$("#btn-checkout").click(function(e) {
    $.ajax({
        url: 'admin/ajax.php?action=update_payment_method',
        method: "POST",
        data: {
            updatePaymentMethod: 2,
            bidId: $(this).attr('data-id')
        },
        success: function(resp) {
            if (resp == 1) {
                location.href = "index.php?page=checkout"
            } else {
                $('#msg').html(
                    '<div class="alert alert-warning">Please select one payment method below!<div>'
                )
            }
            // $("#cart_msg").html(data);
            // checkOutDetails();
        },
        // error: function(err) {
        //     $('#msg').html(
        //         '<div class="alert alert-warning">Please select one payment method below!<div>'
        //     )
        // }
    })
})
$("body").delegate("#btn-gcash", "click", function(event) {
    $('#btn-gcash').addClass('selected');
    $('#btn-cod').removeClass('selected');
    $('#btn-card').removeClass('selected');
    $.ajax({
        url: 'admin/ajax.php?action=update_payment_method',
        method: "POST",
        data: {
            updatePaymentMethod: 1,
            payment_method: 'gcash'
        },
        success: function(resp) {
            // if (resp != 1) {
            //     $('#msg').html(
            //         '<div class="alert alert-danger">Error. Please contact support.</div>')
            // }
            // alert(resp);
            // $("#cart_msg").html(data);
            // checkOutDetails();
        }
    })
})
$("body").delegate("#btn-cod", "click", function(event) {
    $('#btn-gcash').removeClass('selected');
    $('#btn-cod').addClass('selected');
    $('#btn-card').removeClass('selected');
    $.ajax({
        url: 'admin/ajax.php?action=update_payment_method',
        method: "POST",
        data: {
            updatePaymentMethod: 1,
            payment_method: 'cod'
        },
        success: function(resp) {
            // alert(resp);
            // $("#cart_msg").html(data);
            // checkOutDetails();
        }
    })
})
$("body").delegate("#btn-card", "click", function(event) {
    $('#btn-gcash').removeClass('selected');
    $('#btn-cod').removeClass('selected');
    $('#btn-card').addClass('selected');
    $.ajax({
        url: 'admin/ajax.php?action=update_payment_method',
        method: "POST",
        data: {
            updatePaymentMethod: 1,
            payment_method: 'card'
        },
        success: function(resp) {
            // alert(resp);
            // $("#cart_msg").html(data);
            // checkOutDetails();
        }
    })
})
</script>