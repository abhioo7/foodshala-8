<?php include 'pages/navbar.php'; ?>
<body style="background-color: lightblue">
<div id="about" class="container my-5">
  <div class="row" >
    <div class="col-sm-8" style="margin-top:40px">
      <h4 class="text-secondary">Capitalism has turned human beings into commodities. 
	  To the owner of a restaurant: the cook and a bag of potatoes are equally important.
      </h4>
	  <h3><br>--Mokokoma Mokhonoana</br></h3>
      <br><button class="btn btn-default btn-lg">Get in Touch, We will love to help you</button>
    </div>
  </div>
</div>
<!-- Container (Contact Section) -->
<div id="contact" class="container bg-grey my-5 rounded" style="margin-bottom: 100px !important;">
  <div class="card shadow-lg border-0" style="border-radius: 25px;
">
  	<div class="card-body">
  		<h2 class="text-left ml-5 text-secondary pb-3">
  			<span class="badge-pill headtext">CONTACT <i class="far fa-paper-plane"></i></span>
  		</h2>
		  <div class="row justify-content-center">
		    <div class="col-sm-3">
		      <h5 class="text-secondary">
		      Contact us and we'll get back to you within 24 hours.</h5>
		      <p><span class="glyphicon glyphicon-map-marker"></span> Delhi, IN</p>
		      <p><i class="far fa-envelope mr-2"></i> foodshala@gmail.com</p>
		    </div>
		    <div class="col-md-2"></div>
		    <div class="col-sm-5 slideanim">
		    <form action="" method="POST">
			      <div class="row">
			        <div class="col-sm-6 form-group">
			          <input type="text" class="form-control" id="contact_name" name="name" placeholder="Name"  required autofocus>
			        </div>
			        <div class="col-sm-6 form-group">
			          <input type="email" class="form-control" name="email" id="contact_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please Enter Currect Email.." placeholder="Email"  required>
			        </div>
			      </div>
			      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
			      <div class="row">
			        <div class="col-sm-12 form-group text-right">
			          <button class="btn btn-outline-secondary px-4 font-weight-bold py-1" name="mail" type="submit">Send <i class="far fa-paper-plane"></i></button>
			        </div>
			      </div>
			</form>
		    </div>
		</div>
  	</div>
  </div>
</div>
<div class="container my-5 mt-5">
	<div class="row">
		<div class="col-md-12"></div>
	</div>
</div>

<?php include 'pages/footer.php' ;
?>
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h4 class="modal-title text-white">Login</h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>
          
          <form action="login.php" method="post">
                <div class="modal-body">

                  <label for="type" class="font-weight-bold">UserType:</label>
                  <div class="form-group">
                    <select name="usertype" id="usertype" class="form-control " required>
                      <option value="" selected="selected">---Select User Type---</option>
                      <option value="Customer">Customer</option>
                      <option value="Resturant">Resturant</option>
                    </select>
                  </div>
                  
                  <div class="form-group" id="Preference">
                    <label for="Preference" class="font-weight-bold">Preference:</label>
                    <select name="prefer" id="Preferenced" class="form-control ">
                      <option value="">Select Preference..</option>
                      <option value="veg">Veg</option>
                      <option value="nonveg">Non-veg</option>
                    </select>
                  </div>
                  <label for="email" class="font-weight-bold">Email:</label>
                  <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control " placeholder="Enter the email..." required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please Enter Currect Email..">
                  </div>
                  <label for="Password" class="font-weight-bold">Password:</label>
                  <div class="form-group">
                    <input type="Password" name="password" id="Password" class="form-control " placeholder="Enter the Password..." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Please Enter Currect Password..">
                  </div>
                  <div class="form-group text-right">
                    <button type="submit" name="login" class="btn btn-success btn-sm font-weight-bold px-3">Login</button>
                  </div>

                </div>
          </form>

        </div>
      </div>
    </div>

    <script>
      //login script

      $(document).ready(function(){
        $('#Preference').hide();
        $('#usertype').bind('change keyup',function () {
          var user=$(this).children("option:selected").attr('value');
          if (user == 'Customer') {
            $('#Preference').show();
          }
          else{
            $('#Preference').hide();
          }
        });
      });

    </script>

    <?php
          
                      
        if(isset($_POST['login'])) {
            $usertype=mysqli_real_escape_string($con,$_POST['usertype']);//for cutomer only
            $prefer=mysqli_real_escape_string($con,$_POST['prefer']);
            $username=mysqli_real_escape_string($con,$_POST['email']);
            $password=mysqli_real_escape_string($con,$_POST['password']);
            $hashpass=md5($password);
            if ($usertype == 'Customer') {
                $query="SELECT * FROM register WHERE email='$username' AND password='$hashpass' AND res_type='$prefer'";
                $run=mysqli_query($con,$query);
                $row=mysqli_fetch_array($run);
                if (mysqli_num_rows($run) == 1) {
                    $_SESSION['resturant']=$row['name'];
                    $_SESSION['customer_id']=$row['id'];
                    $_SESSION['preference']=$row['res_type'];
                    $_SESSION['login_type']='Customers';
                  ?>
                    <script>
                        sweetAlert(
                          {
                            title: "Welcome to Resturant...! Customer",
                            text: "Just wait for a Second",
                            type: "success"
                          },
                          function () {
                            window.location.href = 'index.php';
                          });
                    </script>
                  <?php
                  }else{
                    ?>
                      <script>
                      sweetAlert(
                        {
                          title: "UserName Or Password is Incorrect.! Customer",
                          text: "Just wait for a Second",
                          type: "error"
                        },
                        function () {
                          window.location.href = 'index.php';
                        });
                  </script>
                  <?php
                }
            }
            elseif ($usertype == 'Resturant') {
              $query="SELECT * FROM register WHERE email='$username' AND password='$hashpass'";
              $run=mysqli_query($con,$query);
              $row=mysqli_fetch_array($run);
              if (mysqli_num_rows($run) == 1) {
              $_SESSION['resturant']=$row['name'];
              $_SESSION['resturant_id']=$row['id'];
              $_SESSION['login_type']='Resturants';
                ?>
                  <script>
                      sweetAlert(
                        {
                          title: "Welcome to Resturant...!",
                          text: "Just wait for a Second",
                          type: "success"
                        },
                        function () {
                          window.location.href = 'index.php';
                        });
                  </script>
                <?php
                }else{
                  ?>
                    <script>
                      sweetAlert(
                        {
                          title: "UserName Or Password is Incorrect.! Resturant",
                          text: "Just wait for a Second",
                          type: "error"
                        },
                        function () {
                          window.location.href = './index.php';
                        });
                  </script>
                <?php
              }
            }
            else{
              ?>
                <script>
                      sweetAlert(
                        {
                          title: "Please Check your connection..",
                          text: "Just wait for a Second",
                          type: "error"
                        },
                        function () {
                          window.location.href = 'index.php';
                        });
                  </script>
              <?php
            }
          }
        ?>