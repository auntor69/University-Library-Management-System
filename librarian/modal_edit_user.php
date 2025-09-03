<div id="edit<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Edit User</strong></div>
        <form class="form-horizontal" method="post">
            <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>" required>
            
            <div class="control-group">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" required>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="text" name="password" id="password" value="<?php echo $row['password']; ?>" required>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="firstname">Firstname</label>
                <div class="controls">
                    <input type="text" name="firstname" id="firstname" value="<?php echo $row['firstname']; ?>" required>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="lastname">Lastname</label>
                <div class="controls">
                    <input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname']; ?>" required>
                </div>
            </div>
            
            <div class="control-group">
                <div class="controls">
                    <button name="edit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Update</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
    </div>
</div>

<?php
if (isset($_POST['edit'])) {
    $user_id   = $_POST['id'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];

    // Using mysqli
    $query = "UPDATE users SET username=?, password=?, firstname=?, lastname=? WHERE user_id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $username, $password, $firstname, $lastname, $user_id);
    mysqli_stmt_execute($stmt) or die(mysqli_error($connection));

    echo '<script>window.location="users.php";</script>';
}
?>
