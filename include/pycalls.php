<?php

$status = array(-1);
unset($status); #our variable is immutable if this is not done (it seems).
exec("python3 ./pyscript/temp/readtemp.py", $status);
$_SESSION["temp"] = $status[0];

unset($status);
exec("python3 ./pyscript/moist/moistvalue.py", $status);
$_SESSION["moist"] = $status[0];
unset($status);

$status = array(-1);
unset($status);
exec("python ./pyscript/ec/readecvalues.py", $status);
$repArray = array("[", "]", " ", "'");
$strReplace = str_replace($repArray,"",$status[0]);
$arrSplit = explode(",",$strReplace);
$_SESSION["ec"] =  $arrSplit[0];
$_SESSION["ppm"] = $arrSplit[1];
$_SESSION["salt"] = $arrSplit[2];

?>
