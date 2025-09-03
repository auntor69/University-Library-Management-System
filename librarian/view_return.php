<?php
include('header.php');
include('session.php');
include('navbar_borrow.php');
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">        
                <div class="alert alert-info"><strong>Borrowed Books</strong></div>

                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                    <thead>
                        <tr>
                            <th>Book title</th>                                 
                            <th>Borrower</th>                                 
                            <th>Year Level</th>                                 
                            <th>Date Borrow</th>                                 
                            <th>Due Date</th>                                
                            <th>Date Returned</th>
                            <th>Borrow Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "
                            SELECT borrow.*, member.firstname, member.lastname, member.year_level,
                                   borrowdetails.borrow_details_id, borrowdetails.date_return, borrowdetails.borrow_status,
                                   book.book_title
                            FROM borrow
                            LEFT JOIN member ON borrow.member_id = member.member_id
                            LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
                            LEFT JOIN book ON borrowdetails.book_id = book.book_id
                            ORDER BY borrow.borrow_id DESC
                        ";

                        $user_query = mysqli_query($connection, $query) or die(mysqli_error($connection));

                        while ($row = mysqli_fetch_array($user_query)) {
                            $id = $row['borrow_id'];
                            $borrow_details_id = $row['borrow_details_id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
                            <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['year_level']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_borrow']); ?></td>
                            <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_return']); ?></td>
                            <td><?php echo htmlspecialchars($row['borrow_status']); ?></td>
                            <td>
                                <a rel="tooltip" title="Return" id="<?php echo $borrow_details_id; ?>" href="#delete_book<?php echo $borrow_details_id; ?>" data-toggle="modal" class="btn btn-success">
                                    <i class="icon-check icon-large"></i>Return
                                </a>
                                <?php include('modal_return.php'); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <script>
                $(".uniform_on").change(function(){
                    var max = 3;
                    if($(".uniform_on:checked").length == max){
                        $(".uniform_on").attr('disabled', 'disabled');
                        alert('3 Books are allowed per borrow');
                        $(".uniform_on:checked").removeAttr('disabled');
                    } else {
                        $(".uniform_on").removeAttr('disabled');
                    }
                });
                </script>
            </div>      
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
