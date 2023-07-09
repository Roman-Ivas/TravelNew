<!-- <h2>Admin panel</h2>
<?
            if (isset($_SESSION["countryadder"]))
                echo "<div>" . $_SESSION["countryadder"] . "</div>";
            ?>
            <table class="table table-striped mb-3">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Hotel name</th>
                        <th>City name</th>
                        <th>Country</th>
                        <th>Price</th>
                        <th>Stars</th>
                        <th></th>
                    </tr>


                </thead>
                <tbody>
                    <?
                    $q1 = "SELECT H.Id, H.HotelName, Ci.City, Co.Country, H.Price, H.Starts FROM Hotels H LEFT JOIN
                    Cities Ci ON H.CityId=Ci.Id
                    LEFT JOIN Countries Co ON Ci.CountryId=Co.Id";
                    $res = mysqli_query($link, $q1);
                    $err = mysqli_errno($link);
                    if ($err) {
                        echo "<div class='alert alert-warning'>$err</div>";
                    } else
                        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                            echo "<tr>";
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td>" . $row[1] . "</td>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td>" . $row[4] . "</td>";
                            echo "<td>" . $row[5] . "</td>";
                            echo "<td><input type='checkbox' 
       class='form-check-input'
       name='delcountries[]'
        value='" . $row[0] . "' form='hotelform'/></td>";
                            echo "</tr>";
                        }
                    mysqli_free_result($res);
                    ?>
                </tbody>
            </table>
            <form method="post" id="hotelform">
                <div class="mb-3">

                    <label for="countryname" class="form-label">Country name</label>

                    <input type="text" class="form-control" id="countryname" placeholder="Add new country..." name="countryname">

                </div>
                <button type="submit" class="btn btn-sm btn-success" name="addcountry">Add</button>
                <button type="submit" class="btn btn-sm btn-warning" name="delcountry">Delete</button>
            </form>
            <?
            // if (isset($_POST["addcountry"])) {
            //     $countryname = $_POST["countryname"];
            //     echo "<p>$countryname</p>";
            //     $q2 = "INSERT INTO `Countries`(`Country`) VALUES ('" . $countryname . "')";
            //     $res = mysqli_query($link, $q2);
            //     $err = mysqli_error($link);
            //     if ($err)
            //         $_SESSION["countryadder"] = $err;
            //     else
            //         unset($_SESSION["countryadder"]);
            //     //script
            //     mysqli_free_result($res);
            //}
            if (isset($_POST["delcountry"])) {
                $delcountries = $_POST["delcountries"];
                echo "<p>$delcountries</p>";
                foreach ($delcountries as $countryId) {
                    $q3 = "DELETE FROM Countries WHERE id=$countryId";
                    mysqli_query($link, $q3);
                }
                //script
            }
            ?> -->