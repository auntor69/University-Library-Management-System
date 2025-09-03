<?php
include('header.php');
include('session.php');
include('navbar_borrow.php');
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">        
                <div class="alert alert-danger"><strong>Returned Books</strong></div>

                <div class="pull-right">
                    <a href="" onclick="window.print()" class="btn-default">Print</a>
                </div>

                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                    <thead>
                        <tr>
                            <th>Book title</th>                                 
                            <th>Borrower</th>                                 
                            <th>Year Level</th>                                 
                            <th>Date Borrow</th>                                 
                            <th>Due Date</th>                                
                            <th>Date Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch returned books with JOINs
                        $query = "
                            SELECT borrow.*, member.firstname, member.lastname, member.year_level,
                                   borrowdetails.date_return, book.book_title
                            FROM borrow
                            LEFT JOIN member ON borrow.member_id = member.member_id
                            LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
                            LEFT JOIN book ON borrowdetails.book_id = book.book_id
                            WHERE borrowdetails.borrow_status = 'returned'
                            ORDER BY borrow.borrow_id DESC
                        ";

                        $user_query = mysqli_query($connection, $query) or die(mysqli_error($connection));

                        while ($row = mysqli_fetch_array($user_query)) {
                            $id = $row['borrow_id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
                            <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['year_level']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_borrow']); ?></td>
                            <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_return']); ?></td>
                            <td></td> 
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
