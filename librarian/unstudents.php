<?php 
include('header.php');
include('session.php');
include('navbar_dasboard.php');
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">    
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><i class="icon-user icon-large"></i>&nbsp;Unconfirmed Students Table</strong>
                </div>

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>Student_No</th>
                            <th>Password</th>                                 
                            <th>Name</th>                                 
                            <th>Course</th>                                 
                            <th>Gender</th>                                 
                            <th>Address</th>                                 
                            <th>Contact No</th>                                 
                            <th>Photo</th>                                 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM students WHERE status = 'unactive'";
                        $user_query = mysqli_query($connection, $query) or die(mysqli_error($connection));

                        while ($row = mysqli_fetch_assoc($user_query)) {
                            $id = $row['student_id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
                            <td><?php echo htmlspecialchars($row['student_no']); ?></td> 
                            <td><?php echo htmlspecialchars($row['password']); ?></td>                                 
                            <td><?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?></td>                                                                              
                            <td><?php echo htmlspecialchars($row['course']); ?> </td> 
                            <td><?php echo htmlspecialchars($row['gender']); ?></td> 
                            <td><?php echo htmlspecialchars($row['address']); ?></td> 
                            <td><?php echo htmlspecialchars($row['contact']); ?></td> 
                            <td width="60"><img src="<?php echo htmlspecialchars($row['photo']); ?>" width="60" height="60"></td> 
                            <?php include('toolttip_edit_delete.php'); ?>
                            <td width="150">
                                <a href="#confirm<?php echo $id; ?>" data-toggle="modal" class="btn btn-success">
                                    <i class="icon-check"></i>&nbsp;Confirm Request
                                </a>
                                <?php include('confirm_request.php'); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>      
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
