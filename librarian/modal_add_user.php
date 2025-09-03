<div id="add_user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Add User</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <input type="text" name="username" id="username" placeholder="Username" required>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="firstname">Firstname</label>
                <div class="controls">
                    <input type="text" name="firstname" id="firstname" placeholder="Firstname" required>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="lastname">Lastname</label>
                <div class="controls">
                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" required>
                </div>
            </div>
            
            <div class="control-group">
                <div class="controls">
                    <button name="submit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Save</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $username  = $_POST['username'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];

    // Using mysqli prepared statement
    $query = "INSERT INTO users (username, password, firstname, lastname) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $password, $firstname, $lastname);
    mysqli_stmt_execute($stmt) or die(mysqli_error($connection));

    echo '<script>window.location="users.php";</script>';
}
?>
