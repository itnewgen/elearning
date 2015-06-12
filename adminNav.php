<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="main.php">Kidsworld</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="main.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"> My Account<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Add Account</a></li>
            <li><a href="useredit.php">Edit Account</a></li>
            <li><a href="#">Delete Account</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="admin/admin.php"> Admin<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="admin/admin.php">File Maintenance</a></li>
          </ul>
        </li>
        <li><a href="#"></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
      </ul>
    </div>
  </div>
</nav>