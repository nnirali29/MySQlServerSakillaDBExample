<?php
include('A6db.php');
if (! array_key_exists('lname',$_GET) && ! array_key_exists('cid',$_GET)) {
?>
<form action="h6.php" method="get">
<p>Please select first character of last name:</p>
<p>First char of last name: 
<select name="lname">
<?php 
$r1 = mysqli_query($con,"SELECT substring(`last_name`,1,1) as abc FROM `customer` group by abc");
while($ro1 = mysqli_fetch_assoc($r1))
{
?>
<option value="<?php echo $ro1['abc'];?>"><?php echo $ro1['abc'];?></option><?php }?>
</select> <input type="submit" /></p>
</form>
<?php
}
else if (array_key_exists('lname',$_GET)){
  $na = $_REQUEST['lname'];
?>
  <form action="h6.php" method="get">
  <p>Please click the customer link to see brief information of the customer</p>
<?php 
  $i=1;
  $r2 = mysqli_query($con,"SELECT `customer_id`,`first_name`,`last_name` FROM `customer` WHERE substring(`last_name`,1,1)='$na' order by `customer_id`");
  while($ro2 = mysqli_fetch_assoc($r2))
  {
  ?>
  <?php echo $i.". "; ?><a href = "h6.php?cid=<?php echo $ro2['customer_id'];?>"><?php echo $ro2['first_name']." ".$ro2['last_name']; ?></a><?php echo ": active";?> <br>
  <?php $i++; } ?>
  </form>
<?php
}
else
{
	$cid=$_GET['cid'];
	$q4 =mysqli_num_rows(mysqli_query($con,"SELECT `customer_id` FROM `customer` WHERE `customer_id`='$cid'"));
	if($q4 != 0)
	{
		$r3=mysqli_query($con,"select c.first_name as cfname, c.last_name as clname,count(r.rental_id) as rented from customer c join rental r on (c.customer_id=r.customer_id) where r.customer_id='$cid'");
		$ro3=mysqli_fetch_assoc($r3);
		echo "Number of films rented by customer ".$ro3['cfname']." ".$ro3['clname']."(".$cid.") : ".$ro3['rented'];
	}
	else
	{
		echo "Sorry, the id ".$cid." is not in the database.";
	} 
}
?>
