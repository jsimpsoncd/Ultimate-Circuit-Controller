
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php 
include("config.php");
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
  <?php  $pt = 1;?>
  <tr>
    <td>Basement Exhaust Fan</td>
    <td><?php echo explode(" ",$outletstats[$pt-1])[1];?></td>
    <?php if (explode(" ",$outletstats[$pt-1])[1] == "On") {
    echo "<td><a href='".$url."?state=on&port=".$pt."'><img src='./img/button_on_act.png'></a><a href='".$url."?state=off&port=".$pt."'><img src='./img/button_off_nact.png'></a></td>";
    } elseif (explode(" ",$outletstats[$pt-1])[1] == "Off") {
    echo "<td><a href='".$url."?state=on&port=".$pt."'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=".$pt."'><img src='./img/button_off_act.png'></a></td>";}?>
  </tr>
  <?php  $pt = 2;?>
  <tr>
    <td>Deck Floodlights</td>
    <td><?php echo explode(" ",$outletstats[$pt-1])[1];?></td>
    <?php if (explode(" ",$outletstats[$pt-1])[1] == "On") {
    echo "<td><a href='".$url."?state=on&port=".$pt."'><img src='./img/button_on_act.png'></a><a href='".$url."?state=off&port=".$pt."'><img src='./img/button_off_nact.png'></a></td>";
    } elseif (explode(" ",$outletstats[$pt-1])[1] == "Off") {
    echo "<td><a href='".$url."?state=on&port=".$pt."'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=".$pt."'><img src='./img/button_off_act.png'></a></td>";}?>
  </tr>
  <?php  $pt = 3;?>
  <tr>
    <td>Basement Lights</td>
    <td><?php echo explode(" ",$outletstats[$pt-1])[1];?></td>
    <?php if (explode(" ",$outletstats[$pt-1])[1] == "On") {
    echo "<td><a href='".$url."?state=on&port=".$pt."'><img src='./img/button_on_act.png'></a><a href='".$url."?state=off&port=".$pt."'><img src='./img/button_off_nact.png'></a></td>";
    } elseif (explode(" ",$outletstats[$pt-1])[1] == "Off") {
    echo "<td><a href='".$url."?state=on&port=".$pt."'><img src='./img/button_on_nact.png'></a><a href='".$url."?state=off&port=".$pt."'><img src='./img/button_off_act.png'></a></td>";}?>
  </tr>
</table>
</body>
</html>
