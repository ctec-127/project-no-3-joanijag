<?php // Filename: connect.inc.php
#requires a connection to the db
#requires function.inc. 
require __DIR__ . "/../db/mysqli_connect.inc.php";
require __DIR__ . "/../functions/functions.inc.php";

$orderby = 'last_name';
$filter = '';
#uses the display_letter_filters($filter) function
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}
#Orders by last name
if (isset($_GET['sortby'])) {
    $orderby = $_GET['sortby'];
}
#Reset button clears filter
if (isset($_GET['clearfilter'])){
    $filter = '';
}

#quarries the db for names begining with the letter the user clicked on. 
#$orderby lists filtered names by lastname in ascending order
$sql = "SELECT * FROM $db_table WHERE last_name LIKE '$filter%' ORDER BY $orderby ASC";
#result returns the query results
$result = $db->query($sql);
#if no data is returned (like Z which is empty)
if ($result->num_rows == 0) {
    echo "<h2 class=\"mt-4 alert alert-warning\">No Records for <strong>last names</strong> starting with <strong>$filter</strong></h2>";
} else {
    if(empty($filter)){
        $text = '';
#if the db has data to return display_letter_filters($filter)
    } else {
        $text = " - last names starting with $filter";
    }
    echo "<h2 class=\"mt-4 alert alert-primary\">$result->num_rows Records" . $text . '</h2>';
}

// display alphabet filters
display_letter_filters($filter);

// display message if any
display_message();

// display the data
display_record_table($result);

# close the database
$db->close();