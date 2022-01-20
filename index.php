<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'includes/header.php';
include 'includes/nav.php';

?>
<div id="main">
	<div class="container-rock">
      <div id="carousel-example-generic" class="carousel slide">
        <div class="carousel-inner">
          <div class="item active">
            <img src="img/pastaFav.jpg" alt="...">
            <div class="carousel-caption">
              <h4>The Most Preffered Pasta</h4>
            </div>
          </div>
          <div class="item" style="">
            <img src="img/saladFav.png" alt="...">
            <div class="carousel-caption">
              <h4>The Most Preffered Salad</h4>
            </div>
          </div>
          <div class="item" style="">
            <img src="img/dessertFav.jpg" alt="...">
            <div class="carousel-caption">
              <h4>The Most Preffered Dessert</h4>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"><span class="icon-prev"></span></a>
		<a class="right carousel-control" href="#carousel-example-generic" data-slide="next"><span class="icon-next"></span></a>
      </div>
    </div>
    <hr />
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-xs-6 text-center">
			<a> Pastas </a><br>
        	<a href="store.php?category=13"><img src="img/pasta.jpg" alt=""></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
			<a> Salads </a><br>
        	<a href="store.php?category=14"><img src="img/salads.jpg" alt=""></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
			<a> Desserts </a><br>
        	<a href="store.php?category=15"><img src="img/desserts.jpg" alt=""></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
			<a> Beverages </a><br>
        	<a href="store.php?category=16"><img src="img/beverages.jpg" alt=""></a>
        </div>
      </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>