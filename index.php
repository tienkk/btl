<?php include('include/header.php');

if (isset($_SESSION['email'])) {
  $custid = $_SESSION['id'];

  if (isset($_GET['cart_id'])) {
    $p_id = $_GET['cart_id'];

    $sel_cart = "SELECT * FROM cart WHERE cust_id = $custid and product_id = $p_id ";
    $run_cart    = mysqli_query($con, $sel_cart);

    if (mysqli_num_rows($run_cart) == 0) {
      $cart_query = "INSERT INTO `cart`(`cust_id`, `product_id`,quantity) VALUES ($custid,$p_id,1)";
      if (mysqli_query($con, $cart_query)) {
        header('location:index.php');
      }
    }
    if (mysqli_num_rows($run_cart) > 0) {
      while ($row = mysqli_fetch_array($run_cart)) {
        $exist_pro_id = $row['product_id'];
        if ($p_id == $exist_pro_id) {
          $error = "<script> alert('⚠️ This product is already in your cart  ');</script>";
        }
      }
    }
  }
} else if (!isset($_SESSION['email'])) {
  echo "<script> function a(){alert('⚠️ Login is required to add this product into cart');}</script>";
}
?>
<!--Carousel Wrapper-->
<div class="carousel slide mt-5" id="slider" data-ride="carousel">
    <div class="carousel-item active">
      <img src="https://giaohangnhanh.online/wp-content/uploads/2019/04/dich-vu-giao-hang-nhanh.png" class="d-block w-100">
    </div>
</div>
<!--/.Carousel Wrapper-->



<!--Latest product---->
<section>
  <div class="container pt-5 pb-5">
    <div>
      <?php
      if (isset($msg)) {
        echo $msg;
      } else if (isset($error)) {
        echo $error;
      }
      ?>
    </div>

    <h1 class="text-center">Sản phẩm mới nhất</h1>

    <div class="row mt-4">

      <?php
      $p_query = "SELECT * FROM furniture_product ORDER BY pid DESC LIMIT 28";
      $p_run   = mysqli_query($con, $p_query);

      if (mysqli_num_rows($p_run) > 0) {
        while ($p_row = mysqli_fetch_array($p_run)) {
          $pid      = $p_row['pid'];
          $ptitle  = $p_row['title'];
          $pcat    = $p_row['category'];
          $p_price = $p_row['price'];
        
          $img1    = $p_row['image'];
      ?>

          <div class="col-md-3 mt-3">
            <img src="img/<?php echo $img1; ?>" class="hover-effect" width="100%" height="337px">
            <div class="text-center mt-3">
              <h5 title="<?php echo $ptitle; ?>"><?php echo substr($ptitle, 0, 20); ?>...</h5>
              <h6>Rs. <?php echo $p_price; ?></h6>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-12 text-center">

                <a href="product-detail.php?product_id=<?php echo $pid; ?>" class="btn btn-default btn-sm hover-effect text-dark">
                  <i class="far fa-info-circle"></i> Chi tiết
                </a>

              </div>

            </div>
          </div>

      <?php
        }
      } else {
        echo "<h3 class='text-center'> No Product Available Yet </h3>";
      }

      ?>

    </div>
  </div>
</section>



<section class="back-gray pt-4 pb-4">
  <div class="container">
    <h2 class="text-center">Nó hoạt động như thế nào</h2>
    <div class="row">

      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-phone-laptop fa-3x"></i>
            <div class="heading mt-2">
              <h4>Sản phẩm</h4>
              <h6 class="text-secandary">Chọn sản phẩm</h6>
            </div>
            <p class="mt-2">Thêm sản phẩm vào giỏ hàng sau đó nhập địa chỉ rồi thành toán. </p>

          </div>
        </div>
      </div>


      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-hand-holding-box fa-3x"></i>
            <div class="heading mt-2">
              <h4>Nhận hàng</h4>
              <h6 class="text-secandary">Nhận sản phẩm của bạn</h6>
            </div>
            <p class="mt-2">Sau khi đơn hàng được xác nhận, vận chuyển sẽ giao đến trong 7 ngày làm việc.</p>

          </div>
        </div>
      </div>


      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-wallet fa-3x"></i>
            <div class="heading mt-2">
              <h4>Thanh toán</h4>
              <h6 class="text-secandary">Thanh toán khi nhận hàng</h6>
            </div>
            <p class="mt-2">Khi sản phẩm được giao đến, bạn nhận hàng và thanh toán bằng tiền mặt.</p>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('include/footer.php'); ?>