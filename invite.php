<?php
$req = $_REQUEST['req'];
$req1 = explode(",",$req);
if(isset($_REQUEST['req_sent']))
{
  foreach($req1 as $v)
  {
    if(!empty($v))
	{
	  if(file_exists("database/$v"))
	  {
	    if(!file_exists("database/$aid/friend/$v"))
		{
		  if(!file_exists("database/$v/request/$aid"))
		  {
		    if($aid != $v)
			{
		    file_put_contents("database/$v/request/$aid","$fname $lname");
			$er = "Request sent...";
			}
		  }
		}
	  }
	}
  }
}
?>
<div class="upd">
        <h2>Send Friend Request</h2>
        <div style="padding:10px;">
		<span style="color:#006600;"><?php echo $er;?></span><br>
          <form method="post" action="">
		  Each email address is separated by comma(,)
           <textarea name="req" class="post_txt"></textarea><br>
           <input type="submit" name="req_sent" value="SEND">
          </form>
        </div>
      </div>
      
      
      