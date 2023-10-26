<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
     *{
        margin: 0;
        padding: 0;
     }
    </style>
</head>
<body>
   <?php include('../connection.php') ?>
    <?php
       $id= $_GET['id'];
       $query= "SELECT * FROM orders WHERE orderId='$id'";
       $result= mysqli_query($conn,$query);
       $data= mysqli_fetch_assoc($result);
       $productId= $data['productId'];
       $productData= "SELECT * FROM product WHERE productId='$productId'";
       $productDataResult= mysqli_query($conn,$productData);
       $results= mysqli_fetch_assoc($productDataResult);
    ?>
    <div class="container mt-4">
      <div class="row">
        <div class="col">
          <div class="sellerInfo">
             <?php
                $sellerId= $results['phoneNumber'];
                $sellerInfo="SELECT * FROM userdetails WHERE phoneNumber='$sellerId'";
                $sellerInfoResult= mysqli_query($conn,$sellerInfo);
                $sellerData= mysqli_fetch_assoc($sellerInfoResult);
             ?>
             <h4><?php echo $sellerData['firstName']." ".$sellerData['lastName'];?></h4>
             <h5><?php echo $sellerData['phoneNumber']; ?></h5>
          </div>
        </div>
        <div class="col">
          <h2 class="text-right">Invoice</h2>
        </div>
      </div>
      <div class="row mt-4">
         <div class="col">
           <h4>Billing Address:</h4>
           <h6><?php echo $data['name'];?></h6>
           <p><?php echo $data['houseName'];?></p>
           <p><?php echo $data['city'];?></p>
           <p><?php echo $data['state'];?></p>
           <p>Pin: <?php echo $data['pinCode'];?></p>
           <p>Phone: <?php echo $data['phoneNumber'];?></p>
         </div>
      </div>
      <div class="row">
        <table class="table table-bordered">
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Amount</th>
        </tr>
        <tr>
          <td><?php echo $results['productName']; ?></td>
          <td><?php echo $data['orderQuantity']; ?></td>
          <td><?php echo $data['orderPrice']; ?></td>
        </tr>
        </table>
      </div>
      <div class="row">
        <div class="col">
          <h6 class="text-right">Amount to be Paid: <?php echo $data['orderPrice']; ?></h6>
        </div>
        <div class="col">
          <button class="btn btn-primary" id="pay-button">Pay Bill</button>
        </div>
      </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
									<script>
            document.getElementById("pay-button").addEventListener("click", function () {
                var options = {
                    "key": "rzp_test_4x4SkOvOeVVpuH",
                    "amount": 50000,
                    "currency": "INR",
                    "name": "EcoEats",
                    "description": "Payment Description",
                    // "order_id": "{{ payment.id }}",
                    "handler": function (response) {
                        // Handle the payment response here (e.g., send to your server for verification)
                    },
                    "prefill": {
                        "name": "User's Name",
                        "email": "user@example.com",
                        "contact": "1234567890"
                    }
                };
                var rzp = new Razorpay(options);
                rzp.open();
            });
        </script>