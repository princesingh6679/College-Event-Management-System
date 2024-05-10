
<?php

include 'classes/db1.php';
if (isset($_GET['event_id'])) {
    $eventid = $_GET['event_id'];
}

$query = "SELECT event_price FROM events WHERE event_id = '$eventid'";
$result =  $conn->query($query);

if ($result) {
$row = mysqli_fetch_assoc($result);
$event_price = $row['event_price'];
} else {
echo "Error retrieving event price: " .$conn->error;
}
?>

<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Payment Gateway</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/pay.css">

    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>

</head>

<body oncontextmenu='return false' class='snippet-body'>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="total-amount">Total amount</h5>
                <div class="amount-container"><span class="amount-text">
                     <label> <?Php  echo "Rs ".$event_price;?></label></span>
                </div>
            </div>
            <div class="pt-4">
                <label class="d-flex justify-content-between"> <span class="label-text label-text-cc-number">CARD NUMBER</span><img src="https://img.icons8.com/dusk/64/000000/visa.png" width="30" class="visa-icon" /></label>
                <input type="tel" name="credit-number" class="form-control credit-card-number" id="cardNumber" maxlength="19" placeholder="Card number">
            </div>
            <div class="d-flex justify-content-between pt-4">
                <div>
                    <label><span class="label-text">EXPIRY</span> </label>
                    <input type="date" name="expiry-date" id="expiryDate" class="form-control expiry-class" placeholder="MM / YY">
                </div>
                <div>
                    <label><span class="label-text">CVV</span></label>
                    <input type="tel" name="cvv-number" class="form-control cvv-class" id="cvv" maxlength="3" pattern="\d*">
                </div>
            </div>
            <div class="d-flex justify-content-between pt-5 align-items-center">
                <a href="index.php" class="btn btn-danger">Cancel</a>
                <button type="button" id="payButton" class="btn payment-btn" onclick="return validateForm()">Make Payment</button>
            </div>
        </div>
    </div>
    <div id="paymentMessage" style="display: none; color: green; font-weight: bold; text-align: center;">Payment Successful!</div>

    <div id="participationMessage" style="display: none; color: blue; font-weight: bold; text-align: center;">Thank you for participation!</div>
    <script>
        function validateForm() {
            // Get form fields
            var cardNumber = document.getElementById('cardNumber').value;
            var expiryDate = document.getElementById('expiryDate').value;
            var cvv = document.getElementById('cvv').value;

            // Check if all fields are filled
            if (cardNumber && expiryDate && cvv) {
                if (cardNumber.length >= 8 && cardNumber.length <= 16 && /^\d+$/.test(cardNumber) && expiryDate && /^\d+$/.test(cvv) && cvv.length==3) {
                // Show the payment success message
                var paymentMessage = document.getElementById('paymentMessage');
                paymentMessage.style.display = 'block';
                

                var participationMessage = document.getElementById('participationMessage');
                participationMessage.style.display = 'block';
                // Blink the message
                setInterval(function() {
                    participationMessage.style.visibility = (participationMessage.style.visibility == 'hidden' ? '' : 'hidden');
                }, 500);

              // Execute PHP code after payment success
              $.ajax({
                    type: 'POST',
                    url: 'pay_entry.php', // Replace with your PHP script handling the payment
                    success: function(response) {
                        // alert(response); // Alert the response from the server
                    }
                });

            } else {
                // Show the validation message
                alert('Fill all valid details');
                return false;
            }
        } 
    }
    </script>
</body>

</html>
