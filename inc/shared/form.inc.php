<?php // Filename: form.inc.php ?>
<!-- #creates the form to create a new db record. create/content.inc does all of the magic! -->
<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->
<?php
#I added this to make the select sticky 
if (isset($_POST['degree'])) {
    $degree = $_POST['degree'];
}else {
    $degree = "";
}

#I think I can added my code for making the checkboxes sticky here instead of in "content.inc" I will try it out when I work on the final project. 
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
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
    <!-- add a row with three columns here if theres time-->
    <label class="col-form-label" for="gpa">GPA </label>
    <input class="form-control" type="text" id="gpa" name="gpa" value="<?php echo (isset($gpa) ? $gpa : ''); ?>">
    <br>
    <label class="col-form-label" for="yes">Financial Aid </label>
    <input class="" type="radio" id="yes" name="aid" value="yes"<?=$yes;?>> Yes
    <input class="" type="radio" id="no" name="aid" value="no"<?=$no;?>> No
    <br>
    <label class="col-form-label" for="degree1"> Program Degree </label>
    <select name="degree" id='degree1'>
        <option value="select"<?php if($degree == "--Select--") echo ' selected="selected"';?>>--Select--</option>
        <option value="AAT Web Developement"<?php if($degree == "AAT Web Developement") echo ' selected="selected"';?>>AAT Web Development</option>
        <option value="AAS Marketing"<?=($degree == "AAS Marketing") ? ' selected': '';?>>AAS Marketing</option>
        <option value="AAS Management"<?=($degree == "AAS Management") ? ' selected': '';?>>AAS Management</option>
        <option value="AAT Computer Support"<?=($degree == "AAT Computer Support") ? ' selected': '';?>>AAT Computer Support</option>
        <option value="AAT Networking Technology"<?=($degree == "AAT Networking Technology") ? ' selected': '';?>>AAT Networking Technology</option>
    </select>
    <br>
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit">Save Record</button>
</form>