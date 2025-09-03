<?php
include('header.php');
include('session.php');
include('navbar.php');

$query = mysqli_query($connection, "SELECT * FROM students WHERE student_id='$session_id'") or die(mysqli_error($connection));
$row = mysqli_fetch_array($query);
?>

<div class="container">
    <div class="margin-top">
        <div class="row">
            <?php include('head.php'); ?>
            <div class="span3"></div>

            <div class="span7">
                <form class="form-horizontal" method="post">
                    <div class="control-group">
                        <label class="control-label" for="np">New Password</label>
                        <div class="controls">
                            <input type="password" name="np" id="np" placeholder="New Password" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="rp">Re-type Password</label>
                        <div class="controls">
                            <input type="password" name="rp" id="rp" placeholder="Re-type Password" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['update'])) {
                        $np = $_POST['np'];
                        $rp = $_POST['rp'];

                        if ($np !== $rp) {
                            echo '<div class="alert alert-danger">Passwords do not match</div>';
                        } elseif (strlen($np) < 6) {
                            echo '<div class="alert alert-danger">Password must be at least 6 characters long</div>';
                        } else {
                            // Hash the password before storing
                            $hashed_password = password_hash($np, PASSWORD_DEFAULT);

                            $update = mysqli_query($connection, "UPDATE students SET password='$hashed_password' WHERE student_id='$session_id'") or die(mysqli_error($connection));

                            if ($update) {
                                echo '<div class="alert alert-success">Password successfully changed</div>';
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
