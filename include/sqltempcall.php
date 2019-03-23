<?php
#sometimes localhost does not resolve; just put IP in directly.

$conn = mysqli_connect("127.0.0.1", $_SESSION["user"],$_SESSION["pw"],$_SESSION["db"]) or die("DB Connect error");

$q="select date,temperature from tprobe0417 ";
$q=$q."order by date desc ";
$q=$q."limit 288";
$ds=mysqli_query($conn,$q);

while($r = mysqli_fetch_object($ds))
{
  $dateObj = date_parse($r->date);
  #build the string:
  $s="[ new Date(";
  $s=$s.$dateObj["year"].",".$dateObj["month"].",";
  $s=$s.$dateObj["day"].",".$dateObj["hour"].",";
  $s=$s.$dateObj["minute"].",".$dateObj["second"];
  $s=$s."), ".$r->temp." ],";
  echo $s;

}
mysqli_close($conn);
?>
