<h2 class="row justify-content-center">Live Ansicht</h2> 
<div class="d-grid mt-3 m-5">
    <table class="table table-dark table-hover table-bordered border-light">
      <thead>
        <tr>
          <th scope="col">Uhrzeit</th>
          <th scope="col">Temperatur</th>
          <th scope="col">Luftfeuchtigkeit</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
		  
<?php
        $db = new mysqli( 'localhost', 'root', '', 'WRP' );
        if ( mysqli_connect_errno() ) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        }
        $sql = "SELECT * FROM messdaten_neu";
        $result = $db->query( $sql );

        while ( $row = $result->fetch_assoc() ) {
          echo "<tr>
					  <td>$row[Uhrzeit]</td>
					  <td>$row[Temperatur]</td>
					  <td>$row[Luftfeuchtigkeit]</td>
					</tr>";
        }
        $db->close();
?>
      </tbody>
    </table>
  </div>