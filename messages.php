<?php 
    include 'admin/db_connect.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <b>Messages</b>
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
                        <?php
                            $msgs = $conn->query("SELECT c.receiver_id as receiver_id, c.sender_id as sender_id, sender.name as sender, receiver.name as receiver, c.date_created, COUNT(c.message) as total_messages FROM `chatlog` as c LEFT JOIN users as sender ON c.sender_id = sender.id LEFT JOIN users as receiver ON c.receiver_id = receiver.id GROUP BY c.sender_id,c.receiver_id");
                            while($row = $msgs->fetch_assoc()):                                        
                        ?>                        
                        <?php if(isset($_SESSION['login_id'])): ?>
                            <?php if($_SESSION['login_id'] == $row['receiver_id']): ?>
                                <tr>
                                    <td>
                                        <p><?php echo $row['sender'] ?>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary show_messages" type="button"
                                            data-id="<?php echo $row['sender_id'] ?>">Show Message<span
                                                class="badge badge-pill badge-danger"><?php echo $row['total_messages']; ?></span></button>
                                    </td>
                                </tr>
                            <?php endif; ?>                        
                        <?php endif; ?>        
                        <?php endwhile; ?>
                        <!-- <?php if(count($msgs->fetch_assoc()) > 1): ?>
                            <tr>
                                <td colspan="2">No Messages yet.</td>
                            </tr>
                        <?php endif; ?> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Table Panel -->
</div>
<script>
$(document).ready(function() {
    $('.show_messages').click(function() {
        location.href = "index.php?page=manage_messages&id=" + $(this).attr('data-id')
        // uni_modal("Message", "manage_messages.php?id=" + $(this).attr('data-id'), 'mid-large')
    })

    $('.new_message').click(function() {
        uni_modal("New Message", "new_message.php", 'mid-large')
    })
})
</script>