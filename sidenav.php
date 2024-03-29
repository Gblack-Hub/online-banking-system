<div id="mySidenav" class="sidenav">
    <button class="closebtn btn btn-outline-light" onclick="closeNav()">
        <span><i class="fa fa-close"></i></span>
    </button>
    <div class="text-center">
        <a class="navbar-brand text-white text-uppercase"><strong>G'Bank</strong></a>
    </div>

    <!-- <hr width="80%" class="bg-light" />
        <div class="text-center">
            <img src="./images/img_avatar3.png" class="rounded-circle mb-2" style="height: 70px; width: 70px;" />
            <div class="text-white"><?php echo $firstname ." ".$lastname; ?></div>
            <div class="text-light font-italic"><small><?php echo "(".$position.")"; ?></small></div>
        </div>
        <hr width="80%" class="bg-light" />
    -->
    
    <a href="./index.php" class="nav-link">
        <span class="mr-2"><i class="fa fa-home"></i></span>Dashboard
    </a>

    <a href="./myProfile.php" class="nav-link">
        <span class="mr-2"><i class="fa fa-user"></i></span>My Profile
    </a>

    <a href="./accountStatement.php" class="nav-link">
        <span class="mr-2"><i class="fa fa-list"></i></span>Account Statement
    </a>
    
    <a data-toggle="modal" data-target="#myModal" class="nav-link text-white cursorPointer">
        <span class="mr-2"><i class="fa fa-pencil"></i></span>Open Account
    </a>

    <a href="./logout.php" class="nav-link text-warning">
        <span class="mr-2"><i class="fa fa-power-off"></i></span>Logout
    </a>
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