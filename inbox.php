<?php
$msg = $_REQUEST['msg'];
if(isset($_REQUEST['delete']))
{
  for($i=0;$i<count($msg);$i++)
  {
   copy("database/$aid/inbox/$msg[$i]","database/$aid/trash/inbox/$msg[$i]");
   unlink("database/$aid/inbox/$msg[$i]");
  }
}

if(isset($i))
{
 echo "<font color='red'>".$i." msg are trashed</font>";
}
?>
<style>
table{ border-collapse:collapse; border:#804000 solid 1px;}
td{border:#804000 solid 1px; font-family:"Comic Sans MS"; font-size:14px; color:#804000;}
th{border: #FFF solid 1px; font-family:"Comic Sans MS"; font-size:14px; color:#804000; font-weight:bold; color:#FFF; background-color:#804000;}
</style>
<div class="upd">
<h2 align="center">Inbox</h2>
<form action="" method="post">
<table width="96%" align="center">
  <tr>
    <th><input type="checkbox" name=""></th>
    <th>Subject</th>
    <th>Delete</th>
  </tr>
  <?PHP
  $a = opendir("database/$aid/inbox");
  while($b = readdir($a))
  {
    if($b!="." && $b!="..")
	{
  ?>
  <tr>
    <td><input type="checkbox" name="msg[]" value="<?php echo $b;?>"></td>
    <td><a href="home.php?msg_read=<?php echo $b;?>&path=inbox">View</a>  &nbsp;<?php echo $b;?></td>
    <td><a href="home.php?msg_delete=<?php echo $b;?>&path1=inbox">Delete</a></td>
  </tr>
 <?php
   }
 }
 ?>
  <tr>
    <td colspan="3">
	<input type="submit" name="delete" value="DELETE">
	</td>
  </tr>
</table>
</form>
</div>