<?php

$page_title = 'View the Guest Book';
include('includes/header.html');

// Page header:
echo '<h1>Guest Book</h1>';
	
	require('mysqli_connect.php');
	
	$sql1 = "SELECT first_name, last_name, date FROM guest_book;";
	$events = mysqli_query($dbc, $sql1);
	//if the query was successful
	if(mysqli_num_rows($events) != 0){
		//set up the table
		echo '<table id="table" class="display">';
			echo '<thead>';
				echo '<tr>';
					echo '<th>Name</th>';
					echo '<th>Date Signed</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';		
		//for each row
		while($row = mysqli_fetch_assoc($events)) 
		{
				echo '<tr>';
					//Name
					echo '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
				echo '</tr>';
		}
		//end the table
			echo '</tbody>';
		echo '</table>'; 
	}
    else{
        echo "No Records found";
    }
	
	#close
    mysqli_close($dbc);
?>

</body>
<link rel="stylesheet" href="css/jQueryUI.css"> 
<link rel="stylesheet" href="css/datatable.css">
<!-- Script -->
<script src="js/jQuery.js"></script>
<script src="js/jQueryUI.js"></script> 
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>$("#table").DataTable();</script>

<?php
include('includes/footer.html');
?>