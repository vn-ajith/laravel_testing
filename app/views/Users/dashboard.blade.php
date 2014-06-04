@extends('layout')
@section('content')
<script type="text/javascript" src="assets/js/dashboard.js"></script>
<script type='text/javascript'>
        
            $(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
});
        
        </script>
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->










        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
            /*
 * Style tweaks
 * --------------------------------------------------
 */
body {
  padding-top: 50px;
  background-color: #f5f5f5;
}
footer {
  padding-left: 15px;
  padding-right: 15px;
  background-color: #fff;
}

/*
 * Off Canvas
 * --------------------------------------------------
 */
@media screen and (max-width: 768px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.25s ease-out;
    -moz-transition: all 0.25s ease-out;
    transition: all 0.25s ease-out;
  }

  .row-offcanvas-left
  .sidebar-offcanvas {
    left: -33%;
  }

  .row-offcanvas-left.active {
    left: 33%;
  }

  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 33%;
    margin-left: 10px;
  }
}


/* Sidebar navigation */
.nav-sidebar {
  background-color: #f5f5f5;
  margin-right: -15px;
  margin-bottom: 20px;
  margin-left: -15px;
}
.nav-sidebar > li > a {
  padding-right: 20px;
  padding-left: 20px;
}
.nav-sidebar > .active > a {
  color: #fff;
  background-color: #428bca;
}

/*
 * Main content
 */

.main {
  padding: 20px;
  background-color: #fff;
}
@media (min-width: 768px) {
  .main {
    padding-right: 40px;
    padding-left: 40px;
  }
}
.main .page-header {
  margin-top: 0;
}

        </style>
    
    
    <!-- HTML code from Bootply.com editor -->
    
    <body  >
        
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Hi {{$user}}</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{action('UsersController@dashboard')}}">Dashboard</a></li>
            <li><a href="{{action('PageBuilderController@page_build')}}">Page builder</a></li>
            <li><a href="{{action('UsersController@logout')}}">Sign out</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          
        </div>
      </div>
</nav>

<div class="container-fluid">
      
      <div class="row row-offcanvas row-offcanvas-left">
        
         <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
           
            <!--<ul class="nav nav-sidebar">
              <li class="active"><a href="#">Overview</a></li>
              <li><a href="#">Reports</a></li>
              <li><a href="#">Analytics</a></li>
              <li><a href="#">Export</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="">Nav item</a></li>
              <li><a href="">Nav item again</a></li>
              <li><a href="">One more nav</a></li>
              <li><a href="">Another nav item</a></li>
              <li><a href="">More navigation</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="">Nav item again</a></li>
              <li><a href="">One more nav</a></li>
              <li><a href="">Another nav item</a></li>
            </ul>-->
          
        </div><!--/span-->
        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </p>
          
		  <h1 class="page-header">
            Dashboard
		
           <div>
		
		</div>
          </h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <img src="assets/images/users.png" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail" id="users">
              <h4>Users</h4>
              <span class="text-muted">Users linked to this account</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <img src="assets/images/add_user.png" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail" id="add_new_user">
		<h4>Add new users</h4>
              <span class="text-muted">Add new users to this account</span>
              
            </div>
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <img src="assets/images/search.png" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail" id="search_user">
              <h4>Add existing</h4>
              <span class="text-muted">Search existing users and add to account</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <img src="assets/images/pages.png" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail" id="page_viewer">
              <h4>Pages</h4>
              <span class="text-muted">Pages created using this account</span>
            </div>
          </div>
          
          <hr>

          
      </div><!--/row-->
	</div>
</div><!--/.container-->

<footer>
  <p class="pull-right">©</p>
</footer>

<!--modal -->
	<div class="modal fade" id="myModal_1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" >Add new user</h4>
				</div>	
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="username" placeholder="Enter a username"> 	
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="email" placeholder="Enter an email"> 	
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="password" placeholder="Enter a password"> 	
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="save_user" type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<div class="modal fade" id="myModal_2">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="modal_title"></h4>
				</div>	
				<div class="modal-body" id="modal_body">
					
				</div>
				<div class="modal-footer">
					
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->



	<div class="modal fade" id="myModal_3">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Search user</h4>
				</div>	
				<div class="modal-body" >
					<div class="form-group">
					<input type="text" placeholder="Enter atleast 3 letters of username" id="search_user_text" class="form-control">
					</div>
					<div id="search_results">
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-primary" value="Add users to account" id="add_user_account">
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


<!-- /.modal -->
@stop