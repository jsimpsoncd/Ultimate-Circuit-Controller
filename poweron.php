
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php 
include("config.php");
$user = "admin";
$password = "admin";
$ip = "192.168.5.3";
if (array_key_exists("port", $_GET) and is_numeric($_GET["port"] )) {
	$port = $_GET["port"];
}
if (array_key_exists("state", $_GET) and $_GET["state"] == "on" or $_GET["state"] == "off") {
        $state = $_GET["state"];
}
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$output = shell_exec("expect /var/tmp/power.expect ".$ip." ".$user." ".$password." ".$port." ".$state." | tail -n 10 | head -n 8 | cut -c 7,34-39");
#foreach(preg_split("/((\r?\n)|(\r\n?))/", $output) as $line){
#	$stat = explode(" ", $line, 2);
#	if ($stat[0]) {echo $stat[0]." currently ".$stat[1]." <a href='".$url."?port=".$stat[0]."&state=on'>ON</a> <a href='".$url."?port=".$stat[0]."&state=off'>OFF</a><br>";}
#}
$outletstats = preg_split("/((\r?\n)|(\r\n?))/", $output);
?>
<table style="width:100%;border: 1px solid black;">
  <tr>
    <th>Function</th>
    <th>Port</th> 
    <th>Status</th>
    <th>Control</th>
  </tr>
  <tr>
    <td>Downstairs Exhaust Fan</td>
    <td>1</td>
    <td><?php echo explode(" ",$outletstats[0])[1];?></td>
    <td><?php echo "<a href='".$url."?state=on&port=1'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=1'><img src='./img/button_off_nact.png'></a>";?></td>
  </tr>
  <tr>
    <td>Deck Floodlight</td>
    <td>2</td> 
    <td><?php echo explode(" ",$outletstats[1])[1];?></td>
    <td><?php echo "<a href='".$url."?state=on&port=2'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=2'><img src='./img/button_off_nact.png'></a>";?></td>
  </tr>
  <tr>
    <td>Basement Lights</td>
    <td>3</td>
    <td><?php echo explode(" ",$outletstats[2])[1];?></td>
    <td><?php echo "<a href='".$url."?state=on&port=3'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=3'><img src='./img/button_off_nact.png'></a>";?></td>
  </tr>
</table>
</body>
</html>
