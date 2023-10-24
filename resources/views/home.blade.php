@extends('layouts.app')

@section('content')
<style>
      .main{
        background-color:#823a35;
        color:white;
        height:100vh;
    }
</style>
<div class="container text-center">
    <h1 class="m-5">Welcome To Our Site</h1>
<div id="carouselExampleInterval" class="carousel slide m-5 " data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
    <img class=" " src="https://www.thepamplemousseproject.com/wp-content/uploads/2022/11/cup-spoon-min-492x415_V2.jpg" class="d-block " alt="..." style="width:50rem; height:30rem;object-fit: contain;">
    </div>
    <div class="carousel-item" data-bs-interval="2000">
    <img class=" " src="https://www.allrecipes.com/thmb/Fn8sQse3Qpco_dETJZbP0JUzmjU=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/687234-c12a3f1a2b0f42fd99eac858594bddec.jpg" style="width:50rem; height:30rem; object-fit: contain;" class="d-block" alt="...">
    </div>
    <div class="carousel-item">
    <img class=" " src="https://www.whattheforkfoodblog.com/wp-content/uploads/2016/06/Coconut-Mocha-Frappuccino-683x1024.jpg.webp" class="d-block " alt="..." style="width:50rem; height:30rem;object-fit: contain;">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
@endsection
