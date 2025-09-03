<?php
include('header.php');
include('session.php');
include('navbar_books.php');
include('dbcon.php'); // ensure $connection is defined

$get_id = $_GET['id'] ?? 0;

// Fetch book data along with its category
$stmt = $connection->prepare("
    SELECT book.*, category.classname 
    FROM book 
    LEFT JOIN category ON category.category_id = book.category_id 
    WHERE book_id = ?
");
$stmt->bind_param("i", $get_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$category_id = $row['category_id'];
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">    
                <div class="alert alert-danger"><i class="icon-pencil"></i>&nbsp;Edit Book</div>
                <p><a class="btn-default" href="books.php"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
                
                <div class="addstudent">
                    <div class="details">Please Enter Details Below</div>    
                    <form class="form-horizontal" method="POST" action="update_books.php">
                        
                        <!-- Book Title -->
                        <div class="control-group">
                            <label class="control-label">Book Title:</label>
                            <div class="controls">
                                <input type="text" class="span4" name="book_title" value="<?= htmlspecialchars($row['book_title']); ?>" required>
                                <input type="hidden" name="id" value="<?= $get_id; ?>">
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="control-group">
                            <label class="control-label">Category:</label>
                            <div class="controls">
                                <select name="category_id" required>
                                    <option value="<?= $category_id; ?>"><?= htmlspecialchars($row['classname']); ?></option>
                                    <?php
                                    $categories = $connection->query("SELECT * FROM category WHERE category_id != '$category_id'");
                                    while ($cat = $categories->fetch_assoc()) {
                                        echo "<option value='{$cat['category_id']}'>{$cat['classname']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Author -->
                        <div class="control-group">
                            <label class="control-label">Author:</label>
                            <div class="controls">
                                <input type="text" class="span4" name="author" value="<?= htmlspecialchars($row['author']); ?>" required>
                            </div>
                        </div>

                        <!-- Book Copies -->
                        <div class="control-group">
                            <label class="control-label">Book Copies:</label>
                            <div class="controls">
                                <input type="number" class="span1" name="book_copies" value="<?= $row['book_copies']; ?>" required>
                            </div>
                        </div>

                        <!-- Book Pub -->
                        <div class="control-group">
                            <label class="control-label">Book Pub:</label>
                            <div class="controls">
                                <input type="text" class="span4" name="book_pub" value="<?= htmlspecialchars($row['book_pub']); ?>" required>
                            </div>
                        </div>

                        <!-- Publisher Name -->
                        <div class="control-group">
                            <label class="control-label">Publisher Name:</label>
                            <div class="controls">
                                <input type="text" class="span4" name="publisher_name" value="<?= htmlspecialchars($row['publisher_name']); ?>" required>
                            </div>
                        </div>

                        <!-- ISBN -->
                        <div class="control-group">
                            <label class="control-label">ISBN:</label>
                            <div class="controls">
                                <input type="text" class="span4" name="isbn" value="<?= htmlspecialchars($row['isbn']); ?>" required>
                            </div>
                        </div>

                        <!-- Copyright Year -->
                        <div class="control-group">
                            <label class="control-label">Copyright Year:</label>
                            <div class="controls">
                                <input type="text" name="copyright_year" value="<?= $row['copyright_year']; ?>" required>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="control-group">
                            <label class="control-label">Status:</label>
                            <div class="controls">
                                <select name="status" required>
                                    <option><?= htmlspecialchars($row['status']); ?></option>
                                    <option>New</option>
                                    <option>Old</option>
                                    <option>Lost</option>
                                    <option>Damage</option>
                                    <option>Subject for Replacement</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="control-group">
                            <div class="controls">
                                <button name="submit" type="submit" class="btn btn-default"><i class="icon-save icon-large"></i>&nbsp;Update</button>
                            </div>
                        </div>

                    </form>                
                </div>      
            </div>      
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
