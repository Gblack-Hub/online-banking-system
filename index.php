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
            <div class="d-flex justify-content-between align-items-center text-dark">
                <div>
                	<div>Welcome, </div>
                	<div class="font-weight-bold">
                        <?php
                		  echo $_SESSION['fname'].' '.$_SESSION['lname'];
                        ?>
                    </div>
                </div>
                
        	</div>
        	<hr>
        	<div class="row">
        		<div class="col-md-4">
        			<h3 class="text-center">OPEN ACCOUNT</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                      Click here to open an account
                    </button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Thanks for Banking with us :)</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <p class="text-center">Which type of account do you wish to open?</p>
                            <form action="acctreg.php" method="POST">
                                <div class="form-group">
                                    <select name="acct_type" class="form-control">
                                        <option value="1">Savings</option>
                                        <option value="2">Current</option>
                                        <option value="3">Domiciliary</option>
                                    </select>
                                </div>
                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" name="">
                            <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                          </div>
                            </form>
                        </div>
                      </div>
                    </div>
        		</div>
        		<div class="col-md-4">
        			<h3 class="text-center">MAKE TRANSACTIONS</h3>
                    <p class="text-center">ACTIVE ACCOUNT</p>
                    <form action="transactions.php" method="POST">
                        <select name="active_acct" class="form-control bg-secondary text-white">
                            <option value="savings">Savings</option>
                            <option value="current">Current</option>
                            <option value="domiciliary">Domiciliary</option>
                        </select>
                        <button type="submit" class="btn">Submit</button>
                    </form>
                    <hr />
        			<p>Fund my account</p>
        			<form action="transactions.php" method="POST">
        				<input type="number" class="form-control" placeholder="amount" name="deposit">
        				<input type="submit" value="Submit" class="form-control bg-primary text-white" name="">
        			</form>
        			<p>Transfer to other accounts</p>
        			<form action="transactions.php" method="POST">
        				<input type="number" class="form-control" placeholder="amount" name="transfer">
        				<!-- <input type="number" class="form-control"  name="transAcct" placeholder="receipent's account number" value="20132"> -->
        				<input type="number" class="form-control"  name="transAcct" placeholder="receipent's account number" value="2000000">
        				<input type="submit" value="Submit" class="form-control bg-primary text-white" name="">
        			</form>
        			<p>Withdraw from my account</p>
        			<form action="transactions.php" method="POST">
        				<input type="number" class="form-control" placeholder="amount" name="withdraw">
        				<input type="submit" value="Submit" class="form-control bg-primary text-white" name="">
        			</form>
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