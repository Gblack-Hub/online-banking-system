<nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-between">
	<div>
		<button class="btn btn-outline-light ml-2 mr-2" id="openNavButton" onclick="openNav()">
		    <span><i class="fa fa-bars"></i></span>
		</button>
		<a class="navbar-brand" href="#">Dashboard</a>
	</div>
	<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	     <span class="navbar-toggler-icon"></span>
	</button> -->
	<div class="justify-content-end text-white" id="collapsibleNavbar">
		<div class="text-right">
         <div>Welcome, </div>
       	<div class="font-weight-bold">
               <?php
       		  echo $_SESSION['fname'].' '.$_SESSION['lname'];
               ?>
           </div>
      </div>
	</div>
</nav>
