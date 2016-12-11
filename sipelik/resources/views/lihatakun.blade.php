@extends('app')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading"><b>Detail Akun</b></div>
        <div class="panel-body">
          <table class="table table-hover table-stripped">
            <!-- <tr>
              <td>Username</td> 
              <td>Nama</td>
              <td>Alamat Asal</td>
              <td>Alamat Kirim</td>
              <td>Nomor Telepon</td>
              <td>Email</td>
            </tr>
            <tr>
              <td>{{Auth::user()->username}}</td>
              <td>{{Auth::user()->nama_user}}</td>
              <td>{{Auth::user()->alamat_user}}</td>
              <td>{{Auth::user()->alamat_kirim}}</td>
              <td>{{Auth::user()->no_telp}}</td>
              <td>{{Auth::user()->email}}</td>
            </tr> -->
            <tr>
              <td>Username</td>
              <td>{{Auth::user()->username}}</td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>{{Auth::user()->nama_user}}</td>
            </tr>
            <tr>
              <td>Alamat Asal</td>
              <td>{{Auth::user()->alamat_user}}</td>
            </tr>
            <tr>
              <td>Alamat Kirim</td>
              <td>{{Auth::user()->alamat_kirim}}</td>
            </tr>
            <tr>
              <td>Nomor Telepon</td>
              <td>{{Auth::user()->no_telp}}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{{Auth::user()->email}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</br>
</br>
</br>
@endsection