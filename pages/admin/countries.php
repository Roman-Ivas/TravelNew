<?
if (isset($_SESSION["countryadder"]))
    echo "<div>". $_SESSION["countryadder"]."</div>";
?>
<table class="table table-striped mb-3">
    <thead>
        <tr>
            <th>Id</th>
            <th>Country name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?
        $q1 = "SELECT * FROM Countries";
        $res = mysqli_query($link, $q1);
        if ($err)
            echo "<div class='alert alert-warning'>$err</div>";
        else
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                echo "<tr>";
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td><input type='checkbox' 
       class='form-check-input'
       name='delcountries[]'
        value='" . $row[0] . "' form='countryform'/></td>";
                echo "</tr>";
            }
        mysqli_free_result($res);
        ?>
    </tbody>
</table>

<!-- Form -->
<form method="post" id="countryform">
    <div class="mb-3">
        <label for="countryname" class="form-label">Country name</label>
        <input type="text" class="form-control" id="countryname" placeholder="Add new country..." name="countryname">
    </div>
    <button type="submit" class="btn btn-sm btn-success" name="addcountry">Add</button>
    <button type="submit" class="btn btn-sm btn-warning" name="delcountry">Delete</button>
</form>
<?
if (isset($_POST["addcountry"])) {
    $countryname = $_POST["countryname"];
    if ($countryname != "") {
        $q2 = "INSERT Countries(Country) VALUES ('" . $countryname . "')";
        $res = mysqli_query($link, $q2);
        $err = mysqli_error($link);
        if ($err)
            $_SESSION["countryadder"] = $err;
        else {
            unset($_SESSION["countryadder"]);
            echo "<script>
            location=document.URL;
            </script>";
        }
        mysqli_free_result($res);
    }
}
if (isset($_POST["delcountry"])) {
    $delcountries = $_POST["delcountries"];
    foreach ($delcountries as $countryId) {
        $q3 = "DELETE FROM Countries WHERE id=$countryId";
        mysqli_query($link, $q3);
    }
    echo "<script>
            location=document.URL;
            </script>";
}
?>