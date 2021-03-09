<?php session_start();
require ('mycon.php');
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $query2 = mysqli_query($con, "SELECT acct_number FROM account_tb WHERE user_id='$user_id'");
    $result1 = mysqli_num_rows($query2);

    $acct_no = null; #initialised account number, incase its empty
    echo $acct_no;
    if($result1 >= 1){
        $acct_info = mysqli_fetch_assoc($query2);
        $acct_no = $acct_info["acct_number"];
        $_SESSION['acct_no1'] = $acct_no;
        // while($r2 = mysqli_fetch_all($query2)){

        // }
    } else {
        $acct_no="No account number detected.";
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
    <title>Dashboard | Online Banking App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include 'links.php';
    ?>
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
                <div class="col-6 d-flex align-content-stretch">
                    <div class="bg-danger rounded-lg p-3 text-white w-100">
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
                    <div class="bg-warning rounded-lg text-right p-3 w-100">
                        <div>Account Number:</div>
                        <div class="font-weight-bold"><?php echo $acct_no; ?></div>
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3 d-flex align-content-stretch">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h5 text-center">Deposit</h5>
                        </div>
                        <div class="card-body">
                            <form action="transactions.php" method="POST">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" placeholder="amount" name="deposit">
                                </div>
                                <input type="submit" value="Submit" class="form-control bg-primary text-white" name="">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3 d-flex align-content-stretch">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h5 text-center">Fund Transfer</h5>
                        </div>
                        <div class="card-body">
                            <form action="transactions.php" method="POST">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" placeholder="amount" name="transfer">
                                </div>
                                <!-- <input type="number" class="form-control"  name="transAcct" placeholder="receipent's account number" value="20132"> -->
                                <div class="form-group">
                                    <label>Dest. Account Number</label>
                                    <input type="number" class="form-control"  name="transAcct" placeholder="receipent's account number" value="2000000">
                                </div>
                                <input type="submit" value="Submit" class="form-control bg-primary text-white" name="">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3 d-flex align-content-stretch">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h5 text-center">Withdraw</h5>
                        </div>
                        <div class="card-body">
                            <form action="transactions.php" method="POST">
                                <div class="form-group">                                
                                    <label>Amount</label>
                                    <input type="number" class="form-control" placeholder="amount" name="withdraw">
                                </div>
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
    </main>

	<?php
        include 'scripts.php';
    ?>

</body>
</html>
<?php
} else {
    header("Location: login.php");
}
?>