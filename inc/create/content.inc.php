<?php // Filename: connect.inc.phpd
#requires a connection to the db
#requires function.inc. ***"function.inc" was moved to "header.inc" in "layout"***
#requires config.inc
require __DIR__ . "/../db/mysqli_connect.inc.php";
require __DIR__ . "/../app/config.inc.php";
#display_error_bucket($error_bucket) in functions.inc
$error_bucket = [];
#creates a new db record.
// http://php.net/manual/en/mysqli.real-escape-string.php

$yes = '';
$no = '';
#(strip_tags) removes any html tags that the user might put into a text input field.
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    // First insure that all required fields are filled in
    if (empty($_POST['first'])) {
        array_push($error_bucket, "<p>A first name is required.</p>");
    } else {
        # Old way
        #$first = $_POST['first'];
        # New way
        $first = $db->real_escape_string(strip_tags($_POST['first']));
    }
    if (empty($_POST['last'])) {
        array_push($error_bucket, "<p>A last name is required.</p>");
    } else {
        #$last = $_POST['last'];
        $last = $db->real_escape_string(strip_tags($_POST['last']));
    }
    if (empty($_POST['sid'])) {
        array_push($error_bucket, "<p>A student ID is required.</p>");
    } else {
        #$sid = $_POST['sid'];
        $sid = $db->real_escape_string(strip_tags($_POST['sid']));
    }
    if (empty($_POST['email'])) {
        array_push($error_bucket, "<p>An email address is required.</p>");
    } else {
        #$email = $_POST['email'];
        $email = $db->real_escape_string(strip_tags($_POST['email']));
    }
    if (empty($_POST['phone'])) {
        array_push($error_bucket, "<p>A phone number is required.</p>");
    } else {
        #$phone = $_POST['phone'];
        $phone = $db->real_escape_string(strip_tags($_POST['phone']));
    }
    #I added gpa to be checked if it's been entered
    if (empty($_POST['gpa'])) {
        array_push($error_bucket, "<p>Student GPA is required.</p>");
    } else {
    # thakes the user input and stores it in a format that is safe for an SQL statement in $gpa.   
        $gpa = $db->real_escape_string(strip_tags($_POST['gpa']));
    }
    if (!isset($_POST['aid'])) {
        array_push($error_bucket, "<p>Selecting Yes or No for financial aid is required.</p>");
    } elseif ($_POST['aid'] == 'yes') {
        $yes = 'checked'; # set $yes to checked.
        $aid = 1;
    } elseif ($_POST['aid'] == 'no') { # did the user click on no
    $no = 'checked'; # set $no to checked
    $aid = 0;
    }
    #I checked to see if it was set. Then I realized it's always set so I commented it out. 
    // if (!isset($_POST['degree'])) {
    //     array_push($error_bucket, "<p>A degree program is required.</p>");
    // }
    #I checked to see if it was set to 'select', if yes it gets pushed to the errorbucket.
    #If it is set to a degree it is set up for the db. 
    # (strip_tags) is not necessary here because it is not an text input field.
    if ($_POST['degree'] == 'select'){
        array_push($error_bucket, "<p>A degree program is required.</p>");
    }else{
        $degree = $db->real_escape_string($_POST['degree']);
    }
    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL

        $sql = "INSERT INTO $db_table (first_name,last_name,student_id,email,phone,gpa,financial_aid, degree_program) ";
        $sql .= "VALUES ('$first','$last',$sid,'$email','$phone','$gpa','$aid','$degree')";

        // comment in for debug of SQL
        // echo $sql;

        $result = $db->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            I saved that new record for you!
          </div>';
            unset($first);
            unset($last);
            unset($sid);
            unset($email);
            unset($phone);
            unset($gpa);
            unset($aid);
            unset($degree); #unsets the variables after successful form entry for the next entry.
        }
    } else {
        display_error_bucket($error_bucket);
    }
}
