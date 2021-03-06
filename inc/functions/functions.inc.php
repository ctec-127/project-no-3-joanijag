<?php // Filename: function.inc.php
#function to display a message using $_GET
#this file is now located in the "header" file in the "layout" folder
function display_message()
{
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo '<div class="mt-4 alert alert-success" role="alert">';
        echo $message;
        echo '</div>';
    }
}

#filters the letters on the display-records page when the user clicks a letter A - Z.
function display_letter_filters($filter)
{
    echo '<span class="mr-3">Filter by <strong>Last Name</strong></span>';

    $letters = range('A', 'Z');
#added class="d-inline-block to make letters responsive!!
    for ($i = 0; $i < count($letters); $i++) {
        if ($filter == $letters[$i]) {
            $class = 'class="d-inline-block text-light font-weight-bold p-1 mr-3 bg-dark"';
        } else {
            $class = 'class="d-inline-block text-secondary p-1 mr-3 bg-light border rounded"';
        }
        echo "<u><a $class href='?filter=$letters[$i]' title='$letters[$i]'>$letters[$i]</a></u>";
    }
    echo '<a class="text-secondary p-2 mr-2 bg-success text-light border rounded" href="?clearfilter" title="Reset Filter">Reset</a>&nbsp;&nbsp;';
}

#shows the result of a search in the search-records page and content.inc.
#I added table head names for GPA, Financial Aid and Degree
# I added graduation_date and reorderd the display.
function display_record_table($result)
{
    echo '<div class="table-responsive">';
    echo "<table class=\"table table-striped table-hover table-sm mt-3 table-bordered\">";
    echo '<thead class="thead-dark"><tr><th class="bg-primary">Actions</th><th><a href="?sortby=student_id">Student ID</a></th>
    <th><a href="?sortby=first_name">First Name</a></th>
    <th><a href="?sortby=last_name">Last Name</a></th>
    <th><a href="?sortby=email">Email</a></th>
    <th><a href="?sortby=phone">Phone</a></th>
    <th><a href="?sortby=gpa">GPA</a></th>
    <th><a href="?sortby=degree_program">Degree</a></th>
    <th><a href="?sortby=graduation_date">Graduation</a></th>
    <th><a href="?sortby=financial_aid">Financial Aid</a></th>
    </tr></thead>';

    # $row will be an associative array containing one row of data at a time
    #I added table head names that are column names in the db for gpa, financial_aid and degree_program
    # I added graduation_date and reorderd the display.
    while ($row = $result->fetch_assoc()) {
        # display rows and columns of data
        echo '<tr>';
        echo "<td><a href=\"update-record.php?id={$row['id']}\">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"delete-record.php?id={$row['id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
        echo "<td>{$row['student_id']}</td>";
        echo "<td><strong>{$row['first_name']}</strong></td>";
        echo "<td><strong>{$row['last_name']}</strong></td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['gpa']}</td>";
        echo "<td>{$row['degree_program']}</td>";
        echo "<td>{$row['graduation_date']}</td>";
        echo "<td>{$row['financial_aid']}</td>";
        echo '</tr>';
    } // end while
    // closing table tag and div
    echo '</table>';
    echo '</div>';
}

#catches errors in content.inc for the create-record page.
function display_error_bucket($error_bucket)
{
    echo '<p>The following errors were deteced:</p>';
    echo '<div class="pt-4 alert alert-warning" role="alert">';
    echo '<ul>';
    foreach ($error_bucket as $text) {
        echo '<li>' . $text . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<p>All of these fields are required. Please fill them in.</p>';
}
#the magic sauce for making the letters responsive.
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri) {
        echo 'active';
    }

}
