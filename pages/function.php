<? 
function connerct_to_db($host,$username,$password,$dbname,$port)
{
    $link=mysqli_connect($host,$username,$password,$dbname,$port)
     or die("Could not esteblish connection with server");
     mysqli_query($link,"set names 'utf8'");
    return $link;
}