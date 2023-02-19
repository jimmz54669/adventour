<?php
require_once 'connect.php';
session_start();

class Shop extends Database{

    //Gets Product Lists
    function GetProdListToShop(){
        $sql = "SELECT * FROM products";
        $execute = $this->connect()->query($sql);

        if($execute == TRUE){
            $numRows = $execute->num_rows;
            //Check if Messages Exists Return Messages
            if($numRows > 0){
                $result = $execute->fetch_all(MYSQLI_ASSOC);
                    return $result;
            }
        }else{
            $_SESSION['showError'] = "ERROR: Hush! Sorry $sql. "
                . $this->connect()->connect_error;
                header("location: sign-up.php");
        }
    }//end of Function



    function AddToCart(){
        $prodname = $_POST['prodname'];
        $prodcode = $_POST['prodcode'];
        $prodprice = $_POST['prodprice'];
        $prodid = $_POST['prodid'];
        $qty = $_POST['qty'];
        $userid = $_SESSION['userid'];

        $CheckItemifExist = "SELECT * FROM cart WHERE userid = '$userid' AND prodid = '$prodid'";
        $executed = $this->connect()->query($CheckItemifExist);

        $numRows = $executed->num_rows;
        if($numRows > 0){

            $sqls = "UPDATE cart SET qty=qty+$qty WHERE prodid='$prodid' AND userid='$userid'";
            $exe = $this->connect()->query($sqls);

            if($exe == TRUE){
                // print_r('Updated the Qty on the Cart!');
                // $data = $this->GetCartCnt();
                // return $data;
            }else{
                    header("location: sign-up.php");
            }
        }else{
            $sql = "INSERT INTO cart (prodid, prodname, prodprice, prodcode, qty, userid) VALUES('$prodid', '$prodname', '$prodprice', '$prodcode', '$qty', '$userid')";
            $execute = $this->connect()->query($sql);


            if($execute == TRUE){
                // print_r('Added on the Cart');
                // $data = $this->GetCartCnt();
                // return $data;
            }else{
                    header("location: sign-up.php");
            }
        }

    }//end of function




    function GetCartCntJson(){

        $userid = $_SESSION['userid'];

        $sql = "SELECT SUM(qty) AS cartcnt FROM cart WHERE userid = '$userid'";
        $execute = $this->connect()->query($sql);

        if($execute == TRUE){
            $numRows = $execute->num_rows;
            if($numRows > 0){
                $result = $execute->fetch_all(MYSQLI_ASSOC);
             echo json_encode($result);
            }else{
                    header("location: sign-up.php");
            }
        }else{
            header("location: sign-up.php");
        }

    }//End Function




    function GetCartCnt(){

        $userid = $_SESSION['userid'];

        $sql = "SELECT SUM(qty) AS cartcnt FROM cart WHERE userid = '$userid'";
        $execute = $this->connect()->query($sql);

        if($execute == TRUE){
            $numRows = $execute->num_rows;
            if($numRows > 0){
                $result = $execute->fetch_all(MYSQLI_ASSOC);
             return $result;
            }else{
                    header("location: sign-up.php");
            }
        }else{
            header("location: sign-up.php");
        }

    }//End Function




    function GetCartLists(){
        $userid = $_SESSION['userid'];

        $sql = "SELECT cart.id, cart.prodid, cart.prodname, cart.prodprice, cart.qty, cart.userid, cart.prodcode, products.prodimg FROM cart LEFT JOIN products on products.id = cart.prodid WHERE cart.userid = '$userid'";
        $execute = $this->connect()->query($sql);

        if($execute == TRUE){
            $numRows = $execute->num_rows;
            if($numRows > 0){
                $result = $execute->fetch_all(MYSQLI_ASSOC);
             return $result;
            }else{
                    header("location: sign-up.php");
            }
        }else{
            header("location: sign-up.php");
        }
    }//end of Function




    function PlacedOrder(){
        $orderaddress = $_POST['orderaddress'];
        $mobilenumber = $_POST['mobilenumber'];
        $paymentopt = $_POST['paymentopt'];
        $subtotal = $_POST['subtotal'];
        $grandtotal = $_POST['grandtotal'];
        $totalqty = $_POST['totalqty'];
        $userid = $_SESSION['userid'];

        //Take Cart Details
        $Cart = $this->GetCartLists();
        if(sizeof($Cart) > 0){
            //Save Order
            $sql = "INSERT INTO orders (userid,subtotal,amount,discount,shippingfee,ordertype,orderqty,orderaddress,mobilenumber) VALUES('$userid', '$subtotal', '$grandtotal', '', '150', '$paymentopt', '$totalqty', '$orderaddress', '$mobilenumber')";
            $execute = $this->connect()->query($sql);

            if($execute == TRUE){
                
                $sqlstr = "SELECT MAX(id) FROM orders WHERE userid='$userid'";
                $get_order_id = $this->connect()->query($sqlstr);
                while($row = $get_order_id->fetch_row()){
                    $order_id = $row[0];
                }

                //Save Order Details
                $values = array();
                foreach($Cart as $row){
                    $prodname = $row['prodname'];
                    $prodprice = $row['prodprice'];
                    $prodamount = $row['prodprice'] * $row['qty'];
                    $prodimg = $row['prodimg'];
                    $prodqty = $row['qty'];
                    $userid = $row['userid'];
                    $prodid = $row['prodid'];
                    $values[]= "('".$prodname."','".$prodprice."','".$prodqty."','".$prodamount."','".$userid."','".$prodid."','".$order_id."','".$prodimg."') ";
                    
                }
                $sql = "INSERT INTO orderdetails (prodname,prodprice,prodqty,prodamount,userid,prodid,orderid,prodimg) VALUES ".implode(',', $values);
                $execute = $this->connect()->query($sql);
                    
                if($execute == TRUE){
                    $sql = "DELETE FROM cart WHERE userid='$userid'";
                    $execute = $this->connect()->query($sql);
                }
                
            }else{
                print_r('mali sa insert order');
            }
        }
    
    }//End of Function



    function GetOrderLists(){
        $userid = $_SESSION['userid'];

        $sql = "SELECT orders.id AS orderid, orders.orderaddress, orders.amount, orders.ordertype, users.firstname, users.lastname FROM orders LEFT JOIN users ON users.id = orders.userid WHERE orders.userid='$userid'";
        $execute = $this->connect()->query($sql);

        if($execute == TRUE){
            $numRows = $execute->num_rows;
            if($numRows > 0){
                $result = $execute->fetch_all(MYSQLI_ASSOC);
             return $result;
            }else{
                    header("location: sign-up.php");
            }
        }else{
            header("location: sign-up.php");
        }
    }



    function GetOrderDetailsJson(){
        $orderid = $_GET['orderid'];

        $sql = "SELECT * FROM orderdetails LEFT JOIN orders ON orders.id = orderdetails.orderid WHERE orders.id='$orderid'";
        $execute = $this->connect()->query($sql);

        if($execute == TRUE){
            $numRows = $execute->num_rows;
            if($numRows > 0){
                $result = $execute->fetch_all(MYSQLI_ASSOC);
                echo json_encode($result);
            }else{
                    header("location: sign-up.php");
            }
        }else{
            header("location: sign-up.php");
        }
    }


}//End of Class
?>