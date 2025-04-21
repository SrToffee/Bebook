<header class="site-navbar" role="banner">
  <div class="site-navbar-top">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
          <form action="search.php" class="site-block-top-search" method="post">
            <span class="icon icon-search2"></span>
            <input type="text" name="search" class="form-control border-0" placeholder="Pesquisar...">
          </form>
        </div>

        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
          <div class="">
            <a href="index.php" class="js-logo-clone"><img src="img/a.png"></a>
          </div>
        </div>

        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
          <div class="site-top-icons">
            <ul>
              <li><a href="<?php echo (isset($_SESSION['id_user'])) ? "user.php" : "login.php" ?>"><span class="icon icon-person"></span></a></li>
              <li><a href="my_library.php"><span class="icon icon-book"></span></a></li>
              <li>
                <a href="cart.php" class="site-cart">
                  <span class="icon icon-shopping_cart"></span>
                  <span class="count"><?php echo (isset($_SESSION['cart'])) ? count($_SESSION['cart']): '0'; ?></span>
                </a>
              </li>
              <?php
              if (isset($_SESSION['id_user']))
                echo '<li><a href="logout.php"><span class="icon icon-arrow-right"></span> </a></li>';
              ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
  <nav class="site-navigation text-right text-md-center" role="navigation">
    <div class="container">
      <ul class="site-menu js-clone-nav d-none d-md-block">
        <li class="has-children">
          <a href="library.php">Biblioteca</a>
          <ul class="dropdown">
            <li><a href="library.php">Livros</a></li>
          </ul>
        </li>
        <li class="has-children">
          <a href="">Categorias</a>
          <ul class="dropdown">
            <li class="has-children">
              <a href="authors.php">Autores</a>
              <ul class="dropdown">
                <?php
                $header_query = mysqli_query($conn, "select * from author");
                while ($header_row =  mysqli_fetch_assoc($header_query)) {
                  echo '<li><a href="library.php?id_author=' . $header_row['id_author'] . '">' . $header_row['name'] . '</a></li>';
                }
                ?>
              </ul>
            </li>
            <li class="has-children">
              <a href="genders.php">Géneros</a>
              <ul class="dropdown">
                <?php
                $header_query = mysqli_query($conn, "select * from gender");
                while ($header_row =  mysqli_fetch_assoc($header_query)) {
                  echo '<li><a href="library.php?id_gender=' . $header_row['id_gender'] . '">' . $header_row['name'] . '</a></li>';
                }
                ?>
              </ul>
            </li>
            <li class="has-children">
              <a href="publishers.php">Editoras</a>
              <ul class="dropdown">
                <?php
                  $header_query = mysqli_query($conn, "select * from publisher");
                  while($header_row =  mysqli_fetch_assoc($header_query)){
                    echo '<li><a href="library.php?id_pub='.$header_row['id_pub'].'">'.$header_row['name'].'</a></li>';
                  }
                ?>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="library.php?offers=1">Promoções</a></li>
        <li><a href="contacts.php">Contactos</a></li>
      </ul>
    </div>
  </nav>
</header>