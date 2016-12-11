@extends('app')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
    @if(empty($iklan))
      <div class="col-md-12">
         <h2>Pencarian Tidak Ditemukan</h2>
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
    @else
        <div class="col-md-12">
           <h2>Hasil Pencarian</h2>
         </div>
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
        <!-- <div class="panel-heading">Hasil Pencarian</div>
        <div class="panel-body">
        
          <table class="table table-hover table-stripped">
            <tr>
              <td>Judul iklan</td> 
              <td>Harga(/kg)</td>
              <td>Deskripsi</td>
              <td>Stok(kg)</td>
              <td>Penjual</td>
              <td>Gambar</td>
            </tr>
            
            <tr>
              <td><a href="{{URL::to('iklan_detail')}}/{{$post->id_iklan}}">{{$post->judul_iklan}}</a></td>
              <td>{{$post->harga}}</td>
              <td>{{$post->deskripsi_iklan}}</td>
              <td>{{$post->stok}}</td>
              <td>{{$post->nama_user}}</td>
              <td><img src="{{URL::to($post->gambar)}}" height="42" width="42"></td>
            </tr>
            
          </table>
          
        </div> -->
      @endforeach
    @endif
    </div>
  </div>
</div>
@endsection