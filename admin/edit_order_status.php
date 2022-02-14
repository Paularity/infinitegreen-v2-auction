<?php 
	include('db_connect.php');
	session_start();
	if(isset($_GET['id'])){
		$meta['id'] = $_GET['id'];
	}
?>
 
 <!-- FORM Panel -->
 <div class="col-md-12">
     <form action="" id="manage-status">
         <input type="hidden" name="id" value="<?php echo $meta['id'] ?>">
         <div class="form-group">
             <select name="status" class="custom-select custom-select-lg mb-3" required>
                 <option selected value="">Selected Status</option>
                 <option value="1">Bid</option>
                 <option value="2">Confirmed</option>
                 <option value="3">Paid</option>
                 <option value="4">Shipped</option>
                 <option value="5">Delivered</option>
                 <option value="6">Cancelled</option>
             </select>
         </div>
     </form>
 </div>
 <!-- FORM Panel -->
 <script>
$('#manage-status').submit(function(e) {
    e.preventDefault();
    start_load()
    $.ajax({
        url: 'ajax.php?action=update_order_status',
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully updated!", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)
            } else {
                $('#msg').html('<div class="alert alert-danger">Error!</div>')
                end_load()
            }
        }
    })
})
 </script>