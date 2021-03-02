<?php include 'pages/navbar.php'; ?>
<?php include 'pages/sidebar.php'; ?>
<body style="background-color: lightblue">
<div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Resturant</h2>
            </div>
          </header>

          <section class="updates padding-top">
            <div class="container-fluid">
              <div class="row justify-content-center">
                <!-- Recent Updates-->
                <div class="col-lg-12">
                  <div class="recent-updates card">
                    <div class="card-header bg-warning">
                      <h3 class="h4">All Dishes</h3>
                    </div>
                    <div class="card-body no-padding">
                      <!-- Item-->
                      <div class="item d-flex justify-content-between">
                        <div class="info d-flex">
                            <table id="example" class="table table-bordered table-responsive TableResponsive" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Dish<br>Name</th>
                                  <th>Category</th>
                                  <th>Price</th>
                                  <th>Description</th>
                                  <th>Dish<br>Size</th>
                                  <th>Dish<br>Image</th>
                                  <th>Date</th>
                                </tr>
                              </thead>
                              <tbody class="text-center">
                          <?php
                            $rest_id=$_SESSION['resturant_id'];
                            $query="SELECT *
                            FROM product ";

                              $run=mysqli_query($con,$query);
                              while ($row=mysqli_fetch_array($run)) {
                                $img=$row['p_image'];
                                $create_at=$row['created_at'];
                                ?>
                                <tr style="height: 120px !important; overflow-y: scroll;">
                                    <td><?php echo $row['p_id'];?></td>
                                    <td><?php echo $row['p_name'];?></td>
                                    <td><?php echo $row['p_category'];?></td>
                                    <td><?php echo $row['p_price'];?></td>
                                    <td width="20%" class="text-justify"><?php echo $row['p_description'];?></td>
                                    <td><?php echo $row['p_title'];?></td>
                                    <td class="text-center">
                                      <img class="rounded img-thumbnail" src="img/<?php echo htmlentities($img);?>" 
                                      style="width: 100px; height: 100px;">

                                    </td>
                                    <td width="9%"><?php echo date("d-m-Y", strtotime($create_at));?></td>
                                </tr>
                                <?php
                              }

                             ?>
                              </tbody>

                            </table>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>


  
          <!-- Page Footer-->
          <?php include 'pages/footer.php';?>
