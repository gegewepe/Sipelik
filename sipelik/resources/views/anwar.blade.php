<?php
use Carbon\Carbon;
$url = Request::path();
?>
@extends('app')
@section('modal')
@foreach($iklan as $post)
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Pembelian</h4>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin membeli barang ini?</p>
      </div>
      <div class="modal-footer">
        <form action="{{URL::to('transaksi')}}" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input class="form-control" name="idiklan" type="hidden" value="{{$post->id_iklan}}">
              </div>
              <div class="form-group">
                <input class="form-control" name="idpenjual" type="hidden" value="{{$post->idpenjual}}">
              </div>
              @if(Auth::check())
              <div class="form-group">
                <input class="form-control" name="idpembeli" type="hidden" value="{{Auth::user()->id}}">
              </div>
              @endif
              <div class="form-group">
                <input class="form-control" name="tanggal" type="hidden" value="{{Carbon::now()}}">
              </div>
               <div class="form-group">
                <input class="form-control" name="url" type="hidden" value="{{$url}}">
              </div>
              {{csrf_field()}}
            
              <button type="submit" class="btn btn-default" >Yes</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
         </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
    @if(empty($iklan))
      <h1>Tidak ada barang yang dijual</h1>
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
      <div class="panel panel-info">        
        <div class="panel-heading">Detail Ikan</div>
        <div class="panel-body">
          <table class="table table-hover table-stripped">
          @foreach($iklan as $post)
            <tr>
              <td>Judul_iklan</td> 
              <td>{{$post->judul_iklan}}</td>
            </tr>
            <tr>
              <td>Harga(/kg)</td>
              <td>{{$post->harga}}</td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td>{{$post->deskripsi_iklan}}</td>
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
              <td>Lokasi</td>
              <td>{{$post->alamat_kirim}}</td>
            </tr>
            <tr>
              <td>Gambar</td>
              <td> <?php $bukti=$post->gambar;?><img src="{{URL::to($bukti)}}" height="42" width="42"></td>
            </tr>
            @if(Auth::check() && Auth::user()->id==$post->idpenjual)
              @if($post->status==0 || $post->status==2)
               <h4>barang sudah terjual</h4>
               @endif
               @if($post->status==1)
                <div class="col-md-6">
                  <a href="{{URL::to('editbarang')}}/{{$post->id_iklan}}" role="button" class="btn btn-info">Edit Iklan</a>
                  <a href="{{URL::to('hapusbarang')}}/{{$post->id_iklan}}" role="button" class="btn btn-info">Hapus Iklan</a>
                </div>
               @endif
              <!-- <a href="{{URL::to('hapusbarang')}}/{{$post->id_iklan}}">Hapus Barang</a> -->
              @endif
              @if(Auth::check() && Auth::user()->id!=$post->idpenjual)
              @if($post->status==0)
                <div class="col-md-6">
                 <h4>barang sudah terjual</h4>
                </div>
                <d iv class="col-md-6" align="right">
                  <a href="{{URL::to('penjual')}}/{{$post->id_iklan}}" role="button" class="btn btn-info">Data Penjual</a>   
                </div>
              @endif
              @if($post->status==2)
                <div class="col-md-6">
                 <h4>barang sudah terjual</h4>
                </div>
                <d iv class="col-md-6" align="right">
                  <a href="{{URL::to('testimoni')}}/{{$post->id_iklan}}" role="button" class="btn btn-info">Buat Testimoni</a>
                  <a href="{{URL::to('penjual')}}/{{$post->id_iklan}}" role="button" class="btn btn-info">Data Penjual</a>   
                </div>
              @endif
              @if($post->status==1)
                  <div class="col-md-6">
                    <button type="button" class="btn btn-info btn-md" align="right" data-toggle="modal" data-target="#myModal">Beli</button>
                  </div>
              @endif
            @endif
          @endforeach
          </table>
        </div>
      </div>
    @endif
    </div>
  </div>
</div>
@endsection