@extends('app')
@section('content')
<!-- 
@if(empty($transaksi))
<h2>Anda belom melakukan pembelian apapun</h2>
@else
<table class="table table-hover table-stripped">
  <tr>
    <td>Judul_iklan</td> 
    <td>Harga(/kg)</td>
    <td>Deskripsi</td>
    <td>Stok(kg)</td>
    <td>Penjual</td>
    <td>Gambar</td>
    <td>Transaksi</td>
  </tr>
  <tr>
  	@foreach($transaksi as $post)
    <td><a href="{{URL::to('iklan_detail')}}/{{$post->id_iklan}}">{{$post->judul_iklan}}</a></td>
    <td>{{$post->harga}}</td>
    <td>{{$post->deskripsi_iklan}}</td>
    <td>{{$post->stok}}</td>
    <td>{{$post->nama_user}}</td>
    <td> <?php $bukti=$post->gambar;?><img src="{{URL::to($bukti)}}" height="42" width="42"></td>
    @if($post->status==0)
    <td><a href="{{URL::to('batal')}}/{{$post->id_iklan}}">Batalkan</a></td>
    @endif
    @if($post->status==2)
    <td>Selesai</td>
    @endif
  </tr>
  @endforeach
</table>
@endif -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @if(empty($transaksi))
      <div class="col-md-12">
          <h2>Anda Belum Melakukan Transaksi Pembelian</h2>
          <hr></hr>
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
          <h2>Daftar Transaksi Pembelian</h2>
          <hr></hr>
        </div>
        @foreach($transaksi as $post)          
          <div class="col-md-6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <a href="{{URL::to('iklan_detail')}}/{{$post->id_iklan}}"><b>{{$post->judul_iklan}}</b></a>
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
                  <tr>
                    <td></td>
                    @if($post->status==0)
                    <td><a href="{{URL::to('batal')}}/{{$post->id_iklan}}" role="button" class="btn btn-info">Batalkan</a></td>
                    @endif
                    @if($post->status==2)
                    <td><strong>Transaksi Selesai<strong></td>
                    @endif
                  </tr>
                </table>                
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>

@endsection