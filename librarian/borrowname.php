<?php
include('dbcon.php'); // your database connection
?>

<form method="post" action="borrow_save.php">
<div class="border-borrow">

    <!-- Borrower Name -->
    <div class="control-group">
        <label class="control-label" for="inputEmail">Borrower Name</label>
        <div class="controls">
            <select name="member_id" class="chzn-select" required>
                <option value="">-- Select Borrower --</option>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM member") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $row['member_id']; ?>">
                        <?php echo $row['firstname'] . " " . $row['lastname']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <!-- Due Date -->
    <div class="control-group"> 
        <label class="control-label" for="inputEmail">Due Date</label>
        <div class="controls">
            <input type="text"  
                   class="w8em format-d-m-y highlight-days-67 range-low-today" 
                   name="due_date" 
                   id="sd" 
                   maxlength="10" 
                   style="border: 3px double #CCCCCC;" 
                   required/>
        </div>
    </div>

    <!-- Buttons -->
    <div class="control-group"> 
        <div class="controls">
            <button class="btn btn-success" name="borrow">
                <i class="icon-plus"></i> Borrow
            </button>
            <button name="delete_student" class="btn btn-danger">
                <i class="icon-check icon-large"></i> Yes
            </button>
        </div>
    </div>

</div>
</form>
