<?php // Filename: function.inc.php
#function to display a message using $_GET
function display_message(){
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo '<div class="mt-4 alert alert-success" role="alert">';
        echo $message;
        echo '</div>';
    }
}

#filters the letters on the display-records page when the user clicks a letter A - Z.
function display_letter_filters($filter){  
    echo '<span class="mr-3">Filter by <strong>Last Name</strong></span>';
 
    $letters = range('A','Z');

    for($i=0 ; $i < count($letters) ; $i++){ 
        if ($filter == $letters[$i]) {
            $class = 'class="text-light font-weight-bold p-1 mr-3 bg-dark"';
        } else {
            $class = 'class="text-secondary p-1 mr-3 bg-light border rounded"';
        }
        echo "<u><a $class href='?filter=$letters[$i]' title='$letters[$i]'>$letters[$i]</a></u>";
    }
    echo '<a class="text-secondary p-2 mr-2 bg-success text-light border rounded" href="?clearfilter" title="Reset Filter">Reset</a>&nbsp;&nbsp;';
}

#shows the result of a search in the search-records page and content.inc.
function display_record_table($result){
    echo '<div class="table-responsive">';
    echo "<table class=\"table table-striped table-hover table-sm mt-4\">";
    echo '<thead class="thead-dark"><tr><th>Actions</th><th><a href="?sortby=student_id">Student ID</a></th><th><a href="?sortby=first_name">First Name</a></th><th><a href="?sortby=last_name">Last Name</a></th><th><a href="?sortby=email">Email</a></th><th><a href="?sortby=phone">Phone</a></th></tr></thead>';
    # $row will be an associative array containing one row of data at a time
    while ($row = $result->fetch_assoc()){
        # display rows and columns of data
        echo '<tr>';
        echo "<td>Update&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"delete-record.php?id={$row['id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
        echo "<td>{$row['student_id']}</td>";
        echo "<td><strong>{$row['first_name']}</strong></td>";
        echo "<td><strong>{$row['last_name']}</strong></td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo '</tr>';
    } // end while
    // closing table tag and div
    echo '</table>';
    echo '</div>';
}

#catches errors in content.inc for the create-record page.
function display_error_bucket($error_bucket){
    echo '<p>The following errors were deteced:</p>';
    echo '<div class="pt-4 alert alert-warning" role="alert">';
        echo '<ul>';
        foreach ($error_bucket as $text){
            echo '<li>' . $text . '</li>';
        }
        echo '</ul>';
    echo '</div>';
    echo '<p>All of these fields are required. Please fill them in.</p>';
}
?>