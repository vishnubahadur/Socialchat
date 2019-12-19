<div class="upd">
  <h2>Change Background Theme</h2>
  <div style="padding:10px;">
    <?php
$a = opendir("theme");
while($b = readdir($a))
{
  if($b!="." && $b!="..")
  {
    echo "<a href='home.php?con=$b'><img src='theme/$b' height='100' width='100' border='1'></a>\t";
  }
}
?>
  </div>
</div>

      
      