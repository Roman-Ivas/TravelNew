<? 
include_once("function.php");
$link=connerct_to_db("localhost","root","","agencydb",3306);
$ct1="CREATE TABLE Countries(
    Id int not null auto_increment primary key,
    Country varchar(36) not null) default charset='utf8'";
$ct2="CREATE TABLE Cities(
    Id int not null auto_increment primary key,
    City varchar(36) not null,
    CountryId int not null,
    foreign key(CountryId) references Countries(Id) ON DELETE CASCADE) default charset='utf8'";
$ct3="CREATE TABLE Hotels(
        Id int not null auto_increment primary key,
        HotelName varchar(64) not null,
        Description text,
        Price double,
        Stars int,
        CityId int not null,
        foreign key(CityId) references Cities(Id),
        CONSTRAINT CHK_HotelsStars CHECK (Stars>0 AND Stars<6)) default charset='utf8'";
$ct4="CREATE TABLE Images(
    Id int not null auto_increment primary key,
    ImagePath varchar(255) not null,
    HotelId int not null,
    foreign key(HotelId) references Hotels(Id)) default charset='utf8'";
$ct5="CREATE TABLE Roles(
    Id int not null auto_increment primary key,
    RoleName varchar(32) not null UNIQUE) default charset='utf8'";
$ct6="CREATE TABLE Users(
    Id int not null auto_increment primary key,
    UserLogin varchar(64) not null,
    UserEmail varchar(255) not null,
    Passwrd varchar(64) not null,
    Photo mediumblob,
    Discount double,
    RoleId int not null,
    foreign key(RoleId) references Roles(Id) ON DELETE CASCADE) default charset='utf8'";
// mysqli_query($link,$ct1);
// $err=mysqli_errno($link);
// if($err)
// echo "<div class='alertt alert-danger' role='alert'>Db error $err</div>";

// mysqli_query($link,$ct2);
// $err=mysqli_errno($link);
// if($err)
// echo "<div class='alertt alert-danger' role='alert'>Db error $err</div>";

// mysqli_query($link,$ct3);
// $err=mysqli_errno($link);
// if($err)
// echo "<div class='alertt alert-danger' role='alert'>Db error $err</div>";

// mysqli_query($link,$ct4);
// $err=mysqli_errno($link);
// if($err)
// echo "<div class='alertt alert-danger' role='alert'>Db error $err</div>";

// mysqli_query($link,$ct5);
// $err=mysqli_errno($link);
// if($err)
// echo "<div class='alertt alert-danger' role='alert'>Db error $err</div>";

//mysqli_query($link,$ct6);
//$err=mysqli_errno($link);
//if($err)
//echo "<div class='alertt alert-danger' role='alert'>Db error $err Role</div>";
