<html>
<!-- This page lists all tests, indexed by their associated support structure.
     Support Structure 1 is not a physical structure used by the group
     Rather, it is my/our testing ground -->
<head>
<title>Test List</title>

<body>
<h1>Test List</h1>

<?php
require_once("database.php");
$db = new Database();
$sql = "SELECT id,name FROM support_structure";
$db->query($sql);
$i=0;
$out=array();
while($db->nextRecord()){
$out[$i] = $db->Record;
$i++;
}

echo "<table border=1 cellpadding=5>";
  echo "<tr><th>Support Structures</th>";
    echo "<th>Tests</tr>";
  foreach($out as $structure){
  echo "<tr>";
    echo "<td>";
      echo "<a href=\"ss_summary.php?id=$structure[0]\">$structure[1]</a>";
      echo "</td>";
    echo "<td>";
      $sql="SELECT name,id FROM test WHERE assoc_ss=".$structure[0];
      $db->query($sql);
      while($db->nextRecord()){
      $name=$db->Record['name'];
      $id=$db->Record['id'];
      echo "<a href=\"test.php?id=".$id."\">$name</a><br>";
      }
      echo "</td>";
    echo "</tr>";
  }
echo "</table><br>";

?>

<input type=button onClick="location.href='newtest.php'" value='New Test'>
<br><br>
<input type=button onClick="location.href='index.php'" value='Index'>


</body>
</html>
