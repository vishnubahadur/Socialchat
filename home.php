<?php
session_start();
error_reporting(0);
$date = date("d-m-Y h-i-s a");


$log = $_REQUEST['log'];
if($log == "logout")
{
  unset($_SESSION['sid']);
  header("location:index.php");
}
$aid =  $_SESSION['sid'];
if(empty($aid))
{
 header("location:index.php");
}
/////////////////////////////////////////
//set theme
$con = $_REQUEST['con'];
if(isset($con))
{
 file_put_contents("database/$aid/theme",$con);
 header("location:home.php?vr=theme");
}
////////////////////////////////////////////////
//-------------upload profile picture------------
$img = $_FILES['img'];
$name = $img['name'];
$type = $img['type'];
$size = $img['size'];
$tmp = $img['tmp_name'];
$path = "database/$aid/picture/".$name;
if(isset($_REQUEST['up']))
{
  move_uploaded_file($tmp,$path);
  file_put_contents("database/$aid/pic",$path);
  header("location:home.php?vr=upload");
}

//////////
$new = $_REQUEST['new'];
if(isset($new))
{
  file_put_contents("database/$aid/pic","database/$aid/picture/$new");
  header("location:home.php?vr=upload");
}
///////////////
$img_delete = $_REQUEST['img_delete'];
if(isset($img_delete))
{
  unlink("database/$aid/picture/$img_delete");
   header("location:home.php?vr=upload");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//msg delete
$msg_delete = $_REQUEST['msg_delete'];
$path1 = $_REQUEST['path1'];
if(isset($msg_delete) && isset($path1))
{
  copy("database/$aid/$path1/$msg_delete","database/$aid/trash/$path1/$msg_delete");
  unlink("database/$aid/$path1/$msg_delete");
  header("location:home.php?vr=$path1");
}
//////////////////////////////////////////////////
//msg restore
$msg_restore = $_REQUEST['msg_restore'];
$path2 = $_REQUEST['path2'];
if(isset($msg_restore) && isset($path2))
{
  copy("database/$aid/trash/$path2/$msg_restore","database/$aid/$path2/$msg_restore");
  unlink("database/$aid/trash/$path2/$msg_restore");
  header("location:home.php?vr=trash");
}

/////////////////////////////////////////////////////
$fname = file_get_contents("database/$aid/profile/fname");
$lname = file_get_contents("database/$aid/profile/lname");
$thm = file_get_contents("database/$aid/theme");
$pic = file_get_contents("database/$aid/pic");
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//req accept
$accept = $_REQUEST['accept'];
if(isset($accept))
{
 touch("database/$aid/friend/$accept");
 touch("database/$accept/friend/$aid");
}


////////////////////////////////
//friend request count
$req_count=0;
$a1 = opendir("database/$aid/request");
while($b1=readdir($a1))
{
  if($b1!="." && $b1!="..")
  {
  $req_count++;
  }
}
	   
?>
<link href="css/home.css" rel="stylesheet" type="text/css">

<body background="theme/<?php echo $thm;?>">
<div id="wrap" style=" background:url()">
  <header>
    
    <div class="logo">
      <h3>
        <span class="a">Chatter</span>
        <span class="b">Box</span>
      </h3>
      <p>connect to friends and relatives</p>
    </div>
    
    <div class="se">
      <input type="text" name="se" placeholder="Enter name,place or things..">
    </div>
    
    <div class="not">
      <div class="not1">
       <img src="img/not.png">
	   <?php
	   if($req_count>0)
	   {
	     echo "<div class='num'>$req_count</div>";
	   }
	   ?>
      </div>
      <ul>
	  <?php
	  $a1 = opendir("database/$aid/request");
	  while($b1=readdir($a1))
	  {
	   if($b1!="." && $b1!="..")
	   {
	    $name = file_get_contents("database/$aid/request/$b1");
		$p2 = file_get_contents("database/$b1/pic");
	  ?>
        <li>
          <div class="not2">
            <img src="<?php echo $p2;?>">
          </div> 
          <div class="not3">
           <?php echo $name;?><br>
           <span><a href="">ACCEPT</A></span>
           <span><a href="">REJECT</A></span>
          </div>
        </li>
      <?php
	    }
	  }
	  ?>
      </ul>
      
    </div>
    
    
    
    <div class="set">
    <div class="top2"><a href="#">Setting</a></div>
    <ul>
      <li>
        <div style="height:45px;"></div>
        <div class="set1">
          <p><a href="home.php?vr=pwd">Edit Password</a></p>
          <p><a href="home.php?vr=theme">Edit Theme</a></p>
          <p><a href="home.php?log=logout">Logout</a></p>
        </div>
      </li>
    </ul>
   </div>
    
    <div class="top">
      <ul>
        <li>
          <div class="top1">
            <a href=""><img src="<?php echo $pic;?>">
          </div>
          <div class="top2"><?php echo "$fname $lname";?></a></div>
        </li>
        <li>
          <div class="top2"><a href="home.php?vr=default">Home</a></div>
        </li>
      </ul>
      
      
    </div>
    
    
  </header>
  
  <div id="mid">
    <div class="mid1">
      <div class="pic">
        <img src="<?php echo $pic;?>">
        <div class="edit_pic">
          <a href="home.php?vr=upload">Edit Picture</a>
        </div>
      </div>
      <div class="name"><?php echo "$fname $lname";?></div>
      <div class="itm">
        <table>
          <tr>
            <td colspan="3"><a href="home.php?vr=compose">Compose</a></td>
          </tr>
          
          <tr>
            <td><a href="home.php?vr=inbox">Inbox</a></td>
            <td><a href="home.php?vr=sent">Sent</a></td>
            <td><a href="home.php?vr=draft">Draft</a></td>
          </tr>
          <tr>
            <td><a href="home.php?vr=trash">Trash</a></td>
            <td><a href="#">Profile</a></td>
            <td><a href="#">Edit Porifle</a></td>
          </tr>
        </table>
      </div>
      
      <div class="itm" style="margin-top:10px;">
        <table>
          <tr>
            <td colspan="2" style="font-family:'Monotype Corsiva'; font-size:20px;">Friends Area</td>
          </tr>
          <tr>
            <td><a href="home.php?vr=invite">Invite Friend</a></td>
            <td><a href="#">Firend List</a></td>
           
          </tr>
        </table>
      </div>
      
    </div>
    <div class="mid2">
    
      <?php
	  $vr = $_REQUEST['vr'];
	  if($vr == "default")
	  {
	    include("update.php");
	  }
	  else if($vr=="theme")
	  {
	   include("theme.php");
	  }
	  
	  else if($vr=="pwd")
	  {
	   include("pwd.php");
	  }
	  
	  else if($vr=="upload")
	  {
	   include("upload.php");
	  }
	  
	  else if($vr=="compose")
	  {
	   include("compose.php");
	  }
	  
	  else if($vr=="inbox")
	  {
	   include("inbox.php");
	  }

      
	  else if($vr=="invite")
	  {
	   include("invite.php");
	  }
	  
	  $msg_read = $_REQUEST['msg_read'];
	  $path = $_REQUEST['path'];
	  if(isset($msg_read) && isset($path))
	  {
		include_once("msg_read.php");  
	  }
	  ?>
      
      
      
      
    </div>
  </div>
</div>