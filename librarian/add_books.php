<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_books.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">    
                <div class="alert alert-danger">Add Books</div>
                <p><a href="books.php" class="btn-default"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>

                <div class="addstudent">
                    <div class="details">Please Enter Details Below</div>        
                    <form class="form-horizontal" method="POST" action="books_save.php" enctype="multipart/form-data">

                        <div class="control-group">
                            <label class="control-label" for="book_title">Book Title:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="book_title" name="book_title" placeholder="Book Title" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="category_id">Category:</label>
                            <div class="controls">
                                <select name="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    $cat_query = mysqli_query($connection, "SELECT * FROM category") or die(mysqli_error($connection));
                                    while($cat_row = mysqli_fetch_assoc($cat_query)){
                                    ?>
                                        <option value="<?php echo $cat_row['category_id']; ?>"><?php echo $cat_row['classname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="author">Author:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="author" name="author" placeholder="Author" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="book_copies">Book Copies:</label>
                            <div class="controls">
                                <input type="number" class="span1" id="book_copies" name="book_copies" placeholder="Copies" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="book_pub">Book Publication:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="book_pub" name="book_pub" placeholder="Book Publication" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="publisher_name">Publisher Name:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="publisher_name" name="publisher_name" placeholder="Publisher Name" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="isbn">ISBN:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="isbn" name="isbn" placeholder="ISBN" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="copyright_year">Copyright Year:</label>
                            <div class="controls">
                                <input type="text" id="copyright_year" name="copyright_year" placeholder="Copyright Year" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="status">Status:</label>
                            <div class="controls">
                                <select name="status" required>
                                    <option value="">Select Status</option>
                                    <option>New</option>
                                    <option>Old</option>
                                    <option>Lost</option>
                                    <option>Damage</option>
                                    <option>Subject for Replacement</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button name="submit" type="submit" class="btn btn-default">
                                    <i class="icon-save icon-large"></i>&nbsp;Save
                                </button>
                            </div>
                        </div>
                    </form>                    
                </div>        
            </div>        
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
