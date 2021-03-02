<?php
include 'config/db_config.php';
	session_start();

	extract($_REQUEST);
	
	$gtotal=array();
	$ar=array();
	$total=0;
	if(isset($_GET['product']))//product id
	{
		$product_id=$_GET['product'];
	}
	else
	{
		$product_id="";
	}
 	if(isset($_SESSION['customer_id']))
 	{
 		$cust_id=$_SESSION['customer_id'];
 		$qq=mysqli_query($con,"select * from register where id=$cust_id ");
		$qqr= mysqli_fetch_array($qq);
 	}
	if(empty($cust_id))
	{
		// header("location:index.php?msg=you must login first");
		?>
			<script>
				sweetAlert(
                    {
                        title: "you must be login first",
                        text: "Just wait for a Second",
                        type: "success"
                        },
                        function () {
                           window.location.href = 'index.php';
                    });
			</script>
		<?php
	}
	if(!empty($product_id && $cust_id ))
	{
		$query="INSERT INTO `cart` (product_id,register_id) value ('$product_id','$cust_id')";
		$run=mysqli_query($con,$query);
		echo $run;
		if($run>0)
		{
			$product_id="";
			?>
			<script>
				sweetAlert(
                    {
                        title: "Successfully Added One !",
                        text: "Just wait for a Second",
                        type: "success"
                        },
                        function () {
                           window.location.href = 'cart.php';
                    });
			</script>
		<?php

		}
		else
		{
			echo "failed";
		}
	}
	if(isset($del))
	{
		// echo $cust_id;
		// echo $del;
		$delQuery="DELETE FROM cart WHERE cart_id=$del AND register_id=$cust_id ";
		$run=mysqli_query($con,$delQuery);
		// echo $run;
		// dd();
		if($run>0)
		{
			header('location:deletecart.php');
		}
	
	}
 
 
if(isset($logout))
{
	session_destroy(); 
	header("location:index.php");
}
if(isset($login))
{
	session_destroy(); 
	header("location:index.php");
}
 
//update section
$cust_details=mysqli_query($con,"SELECT * FROM register WHERE id=$cust_id ");
$det_res=mysqli_fetch_array($cust_details);
$name=$det_res['name'];
$email=$det_res['email'];
$mobile=$det_res['phone'];
$password=$det_res['password'];
if(isset($update))
{
	   
	if(mysqli_query($con,"UPADTE register SET name='$name',phone='$mobile',password='$pswd' WHERE id=$cust_id"))
    {
		header("location:customerupdate.php");
	}
}
  
$query=mysqli_query($con,"SELECT product.p_name,product.p_category,product.p_price,product.p_description,product.p_title,product.p_image,cart.cart_id,cart.product_id,cart.register_id FROM product INNER JOIN cart ON product.p_id=cart.product_id WHERE cart.register_id=$cust_id" );
	$re=mysqli_num_rows($query);
  
?>



	 <script>
		  function del(id)
		  {
			  if(confirm('are you sure you want to cancel order')== true)
			  {
				  window.location.href='cancelorder.php?id=' +id;
			  }
		  }
		</script>


<?php include 'pages/navbar.php';?>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
      	<div class="middle" style="  padding:60px;  width:100%;">
       <!--tab heading-->
	   <ul class="nav" id="myTab" style="border-radius:10px 10px 10px 10px;">
          <li class="nav-item">
             <a class="nav-link active" style="color:red; margin-top: 30px" id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem">View Cart</a>
          </li>
		  
       </ul>
	   <br><br>
	<!--tab 1 starts-->   
	<div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-bordered text-center TableResponsive">
                <tbody>
	        	    <?php
	                	$query=mysqli_query($con,"SELECT product.p_name,product.p_category,product.p_price,product.p_description,product.p_title,product.p_image,cart.cart_id,cart.product_id,cart.register_id FROM product INNER JOIN cart ON product.p_id=cart.product_id WHERE cart.register_id=$cust_id");
	                	$re=mysqli_num_rows($query);
	                	
	                   	if($re)
	                    {
		                	while($res=mysqli_fetch_array($query))
		                  	{
				                
	                		?>
                      <tr class="font-weight-bold">
                         <td>
                         	<img class="rounded img-thumbnail" 
                         	src="Resturant/img/<?php echo $res['p_image'];?>" height="100px" width="100px">
                         </td>
                         <td class="grand"><?php echo $res['p_name'];?></td>
                         <td class="grand"><i class="fas fa-rupee-sign">
                         	<?php echo $res['p_price'];?></td>
                         <td class="grand"><?php echo $res['p_title'];?></td>
                        </form>
                        <?php 
                        	$total=$total+$res['p_price'];
                         	$gtotal[]=$total;  
                        ?>
                      </tr> 
                   <?php
	                }
					?>
					<tr>
						<td colspan="2">
					  		<h5 style="color:red;" class="grand">Grand Total</h5>
					  	</td>
					  	<td>
					  		<h5 class="grand"><i class="fas fa-rupee-sign"></i>&nbsp;
					  			<?php echo end($gtotal); ?>
					  		</h5>
					  	</td>
					</tr>
						
					<?php
	
	                }
					else
					{
						  
	                ?>
						<tr>
						 <h5 style="text-align:center; color:red"> Sorry you haven't order yet</h5>
						 <div class="text-center">
							<button type="button" class="btn btn-outline-success mt-5">
								<a href="index.php" style="color:green; text-decoration:none;">Order Now</a>
							</button>
						 </div>
						</tr>
					<?php
					}
				?>
                 </tbody>
	    	</table>	
			<span style="color:green; text-align:centre;">
				<?php if(isset($success)) { echo $success; }?></span>
    	</div>	 
	  
		<!--tab 1 ends-->	   
    </div>
      </div>
    </div>
</div>  
  
	  
<?php include("pages/footer.php");?>

   
</body>
</html>