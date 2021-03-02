<?php
require '../PHP/functions.php';
require '../PHP/search.php';
require '../PHP/validate.php';

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>Products</title>
</head>

<body class="text-center">

  <?php require 'header.php'; ?>

  <main role="main">
    <div class="container">
      <div class="row">
        <div class=" col-md-12 ml-sm-auto col-lg-12 pt-2 px-5">
          <div class="card mt-5" style="box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.35) ;">
            <div class="card-header ">
              <form method="POST" class="form-inline">
                <a class="navbar-brand">Navbar</a>
                <input class="form-control form-control-sm" type="search" placeholder="Search" name="namep" aria-label="Search">
                <button class="btn btn-outline-success btn-sm" name="search" type="submit">Search</button>
              </form>
            </div>
            <div class="card-body">

              <table class="table table-striped table-hover text-center table-responsive-sm table-responsive-md table-responsive-lg ">
                <thead>
                  <tr>
                    <th>Img</th>
                    <th>Item</th>
                    <th>Model</th>
                    <th>Brand </th>
                    <th class="col-1">Description</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Selection</th>
                    <?php if ($rolid == 1) { ?>
                      <th class="">Quanty</th>
                      <th class="">Edit item</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  if ($resultado === false) {
                    echo "SQL Error: " . mysqli_error($conection);
                  }
                  while ($fila = mysqli_fetch_array($resultado)) {
                    $id = $fila['ea_idarticle'];
                  ?>
                    <tr>
                      <td><a href="<?php echo $fila['ea_file'] ?>"><img src="<?php echo $fila['ea_file'] ?>" alt="..." class="img-thumbnail" width="80px"></a></td>
                      <td><?php echo $fila['ea_article'] ?></td>
                      <td><?php echo $fila['ea_model'] ?></td>
                      <td><?php echo $fila['ea_brand'] ?></td>
                      <td><?php echo $fila['ea_descrip'] ?></td>
                      <td><?php 
                      switch ($fila['ea_status']) {
                        case 1:
                          echo'Avaliable';
                          break;
                        case 2:
                          echo '<p class=" text-danger">Out of stock</p>';
                          break;
                        default:
                          echo 'Status not avaliable';
                          break;
                      }
                      ?></td>
                      <form method="POST" action="requi.php">
                        <td>
                          <select name="location" class="form-control" required>
                            <option value="">Selec Location</option>
                          <?php
                           $loc=$conection->query("SELECT * FROM locations WHERE el_idlocat >4;"); 
                          
                          while ($stockrow= mysqli_fetch_array($loc)) { ?>
                            <option value="<?php echo $stockrow['el_idlocat']; ?>"><?php echo $stockrow['el_namel'];?></option>  
                            <?php }?>
                          </select>
                        </td>
                        <td>
                          <div class="row justify-content-md-center">
                            <div class="col-lg-8 ">
                              <input type="hidden" value="<?php echo $fila['ea_file'] ?>" name="file">
                              <input type="hidden" value="<?php echo $id; ?>" name="itid">
                              <input type="hidden" value="<?php echo $fila['ea_article'] ?>" name="txtname">
                              <input type="hidden" value="<?php echo $fila['ea_brand'] ?>" name="txtbrand">
                              <input type="hidden" value="<?php echo $fila['ea_model'] ?>" name="txtmodel">
                              <input type="number" class="form-control-sm col-12" name="txtqty" value="1" min="1" max="5">
                              <?php
                                if ($fila['ea_status']==1) { ?>
                                  <button type="submit" class="btn btn-primary btn-sm mt-1" name="txtadd">Requiere</button>
                              <?php     
                                }else {?>
                                  <button type="submit" class="btn btn-primary btn-sm mt-1" name="txt" disabled>Requiere</button>                                  
                              <?php 
                              }
                              ?>
                            </div>
                          </div>
                      </form>
                      </td>
                      <?php if ($rolid == 1) { ?>
                        <td> Total of items <?php echo $fila['ea_qty'] ?></td>
                        <td>
                          <form method="POST" action="edit.view.php">
                            <div class="row justify-content-md-center">
                              <div class="col-lg-8 ">
                                <input type="hidden" value="<?php echo $id; ?>" name="txtid">
                                <button type="submit" class="btn btn-danger btn-sm mt-3" name="txtedit">Edit</button>
                              </div>
                            </div>
                        </td>
                        </form>
                      <?php } ?>
                    </tr>
                  <?php }
                  mysqli_close($conection); ?>
                </tbody>
              </table>
              </form>
            </div>
          </div>
        </div>
      </div>
  </main>
  <hr>
  <br>
  <?php include "footer.php" ?>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
