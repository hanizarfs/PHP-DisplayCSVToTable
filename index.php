<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Table From CSV</title>

</head>

<body>
    <div class="container">
        <center>
            <div class="card p-5 mt-5">
                <div class="card-header p-3">
                    <form action="index.php" method="POST">
                        <h1 class="my-3">Add New Location</h1>
                        <table>
                            <tr>
                                <td><label for="location">Nama Lokasi</label></td>
                                <td><input type="text" name="location" id="location"></td>
                            </tr>
                            <tr>
                                <td><label for="latitude">Latitude</label></td>
                                <td><input type="text" name="latitude" id="latitude"></td>
                            </tr>
                            <tr>
                                <td><label for="longitude">Longitude</label></td>
                                </td>
                                <td><input type="text" name="longitude" id="longitude"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right"><input type="submit" value="Submit" name="submit" class="btn btn-primary"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="card-body">
                    <?php
                        $handle = fopen("locations.csv", "a+");
                        if(isset($_POST["submit"])) {
                            $data = "\n".$_POST['location'].',"'.$_POST['latitude'].','.$_POST['longitude'].'"';
                            fwrite($handle, $data); # $line is an array of strings (array|string[])
                        }
                        fclose($handle);

                        function hitungJarak($x1, $y1, $x2, $y2) {
                            $r = sqrt(pow($x2-$x1, 2)+pow($y2-$y1, 2));
                            return $r;
                        }
                        
                        $myFile = fopen("locations.csv", 'r') or die ("Unable to open file!") ;

                        echo "<table border='1' class='table table-responsive w-100'>";
                        echo "<tr>";
                        echo "<th>";
                        echo "Location";
                        echo "</th>";
                        echo "<th>";
                        echo "Latitude";
                        echo "</th>";
                        echo "<th>";
                        echo "Longitude";
                        echo "</th>";
                        echo "<th>";
                        echo "Jarak";
                        echo "</th>";
                        echo "</tr>";

                        $i=0;
                        while(! feof($myFile)) {
                            
                            $line = fgets($myFile);

                            // Pecah data
                            $pecah = explode(",", $line);

                            if($i==0) {
                                $i++;
                                continue;
                            }

                            $lat= str_replace('"', "", $pecah[1]);
                            $long= str_replace('"', "", $pecah[2]);
                            $float_value_of_var1 = floatval($pecah[1]);
                            $float_value_of_var2 = floatval($pecah[2]);
                            $jarak = hitungJarak($float_value_of_var1, -7.5652649, $float_value_of_var2, 110.8147185);

                            echo "<td>";
                            echo $pecah[0];
                            echo "</td>";
                            echo "<td>";
                            echo $lat;
                            echo "</td>";
                            echo "<td>";
                            echo $long;
                            echo "</td>";
                            echo "<td>";
                            echo $jarak;
                            echo "</td>";
                            echo "</tr>";
                            $i++;
                        }

                        echo "</table>";
                        fclose($myFile);
                    ?>
                </div>
            </div>
        </center>
    </div>

    <!-- BOOTSTRAP BUNDLE JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>