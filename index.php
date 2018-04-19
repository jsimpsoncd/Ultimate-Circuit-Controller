
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
$outletstats = preg_split("/((\r?\n)|(\r\n?))/", $output);
?>
<table style="width:100%;border: 1px solid black;">
  <tr>
    <th>Function</th>
    <th>Status</th>
    <th>Control</th>
  </tr>
  <tr>
    <td>Downstairs Exhaust Fan</td>
    <td><?php echo explode(" ",$outletstats[0])[1];?></td>
    <?php if (explode(" ",$outletstats[0])[1] == "On") {
    echo "<td><a href='".$url."?state=on&port=1'><img src='./img/button_on_act.png'></a><a href='".$url."?state=off&port=1'><img src='./img/button_off_nact.png'></a></td>";
    } elseif (explode(" ",$outletstats[0])[1] == "Off") {
    echo "<td><a href='".$url."?state=on&port=1'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=1'><img src='./img/button_off_act.png'></a></td>";}?>
  </tr>
  <tr>
    <td>Deck Floodlights</td>
    <td><?php echo explode(" ",$outletstats[1])[1];?></td>
    <?php if (explode(" ",$outletstats[1])[1] == "On") {
    echo "<td><a href='".$url."?state=on&port=2'><img src='./img/button_on_act.png'></a><a href='".$url."?state=off&port=2'><img src='./img/button_off_nact.png'></a></td>";
    } elseif (explode(" ",$outletstats[1])[1] == "Off") {
    echo "<td><a href='".$url."?state=on&port=2'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=2'><img src='./img/button_off_act.png'></a></td>";}?>
  </tr>
  <tr>
    <td>Basement Lights</td>
    <td><?php echo explode(" ",$outletstats[2])[1];?></td>
    <td><?php echo "<a href='".$url."?state=on&port=3'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=3'><img src='./img/button_off_nact.png'></a>";?></td>
  </tr>
</table>
</body>
</html>
