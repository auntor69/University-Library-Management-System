<?php
include('dbcon.php');

$exist = "";
$a = "";

if (isset($_POST['submit'])) {
    $student_no = $_POST['student_no'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if student exists
    $stmt = mysqli_prepare($connection, "SELECT * FROM students WHERE student_no = ?");
    mysqli_stmt_bind_param($stmt, "s", $student_no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $exist = "";
    } else {
        $exist = 'ID Number not Found!';
    }

    // Check password match
    if ($password != $cpassword) {
        $a = "Passwords do not match";
    } else {
        $a = "";
    }

    // If student exists and passwords match, proceed
    if ($count == 1 && $password == $cpassword) {

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "registrar/upload/";
            $image_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $image_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            // Update student record
            $stmt_update = mysqli_prepare($connection, "UPDATE students SET password=?, photo=?, status='active' WHERE student_no=?");
            mysqli_stmt_bind_param($stmt_update, "sss", $password, $target_file, $student_no);
            mysqli_stmt_execute($stmt_update);

            // Redirect to success page
            echo "<script>window.location='success.php';</script>";
            exit;
        }
    }
}
?>

<form method="post" enctype="multipart/form-data">    
    <div class="span5">
        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="student_no">Student No:</label>
                <div class="controls">
                    <input type="text" id="student_no" name="student_no" value="<?php echo isset($student_no) ? $student_no : ''; ?>" placeholder="Student No" required>
                    <?php if (isset($_POST['submit'])) { ?>  
                        <span class="label label-important"><?php echo $exist; ?></span>
                    <?php } ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="password">Password:</label>
                <div class="controls">
                    <input type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" placeholder="Password" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="cpassword">Confirm Password:</label>
                <div class="controls">
                    <input type="password" name="cpassword" value="<?php echo isset($cpassword) ? $cpassword : ''; ?>" placeholder="Confirm Password" required>
                    <?php if (isset($_POST['submit'])) { ?>  
                        <span class="label label-important"><?php echo $a; ?></span>
                    <?php } ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="image">Image:</label>
                <div class="controls">
                    <input type="file" name="image" class="font" required> 
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <button name="submit" type="submit" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Confirm</button>
                </div>
            </div>
        </div>
    </div>
</form>
