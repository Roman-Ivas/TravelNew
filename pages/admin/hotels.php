<?
if (isset($_SESSION["hoteladder"]))
    echo "<div>". $_SESSION["hoteladder"]."</div>";
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
        $q8 = "SELECT H.Id, H.HotelName, Ci.City, Co.Country, H.Price, H.Stars FROM Hotels H LEFT JOIN 
        Cities Ci ON H.CityId=Ci.Id
         LEFT JOIN Countries Co ON Ci.CountryId=Co.Id";
        $res = mysqli_query($link, $q8);
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
name='delhotels[]'
value='" . $row[0] . "' form='hotelform'/></td>";
                echo "</tr>";
            }
        mysqli_free_result($res);
        ?>
    </tbody>
</table>
<form method="post" id="hotelform">
    <div class="mb-3">
        <select name="countryid" class="form-select" onchange="getCities(event)">
            <option value="0" selected>Choose country</option>
            <?
            $q5 = "SELECT * FROM Countries";
            $res = mysqli_query($link, $q5);
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM))
                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
            ?>
        </select>
    </div>
    <div class="mb-3">
        <select name="cityid" id="hotelcities" class="form-select"></select>
    </div>
    <div class="mb-3">
        <label for="hotelname" class="form-label">Hotel name</label>
        <input type="text" class="form-control" id="hotelname" placeholder="Add new hotel..." name="hotelname">
    </div>
    <div class="mb-3">
        <label for="hoteldescription" class="form-label">Hotel description</label>
        <textarea name="hoteldescription" id="hoteldescription" class="form-control" rows="10"></textarea>
    </div>
    <div class="mb-3">
        <label for="hotelPrice" class="form-label">Price</label>
        <input type="number" class="form-control" id="hotelprice" placeholder="Hotel price..." name="hotelprice">
    </div>
    <div class="mb-3">
        <label for="hotelstars"class="form-label">Stars</label>
        <select name="hotelstars" id="hotelstars" class="form-select" aria-label="Default select example">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <!-- <div class="mb-3">
        <select name="cityid" id="cityid" class="form-select">
            <option value="0" selected>Choose City...</option>
        </select>
    </div> -->
    <button type="submit" class="btn btn-sm btn-success" name="addhotel">Add</button>
    <button type="submit" class="btn btn-sm btn-warning" name="delhotel">Delete</button>
</form>
<?
if (isset($_POST["addhotel"])) {
    $cityid = $_POST["cityid"];
    $hotelname=$_POST["hotelname"];
    $hoteldescription=$_POST["hoteldescription"];
    $hotelprice=$_POST["hotelprice"];
    $hotelstars=$_POST["hotelstars"];
    $q9 = "INSERT Hotels(HotelName, Description, CityId, Price, Stars)
     VALUES ('" . $hotelname . "','" . $hoteldescription . "', ".$cityid.", ".$hotelprice.", ".$hotelstars.")";
    $res = mysqli_query($link, $q9);
    $err = mysqli_error($link);
    if ($err)
        $_SESSION["hoteladder"] = $err;
    else {
        unset($_SESSION["hoteladder"]);
        echo "<script>
            location=document.URL;
            </script>";
    }
    mysqli_free_result($res);
}

if (isset($_POST["delcity"])) {
    if (isset($_POST["delcities"])) {
        $delcities = $_POST["delcities"];
        foreach ($delcities as $cityId) {
            $q7 = "DELETE FROM Cities WHERE id=$cityId";
            mysqli_query($link, $q7);
        }
        echo "<script>
            location=document.URL;
            </script>";
    }
}
?>