<?php // Filename: search-records.php
#title for the header
$pageTitle = "Advanced Search";
# requires connection to the db and "student_v2" db table display_record_table($result); and header.
require_once 'inc/layout/header.inc.php';
require_once 'inc/db/mysqli_connect.inc.php';
#"function.inc" moved to "header.inc"
require_once 'inc/app/config.inc.php';
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <h1>Advanced Search</h1>

            <?php
$sql = 'SELECT DISTINCT degree_program FROM student_v2';
$result = $db->query($sql);

// for sticky select
$yes = '';
$no = '';
$degree = '';
$selected = '';

if (isset($_POST['degree'])) {
    $degree = $_POST['degree'];
}
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mb-3">

    <label class="col-form-label" for="first">First Name </label>
    <input class="form-control" type="text" id="first" name="first" value="<?php echo (isset($first) ? $first : ''); ?>">
    <br>
    <label class="col-form-label" for="last">Last Name </label>
    <input class="form-control" type="text" id="last" name="last" value="<?php echo (isset($last) ? $last : ''); ?>">
    <br>
    <label class="col-form-label" for="sid">Student ID </label>
    <input class="form-control" type="text" id="sid" name="sid" value="<?php echo (isset($sid) ? $sid : ''); ?>">
    <br>
    <label class="col-form-label" for="email">Email </label>
    <input class="form-control" type="text" id="email" name="email" value="<?php echo (isset($email) ? $email : ''); ?>">
    <br>
    <label class="col-form-label" for="phone">Phone </label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?php echo (isset($phone) ? $phone : ''); ?>">
    <br>
    <label class="col-form-label" for="gpa">GPA </label>
    <input class="form-control" type="text" id="gpa" name="gpa" value="<?php echo (isset($gpa) ? $gpa : ''); ?>">
    <br>
    <label class="col-form-label" for="degree"> Program Degree </label>
    <br>
    <select class="form-control" name="degree" id='degree'>
<?php
#this populates the select dropdown.
#fetch_assoc() looks in the db for the db degree_program column.
while ($row = $result->fetch_assoc()) {
    // sticky select check
    if ($row['degree_program'] == $degree) {
        $selected = ' selected';
    }
    #this echos out the select dropdown populated with with the degree_program info.
    echo "<option value=\"" . $row['degree_program'] . "\" $selected>" . $row['degree_program'] . "</option>\n";

    $selected = '';
}
?>
    </select>
        <br>
        <label class="col-form-label" for="graduation">Graduation Date </label>
            <input class="form-control" type="date" id="graduation" name="graduation" value="<?php echo (isset($graduation) ? $graduation : ''); ?>">
            <br>
            #
            <label class="col-form-label" for="yes">Financial Aid
        <br>
            <input class="" type="radio" id="yes" name="aid" value="yes"<?=$yes;?>> Yes
            </label>
            <label for="no">
            <input class="" type="radio" id="no" name="aid" value="no"<?=$no;?>> No
        </label>
        <br>
        <br>
    <button class="btn btn-primary" type="submit">Search Records</button>
    </form>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['first'])) {
        $firstSQL = " AND " . '"' . $_POST["first"] . '"' . " IN (first_name)";
    } else {
        $firstSQL = '';
    }
    echo $firstSQL;
    if (!empty($_POST['last'])) {

        $lastSQL = " AND " . '"' . $_POST["last"] . '"' . " IN (last_name)";
    } else {
        $lastSQL = '';
    }

    if (!empty($_POST['sid'])) {
        $sidSQL = " AND " . '"' . $_POST["sid"] . '"' . " IN (student_id)";
    } else {
        $sidSQL = '';
    }

    if (!empty($_POST['email'])) {
        $emailSQL = " AND " . '"' . $_POST["email"] . '"' . " IN (email)";
    } else {
        $emailSQL = '';
    }

    if (!empty($_POST['phone'])) {
        $phoneSQL = " AND " . '"' . $_POST["phone"] . '"' . " IN (phone)";
    } else {
        $phoneSQL = '';
    }

    if (!empty($_POST['gpa'])) {
        $gpaSQL = " AND " . '"' . $_POST["gpa"] . '"' . " IN (gpa)";
    } else {
        $gpaSQL = '';
    }

    if (!empty($_POST['degree'])) {
        $degreeSQL = " AND " . '"' . $_POST["degree"] . '"' . " IN (degree_program)";
    } else {
        $degreeSQL = '';
    }

    if (!empty($_POST['graduation'])) {
        $graduationSQL = " AND " . '"' . $_POST["graduation"] . '"' . " IN (graduation_date)";
    } else {
        $graduationSQL = '';
    }

    if (!empty($_POST['aid'])) {
        $aidSQL = " AND " . '"' . $_POST["aid"] . '"' . " IN (financial_aid)";
    } else {
        $aidSQL = '';
    }

    $sql = 'SELECT * FROM student_v2 WHERE 1=1' . $firstSQL . $lastSQL . $sidSQL . $emailSQL . $phoneSQL . $gpaSQL . $degreeSQL . $graduationSQL . $aidSQL;

    $result = $db->query($sql);

    #this if statement won't work because I am using WHERE 1=1
    if ($result->num_rows > 0) {
        echo "<h3 class='alert alert-success mb-4'>$result->num_rows results were found</h3>";
    }
    echo $sql;
    display_record_table($result);
}

# close the database
$db->close();
?>
        </div>
    </div>
</div>
<!-- #footer -->
<?php require 'inc/layout/footer.inc.php';?>