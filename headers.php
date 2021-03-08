<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
	<div>
		<button class="btn btn-outline-light ml-2 mr-2" id="openNavButton" onclick="openNav()">
		    <span><i class="fa fa-bars"></i></span>
		</button>
		<a class="navbar-brand" href="index.php">Gbank</a>
	</div>
	<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	     <span class="navbar-toggler-icon"></span>
	</button> -->
	<div class="justify-content-end text-white" id="collapsibleNavbar">
		<div class="text-right">
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
</nav>
