<?php

if(isset($_REQUEST[ 'Submit' ])) {

    if(isset($_REQUEST["ticket_quantity"]))
    {
        if(isset($_REQUEST["ticket_price"]))
        {
            $ticket_price = $_REQUEST["ticket_price"];
        }
        
        $ticket_quantity = abs($_REQUEST["ticket_quantity"]);
        $total_amount = $ticket_quantity * $ticket_price;
    
        // echo "<p>You ordered <b>" . $ticket_quantity . "</b> movie tickets.</p>";
        // echo "<p>Total amount charged from your account automatically: <b>" . $total_amount . " EUR</b>.</p>";
        // echo "<p>Thank you for your order!</p>";
        
        //$_SESSION["amount"] = $_SESSION["amount"] - $total_amount;
    }


}

?>
