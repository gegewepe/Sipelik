@extends('app')
@section('content')
<!-- <a href="{{URL::previous()}}" class="button">Back</a> -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading"><b>Detail Akun</b></div>
          <div class="panel-body">

            <table class="table table-hover table-stripped">
              @foreach($penjual as $post)
              <tr>
                <td>Nama Penjual</td> 
                <td>{{$post->nama_user}}</td>
              </tr>
              <tr>
                <td>Alamat Kirim</td>
                <td>{{$post->alamat_kirim}}</td>
              </tr>
              <tr>
                <td>Lokasi</td>
              </tr>
              <tr>
                <td>Nomor Telepon</td>
                <td>{{$post->no_telp}}</td>
              </tr>
              <tr>
                <td>E-mail</td>
                <td>{{$post->email}}</td>
              </tr>
              @endforeach          
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</br>
</br>
</br>
</br>
</br>
@endsection