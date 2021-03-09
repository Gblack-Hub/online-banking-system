<?php session_start();
require ('mycon.php');
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $query2 = mysqli_query($con, "SELECT acct_number FROM account_tb WHERE user_id='$user_id'");
    $result1 = mysqli_num_rows($query2);

    $acct_no = null; #initialised account number, incase its empty
    if($result1 >= 1){
        mysqli_fetch_all($query2, MYSQLI_ASSOC);
        // while($r2 = mysqli_fetch_all($query2)){

        // }
    } else {
        $acct_no="You have no account yet";
    }
	$fetch = mysqli_query($con,"SELECT acct_type_id, SUM(credit-debit) AS Balance FROM transactions_tb JOIN account_tb USING(acct_number) WHERE acct_number='$acct_no' ");
	$r = mysqli_fetch_array($fetch);
// }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include 'links.php';
    ?>
    <style type="text/css">
        /* The side navigation menu */
        .sidenav {
          height: 100%; /* 100% Full-height */
          width: 250px; /* 0 width - change this with JavaScript */
          position: fixed; /* Stay in place */
          z-index: 1; /* Stay on top */
          top: 0; /* Stay at the top */
          left: 0;
          background-color: #007bff; /* Blue*/
          overflow-x: hidden; /* Disable horizontal scroll */
          padding-top: 60px; /* Place content 60px from the top */
          transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
        }

        /* The navigation menu links */
        .sidenav a {
          padding: 8px 8px 8px 32px;
          text-decoration: none;
          font-size: 18px;
          color: #FFFFFF;
          display: block;
          transition: 0.3s;
        }

        /* When you mouse over the navigation links, change their color */
        .sidenav a:hover {
          color: #f1f1f1;
        }

        /* Position and style the close button (top right corner) */
        .sidenav .closebtn {
          position: absolute;
          top: 0;
          right: 25px;
          font-size: 36px;
          margin-left: 50px;
        }

        /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
        #main {
          transition: margin-left .5s;
          /*padding: 20px;*/
          margin-left: 250px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
        }
    </style>
</head>
<body>
    <header>
    	<?php
            include "sidenav.php";
        ?>
    </header>

    <main id="main" style="color: black">
        <?php
            include "headers.php";
        ?>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="bg-danger rounded-lg p-3 text-white">
                        <div>Balance</div>
                        <div class="lead font-weight-bold">
                               <?php
                                   if($r['Balance'] <= 0){
                                       echo "&#8358;0.00";
                                   } else {
                                       echo "&#8358;".$r['Balance'];
                                   }
                               ?>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex align-content-stretch">
                    <div class="bg-warning rounded-lg p-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-12">
                    <h3 class="text-center">MAKE TRANSACTIONS</h3>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h5 text-center">Deposit</h5>
                        </div>
                        <div class="card-body">
                            <form action="transactions.php" method="POST">
                                <input type="number" class="form-control" placeholder="amount" name="deposit">
                                <input type="submit" value="Submit" class="form-control bg-primary text-white" name="">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h5 text-center">Fund Transfer</h5>
                        </div>
                        <div class="card-body">
                            <form action="transactions.php" method="POST">
                                <input type="number" class="form-control" placeholder="amount" name="transfer">
                                <!-- <input type="number" class="form-control"  name="transAcct" placeholder="receipent's account number" value="20132"> -->
                                <input type="number" class="form-control"  name="transAcct" placeholder="receipent's account number" value="2000000">
                                <input type="submit" value="Submit" class="form-control bg-primary text-white" name="">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h5 text-center">Withdraw</h5>
                        </div>
                        <div class="card-body">
                            <form action="transactions.php" method="POST">
                                <input type="number" class="form-control" placeholder="amount" name="withdraw">
                                <input type="submit" value="Submit" class="form-control bg-primary text-white" name="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        	<!-- <div class="row">
        		<div class="col-md-4">
                    <div>
                        <p class="text-center">ACTIVE ACCOUNT</p>
                        <form action="transactions.php" method="POST">
                            <select name="active_acct" class="form-control bg-secondary text-white">
                                <option value="savings">Savings</option>
                                <option value="current">Current</option>
                                <option value="domiciliary">Domiciliary</option>
                            </select>
                            <button type="submit" class="btn">Submit</button>
                        </form>
                    </div>
           		</div>
        	</div> -->
        </div>
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Open Account</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <p class="text-center">Select account type to open.</p>
                <form action="acctreg.php" method="POST">
                    <div class="form-group">
                        <select name="acct_type" class="form-control">
                            <option value="1">Savings</option>
                            <option value="2">Current</option>
                            <option value="3">Domiciliary</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" value="Submit" name="">
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </main>

	<?php
        include 'scripts.php';
    ?>
    <script type="text/javascript" src="./scripts/index.js"></script>

</body>
</html>
<?php
} else {
    header("Location: login.php");
}
?>