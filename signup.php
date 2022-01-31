<?php 	
	$id_type = "3";
	if(isset($_GET['id'])){		
		$id_type = $_GET['id'];
	}
	else{
		session_start();
	}
?>
<div class="container-fluid">
	<h4>
		<?php if($id_type == "2"): ?>			
			Seller Registration Form
		<?php endif; ?>
	</h4>    
	<hr>
    <form action="" id="signup-frm" data-id='<?php echo $id_type ?>'>
		<input type="hidden" name="type" value="<?php echo $id_type ?>" />
        <div class="form-group">
            <label for="" class="control-label">Name</label>
            <input type="text" name="name" required="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Contact</label>
            <input type="text" name="contact" required="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Address</label>
            <textarea cols="30" rows="3" name="address" required="" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            <input type="email" name="email" required="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Username</label>
            <input type="text" name="username" required="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Password</label>
            <input type="password" name="password" required="" class="form-control">
        </div>
        <button class="button btn btn-primary btn-sm">Create</button>
        <button class="button btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>

    </form>
</div>

<style>
#uni_modal .modal-footer {
    display: none;
}
</style>
<script>
$('#signup-frm').submit(function(e) {
    e.preventDefault()
    // start_load()
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: $(this).attr('data-id') == '2' ? 'admin/ajax.php?action=signupSeller' : 'admin/ajax.php?action=signup',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
            console.log(err)
            $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

        },
        success: function(resp) {
            if (resp == 1) {
                // alert($('#signup-frm').attr('data-id'))
                location.href = $('#signup-frm').attr('data-id') == '2' ? "admin/index.php" : "index.php"
            } else {
                $('#signup-frm').prepend(
                    '<div class="alert alert-danger">Please validate your inputs.</div>')
                end_load()
            }
        }
    })
})
</script>