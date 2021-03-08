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
    <style type="text/css" href="./styles/index.css"></style>
</head>
<body>
    <header>
    	<?php
            include "headers.php";
        ?>
    </header>
    <div id="mySidenav" class="sidenav">
        <a href="" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="text-center"><a href="#!dashboard" class="navbar-brand text-white text-uppercase"><strong>G'Admin</strong></a></div>

        <!-- <hr width="80%" class="bg-light" />
            <div class="text-center">
                <img src="./images/img_avatar3.png" class="rounded-circle mb-2" style="height: 70px; width: 70px;" />
                <div class="text-white"><?php echo $firstname ." ".$lastname; ?></div>
                <div class="text-light font-italic"><small><?php echo "(".$position.")"; ?></small></div>
            </div>
            <hr width="80%" class="bg-light" />
        -->
        <div>
            <a href="./index.php" class="nav-link"><span class="mr-2"><i class="fa fa-home"></i></span>Dashboard</a>
        </div>
        <div>
            <a href="./myProfile.php" class="nav-link"><span class="mr-2"><i class="fa fa-user"></i></span>My Profile</a>
        </div>
        <div>
            <a href="./accountStatement.php" class="nav-link"><span class="mr-2"><i class="fa fa-list"></i></span>Account Statement</a>
        </div>
        <div>
            <a href="./logout.php" class="nav-link"><span class="mr-2"><i class="fa fa-power-off"></i></span>Logout</a>
        </div>
    </div>
    <span onclick="openNav()">
        <span><i class="fa fa-bars"></i></span>
    </span>
    <main class="container-fluid" id="main" style="color: black">
        <div class="d-flex justify-content-between align-items-center text-dark">
            <div>
            	<div>Welcome, </div>
            	<div class="font-weight-bold">
                    <?php
            		  echo $_SESSION['fname'].' '.$_SESSION['lname'];
                    ?>
                </div>
            </div>
            <div class="text-right">
                <div>Account Balance</div>
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