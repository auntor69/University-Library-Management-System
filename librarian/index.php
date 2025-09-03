<?php
session_start();
include('dbcon.php');

if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
    exit();
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['id'] = $row['user_id'];
        header('Location: dashboard.php'); // redirect after login
        exit();
    } else {
        $error = "Access Denied";
    }
}
?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">

                <!-- Centered EWU Image -->
                <div class="sti" style="text-align: center; margin-bottom: 20px;">
                    <img src="../LMS/ewu.png" class="img-rounded" style="height: auto; width: auto; max-height: auto;">
                </div>

                <div class="login">
                    <div class="log_txt">
                        <p><strong>Please Enter the Details Below..</strong></p>
                    </div>

                    <form class="form-horizontal" method="POST">
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Username</label>
                            <div class="controls">
                                <input type="text" name="username" id="username" placeholder="Username" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="inputPassword">Password</label>
                            <div class="controls">
                                <input type="password" name="password" id="password" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button id="login" name="submit" type="submit" class="btn">
                                    <i class="icon-signin icon-large"></i>&nbsp;Submit
                                </button>
                            </div>
                        </div>

                        <?php if (isset($error)) { ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                    </form>
                </div>

            </div>        
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
