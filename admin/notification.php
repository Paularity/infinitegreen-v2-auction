<?php include('db_connect.php');?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Notifications</b>
                        </a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="">Name</th>
                                    <th class="" style="width: 30%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td> <p>Christian</p></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit_product" type="button"
                                        data-id="<?php echo $row['id'] ?>">Show Messages</button>
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>

</div>
<style>
td {
    vertical-align: middle !important;
}

td p {
    margin: unset
}

table td img {
    max-width: 100px;
    max-height: :150px;
}

img {
    max-width: 100px;
    max-height: :150px;
}
</style>
<script>
$(document).ready(function() {
    $('table').dataTable()
})

$('.view_product').click(function() {
    uni_modal("product Details", "view_product.php?id=" + $(this).attr('data-id'), 'mid-large')

})
$('.edit_product').click(function() {
    location.href = "index.php?page=manage_product&id=" + $(this).attr('data-id')

})
$('.delete_product').click(function() {
    _conf("Are you sure to delete this product?", "delete_product", [$(this).attr('data-id')])
})

function delete_product($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_product',
        method: 'POST',
        data: {
            id: $id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
}
</script>