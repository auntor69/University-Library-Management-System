<?php
include('header.php');
include('session.php');
include('navbar_member.php');
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">    
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><i class="icon-user icon-large"></i>&nbsp;Member Table</strong>
                </div>

                <p><a href="add_member.php" class="btn-default">&nbsp;Add Member</a></p>

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>Name</th>                                 
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Type</th>
                            <th>Year level</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch all members
                        $user_query = mysqli_query($connection, "SELECT * FROM member") or die(mysqli_error($connection));

                        while ($row = mysqli_fetch_array($user_query)) {
                            $id = $row['member_id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
                            <td><?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['gender']); ?></td> 
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['contact']); ?></td>
                            <td><?php echo htmlspecialchars($row['type']); ?></td> 
                            <td><?php echo htmlspecialchars($row['year_level']); ?></td> 
                            <td><?php echo htmlspecialchars($row['status']); ?></td> 
                            <?php include('toolttip_edit_delete.php'); ?>
                            <td width="100">
                                <div class="span2">
                                    <a rel="tooltip" title="Delete" id="<?php echo $id; ?>" href="#delete_student<?php echo $id; ?>" data-toggle="modal" class="btn-default">
                                        <i class="icon-trash icon-large"></i>
                                    </a>
                                    <?php include('delete_student_modal.php'); ?>
                                    <div class="span1">
                                        <a rel="tooltip" title="Edit" id="e<?php echo $id; ?>" href="edit_member.php?id=<?php echo $id; ?>" class="btn-default">
                                            <i class="icon-pencil icon-large"></i>
                                        </a>
                                    </div>
                                </div>
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
