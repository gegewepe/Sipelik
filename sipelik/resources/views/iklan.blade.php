@extends('app')
@section('header')
<!-- Full Page Image Background Carousel Header -->
<header id="myCarousel" class="carousel slide" style="margin-top:-20px;">
   <?php
    $in=0;
    ?>
    @foreach ($iklan as $indexiklan)
      <?php
      $in++;
      ?>
    @endforeach
    <!-- Indicators -->
    @if($in>=1)
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        @if($in>=2)<li data-target="#myCarousel" data-slide-to="1"></li>@endif
        @if($in>=3)<li data-target="#myCarousel" data-slide-to="2"></li>@endif
    </ol>
     @endif

    <!-- Wrapper for Slides -->
    @if($in>=1)
    <div class="carousel-inner">
        <div class="item active">
            <!-- Set the first background image using inline CSS below. -->
            <div class="fill" style="background-image:url('{{URL::asset($iklan[$in-1]->gambar)}}');"></div>
            <div class="carousel-caption">
                <h2>{{$iklan[$in-1]->judul_iklan}}</h2>
            </div>
        </div>
        @if($in>=2)
        <div class="item">
            <!-- Set the second background image using inline CSS below. -->
            <div class="fill" style="background-image:url('{{URL::asset($iklan[$in-2]->gambar)}}');"></div>
            <div class="carousel-caption">
                <h2>{{$iklan[$in-2]->judul_iklan}}</h2>
            </div>
        </div>
        @endif
        @if($in>=3)
        <div class="item">
            <!-- Set the third background image using inline CSS below. -->
            <div class="fill" style="background-image:url('{{URL::asset($iklan[$in-3]->gambar)}}');"></div>
            <div class="carousel-caption">
                <h2>{{$iklan[$in-3]->judul_iklan}}</h2>
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>

</header>
@endsection

@section('content')
<div class="container-fluid" style="padding-top:20px;">
  <div class="row">
    <div class="col-md-9 col-md-offset-2">
      <!-- <div class="panel panel-default">
        @if(empty($iklan))
        <h1>Tidak ada barang yang dijual</h1>
        @else
        <div class="panel-heading">Daftar Ikan</div>
        <div class="panel-body">
          <table class="table table-hover table-stripped">
            <tr>
              <td>Judul_iklan</td> 
              <td>Harga(/kg)</td>
              <td>Deskripsi</td>
              <td>Stok(kg)</td>
              <td>Penjual</td>
              <td>gambar</td>
            </tr>
            @foreach($iklan as $post)
            <tr>
              <td><a href="{{URL::to('iklan_detail')}}/{{$post->id_iklan}}">{{$post->judul_iklan}}</a></td>
              <td>{{$post->harga}}</td>
              <td>{{$post->deskripsi_iklan}}</td>
              <td>{{$post->stok}}</td>
              <td>{{$post->nama_user}}</td>
              <td> <?php $bukti=$post->gambar;?><img src="{{URL::to($bukti)}}" height="42" width="42"></td>
            </tr>
            @endforeach
          </table>
        </div>
        @endif
      </div> -->
      @if(empty($iklan))
       <div class="col-md-12">
         <h2>Tidak ada barang tersedia</h2>
       </div>
       </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
      @endif
      @foreach($iklan as $post)
      <div class="col-md-4">
        <div class="panel panel-primary">
              <div class="panel-heading">
                <a href="{{URL::to('iklan_detail')}}/{{$post->id_iklan}}" class="panel-title">{{$post->judul_iklan}}</a>
              </div>
              <div class="panel-body">
                <table class="table table-hover table-stripped">
                  <tr>
                    <td>Harga(kg)</td>
                    <td>{{$post->harga}}</td>
                  </tr>
                  <tr>
                    <td>Stok(kg)</td>
                    <td>{{$post->stok}}</td>
                  </tr>
                  <tr>
                    <td>Penjual</td>
                    <td>{{$post->nama_user}}</td>
                  </tr>
                  <tr>
                    <td>Gambar</td>
                    <td><img src="{{URL::to($post->gambar)}}" height="42" width="42"></td>
                  </tr>
                </table>                
              </div>
            </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

 <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
@endsection