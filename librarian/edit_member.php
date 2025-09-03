<?php
include('header.php');
include('session.php');
include('navbar_member.php');
include('dbcon.php'); // ensure $conn is defined

$get_id = $_GET['id'] ?? 0;

// Fetch member data
$stmt = $connection->prepare("SELECT * FROM member WHERE member_id = ?");
$stmt->bind_param("i", $get_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">    
                <div class="alert alert-danger"><i class="icon-pencil"></i>&nbsp;Edit Member</div>
                <p><a class="btn-default" href="member.php"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
                
                <div class="addstudent">
                    <div class="details">Please Enter Details Below</div>    
                    <form class="form-horizontal" method="POST" action="update_member.php">
                        
                        <!-- Firstname -->
                        <div class="control-group">
                            <label class="control-label">Firstname:</label>
                            <div class="controls">
                                <input type="text" name="firstname" value="<?= htmlspecialchars($row['firstname']); ?>" placeholder="Firstname" required>
                                <input type="hidden" name="id" value="<?= $get_id; ?>">
                            </div>
                        </div>

                        <!-- Lastname -->
                        <div class="control-group">
                            <label class="control-label">Lastname:</label>
                            <div class="controls">
                                <input type="text" name="lastname" value="<?= htmlspecialchars($row['lastname']); ?>" placeholder="Lastname" required>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="control-group">
                            <label class="control-label">Gender:</label>
                            <div class="controls">
                                <select name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" <?= $row['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?= $row['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="control-group">
                            <label class="control-label">Address:</label>
                            <div class="controls">
                                <input type="text" name="address" value="<?= htmlspecialchars($row['address']); ?>" placeholder="Address" required>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="control-group">
                            <label class="control-label">Contact:</label>
                            <div class="controls">
                                <input type="tel" pattern="[0-9]{11}" name="contact" value="<?= htmlspecialchars($row['contact']); ?>" placeholder="Phone Number" maxlength="11">
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="control-group">
                            <label class="control-label">Type:</label>
                            <div class="controls">
                                <select name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="Student" <?= $row['type'] == 'Student' ? 'selected' : ''; ?>>Student</option>
                                    <option value="Teacher" <?= $row['type'] == 'Teacher' ? 'selected' : ''; ?>>Teacher</option>
                                </select>
                            </div>
                        </div>

                        <!-- Year Level -->
                        <div class="control-group">
                            <label class="control-label">Year Level:</label>
                            <div class="controls">
                                <select name="year_level" required>
                                    <option value="">Select Year Level</option>
                                    <option value="First Year" <?= $row['year_level'] == 'First Year' ? 'selected' : ''; ?>>First Year</option>
                                    <option value="Second Year" <?= $row['year_level'] == 'Second Year' ? 'selected' : ''; ?>>Second Year</option>
                                    <option value="Third Year" <?= $row['year_level'] == 'Third Year' ? 'selected' : ''; ?>>Third Year</option>
                                    <option value="Fourth Year" <?= $row['year_level'] == 'Fourth Year' ? 'selected' : ''; ?>>Fourth Year</option>
                                    <option value="Faculty" <?= $row['year_level'] == 'Faculty' ? 'selected' : ''; ?>>Faculty</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="control-group">
                            <label class="control-label">Status:</label>
                            <div class="controls">
                                <select name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Active" <?= $row['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                                    <option value="Banned" <?= $row['status'] == 'Banned' ? 'selected' : ''; ?>>Banned</option>
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
