<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
.img-container {
  position: relative;
  overflow: hidden;
}

.img {
  display: block;
  width: 100%;
  height: auto;
  opacity: 1;
  transition: .5s ease;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: var(--pink);
}

.img-container:hover .overlay {
  opacity: 0.3;
}

.img-container:hover .img {
  opacity: 0.5;
  
}

.img-container a {
  color: #000000;
}

.img-container .title {
  font-size: 20px;
  position: absolute;
  top: 20%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

.img-container .price {
  font-size: 20px;
  position: absolute;
  top: 80%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

.img-container .favourite {
  font-size: 20px;
  color: var(--pink);
  position: absolute;
  top: 10%;
  left: 90%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}
</style>
<div class="row starter-template">
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
	<div class="col col-12 col-md-4 px-0 py-2 p-md-2">
		<div class="img-container">
			<a href="/product/test"><img class="img" src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg"/>
			<div class="title">
				<hr class="star-primary">
				<h4 class="font-weight-bold">TEXT HERE</h4>
			</div>
			<h3 class="price font-weight-bold">RM100</h3>
			<i class="material-icons favourite">&#xe87d;</i>
			<div class="overlay"></div>
			</a>
		</div>
	</div>
</div>
