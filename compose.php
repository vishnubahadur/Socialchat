<?php
$to = $_REQUEST['to'];
$sub = $_REQUEST['sub'];
$msg = $_REQUEST['msg'];
if(isset($_REQUEST['save']))
{
  if(empty($sub))
  {
    file_put_contents("database/$aid/draft/No Subject-$date",$msg);
	$er = "<font color='green'>Msg saved...</font>";
  }
  else
  {
  file_put_contents("database/$aid/draft/$sub-$date",$msg);
	$er = "<font color='green'>Msg saved...</font>";
  }
}
////////////////////////////////////////////
if(isset($_REQUEST['send']))
{
  if(empty($to))
  {
    $er = "<font color='red'>Please enter receiver email address</font>";
  }
  else
  {
    if(!file_exists("database/$to"))
	{
	 $er = "<font color='red'>User not exists</font>";
	}
	else
	{
	  if(empty($sub))
	  {
	   file_put_contents("database/$to/inbox/No Subject-$aid-$date",$msg);
	   file_put_contents("database/$aid/sent/No Subject-$to-$date",$msg);
	   $er = "<font color='green'>Msg sent...</font>";
	  }
	  else
	  {
	  file_put_contents("database/$to/inbox/$sub-$aid-$date",$msg);
	   file_put_contents("database/$aid/sent/$sub-$to-$date",$msg);
	   $er = "<font color='green'>Msg sent...</font>";
	  }
	}
  }
}
?>
<style>
table{ font-family:Calibri; font-size:17px; color: #804000;}
.to{ height:30px; width:95%; border:#804000 solid 1px; font-family:"Comic Sans MS"; font-size:15px; padding-left:5px;}


.sub{ height:60px; width:95%; border:#804000 solid 1px; font-family:"Comic Sans MS"; font-size:15px; padding-left:5px;}


.msg{ height:150px; width:95%; border:#804000 solid 1px; font-family:"Comic Sans MS"; font-size:15px; padding-left:5px;}
</style>
<div class="upd">
<h2 align="center">Compose</h2>
<form action="" method="post">
  <table width="80%" align="center">
  <tr>
    <td colspan="2">
	<?php echo $er;?>
	</td>
  </tr>
  <tr>
    <td>To :<br>
	<textarea name="to" class="to"></textarea>
	</td>
  </tr>
  <tr>
    <td>Subject :<br>
	<textarea name="sub" class="sub"></textarea>
	</td>
  </tr>
  <tr>
    <td>Message :<br>
	<textarea name="msg" class="msg"></textarea>
	</td>
  </tr>
  <tr>
    <td>
	  <input type="submit" name="save" value="SAVE">
	  <INPUT type="submit" name="send" value="SEND">
	</td>
  </tr>
</table>

</form>
</div>