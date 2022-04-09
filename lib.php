<?php

function array_to_table($table) 
{   
    echo "<table border='1'>";

    // Table header
    foreach ($table[0] as $header) {
    echo "<th>".$header."</th>";
    }

    // Table body
    $body = array_slice( $table, 1, null, true);
    foreach ($body as $row) {
    echo "<tr>";
        foreach ($row as $cell) {
        echo "<td>".$cell."</td>";
        } 
    echo "</tr>";
    }     
echo "</table>";
}
?>