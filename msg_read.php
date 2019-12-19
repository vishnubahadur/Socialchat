<?php
?>
<style>
table{ border-collapse:collapse; border:#804000 solid 1px;}
td{border:#804000 solid 1px; font-family:"Comic Sans MS"; font-size:14px; color:#804000;}
th{border: #FFF solid 1px; font-family:"Comic Sans MS"; font-size:14px; color:#804000; font-weight:bold; color:#FFF; background-color:#804000;}
</style>
<div class="upd">
<h2 align="center">Subject : <?php echo $msg_read;?></h2>
<form action="" method="post">
<table width="96%" align="center">
  <tr>
    <td colspan="3">
      <?php
      $fp = fopen("database/$aid/$path/$msg_read","r");
	  while(!feof($fp))
	  {
		$data = fgets($fp);
		echo $data."<br>";  
	  }
	  ?>
	</td>
  </tr>
</table>
</form>
</div>