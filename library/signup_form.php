<?php
include('dbcon.php'); // your mysqli connection

if (isset($_POST['submit'])) {
    $student_no = $_POST['student_no'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if student exists
    $stmt = $connection->prepare("SELECT student_id FROM students WHERE student_no=?");
    $stmt->bind_param("s", $student_no);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;

    if ($count == 0) {
        $exist = 'ID Number not Found!';
    } else {
        $exist = '';
    }

    // Password match check
    if ($password !== $cpassword) {
        $a = "Passwords do not match!";
    } else {
        $a = '';
    }

    if ($count == 1 && $password === $cpassword) {
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "registrar/upload/";
            $image_name = basename($_FILES['image']['name']);
            $target_file = $target_dir . $image_name;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Update student
                $stmt_update = $connection->prepare(
                    "UPDATE students SET password=?, photo=?, status='active' WHERE student_no=?"
                );
                $stmt_update->bind_param("sss", $hashed_password, $target_file, $student_no);
                $stmt_update->execute();
                
                header("Location: success.php");
                exit();
            } else {
                $a = "Image upload failed!";
            }
        }
    }
}
?>

<form method="post" enctype="multipart/form-data">
<div class="span5">
    <div class="form-horizontal">
        <div class="control-group">
            <label class="control-label">Student No:</label>
            <div class="controls">
                <input type="text" name="student_no" placeholder="Student No" required>
                <?php if(isset($exist)) echo "<span class='label label-important'>$exist</span>"; ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Password:</label>
            <div class="controls">
                <input type="password" name="password" placeholder="Password" required>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Confirm Password:</label>
            <div class="controls">
                <input type="password" name="cpassword" placeholder="Confirm Password" required>
                <?php if(isset($a) && $a) echo "<span class='label label-important'>$a</span>"; ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Image:</label>
            <div class="controls">
                <input type="file" name="image" required>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button name="submit" type="submit" class="btn btn-info">Confirm</button>
            </div>
        </div>
    </div>
</div>
</form>
