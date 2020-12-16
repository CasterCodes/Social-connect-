<nav class="navbar navbar-expand-sm bg-dark navbar-light fixed-top">
        <div class="container">
            <a href="dashboard.php" class="navbar-brand">Connect</a>
            <button class="navbar-toggler" data-target='#collapse-navbar' data-toggle='collapse'>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id='collapse-navbar'>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="developers.php" class="nav-link developer-link">Developers</a>
                    </li>
                    <?php if(isset($_SESSION['id'])):?>
                        <li class="nav-item">
                            <a href="posts.php" class="nav-link developer-link">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link developer-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">Logout</a>
                        </li>
                    <?php else:?>
                        <li class="nav-item">
                           <a href="login.php" class="nav-link">Login</a>
                        </li>
                    <?php endif;?>
                   
                </ul>
            </div>
        </div>
    </nav>