<html>
<header>
  		<h1 id = "Firstpagebutton">
  			<strong>OurBeerLog.</strong><button id = "titlebutton" type = "button" class = "btn btn-danger btn-xs" 
  			data-toggle = "modal" data-target = "#Sinfo"><span data-toggle = "tooltip" data-placement = "bottom" 
						title = "Page Info">com</span></button>
  		</h1>
	</header>
<!--Modal-->
	<div class = "modal fade" id = "Sinfo" role = "dialog">
		<div class = "modal-dialog">
			<div class = "modal-content">
				<div class = "modal-header">
					<button type = "button" class = "close" data-dismiss = "modal">&times;</button>
					<h4 id = "modaltext" class = "modal-title"><strong><span class = 'glyphicon glyphicon-info-sign'></span> Page info</strong></h4>
				</div>
				<div class = "modal-body">
					<p class="bg-primary" id = "modaltext">Version: 2.2</p>
					<p class="bg-success" id = "modaltext">Publish date: Sep 15, 2015<p>
					<p class="bg-info" id = "modaltext">Publisher: Sean Choi</p>
					<p class="bg-warning" id = "modaltext"><a href = "mailto: ss.choi@mail.utoronto.ca">
						<span class = "glyphicon glyphicon-envelope"></span> E-mail</a></p>
					<p id = "modaltext" class = "footercopyright bg-danger"></p>
				</div>
			</div>
		</div>
	</div>
	<nav class = "navbar navbar-default">
		<div class = "container-fluid">
			<div class = "navbar-header">
				<button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target = "#myNavbar">
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
				</button>
				<a class = "navbar-brand" href = "home.php" data-toggle = "tooltip" data-placement = "auto" 
						title = "Home">
					<img id = "homeicon" src = "images/icon/beerbottle.png" alt = "homticon">
				</a>
				<a class = "navbar-brand" href = "post.php">
					<span class = "glyphicon glyphicon-pencil"></span> Post
				</a>
			</div>

			<div class = "collapse navbar-collapse" id = "myNavbar">
				<ul class = "nav navbar-nav">
					<li><a href = "commentlist.php"><span class = "glyphicon glyphicon-list"></span> Comment List</a></li>
					<li class = "dropdown">
						<a class = "dropdown-toggle" data-toggle = "dropdown" href = "#">
							<span class = "glyphicon glyphicon-search"></span>
							 Comment Search<span class = "caret"></span>
						</a>
							<ul class = "dropdown-menu">
								<li><a href = "SBB.php"><span class = 'glyphicon glyphicon-heart'></span> By Beer Name</a></li>
								<li><a href = "SBU.php"><span class = 'glyphicon glyphicon-user'></span> By User Name</a></li>
								<li><a href = "SBP.php"><span class = 'glyphicon glyphicon-cutlery'></span> By Pub Name</a></li>
								<li><a href = "SBD.php"><span class = 'glyphicon glyphicon-calendar'></span> By Date</a></li>
							</ul>
					</li>
				</ul>

				<ul class = "nav navbar-nav navbar-right">
					<li><a href = "logoutprocess.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
				</ul>
			</div>
		</div>
	</nav>
</html>
