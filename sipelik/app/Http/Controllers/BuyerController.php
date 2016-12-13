<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Validator;
use DB;
use App\User;
use App\Iklan;
use App\Testimoni;
use App\Transaksi;
use App\transaksilelang;
use Request;



class BuyerController extends controller{

  
  public function ShowPenjual($id){
    if(Auth::check())
    {
      $data=array();
      $data['penjual']=DB::table('transaksi')->join('iklan','transaksi.idiklan','=','iklan.id_iklan')
          ->join('profileuser','transaksi.idpenjual','=','profileuser.id')
          ->select('profileuser.*')
          ->where('transaksi.idpembeli','=',Auth::user()->id)
          ->where('transaksi.idiklan','=',$id)->get();
      $pembeli=DB::table('transaksi')->join('iklan','transaksi.idiklan','=','iklan.id_iklan')
          ->join('profileuser','transaksi.idpembeli','=','profileuser.id')
          ->select('transaksi.id_transaksi')
          ->where('transaksi.idpembeli','=',Auth::user()->id)
          ->where('transaksi.idiklan','=',$id)->get();
      if($pembeli)
      {
        return view('penjual',$data);
      }
      else
      {
        return redirect('/');
      }
    }
    else
    {
      return redirect('/');
    }
  }


  public function transaksi(){
    if(Request::isMethod('post'))
    {
      $data=Input::all();
      $id = $data['idiklan'];

      $datas=DB::table('iklan')->where('id_iklan','=',$id)->first();
      if($data['hargabaru'] > $datas->harga)
        {
          $jam = $datas->sisa_jam;
          $menit = $datas->sisa_menit;
          if($jam==0 && $menit < 10){
              DB::table('iklan')
                  ->where('id_iklan', $id)
                  ->update(['sisa_menit' => 10]);
          }


          $previousBuyer = $datas->id_buyer;
          if($previousBuyer !=null && $previousBuyer != ""){
              $message = "Anda gagal membeli " . $datas->judul_iklan . " karena ada yang menaruh uang lebih banyak";
              DB::table('notification')->insert([
                ['id_user' => $previousBuyer, 'message' => $message]]);
              
          }
          $message = "Anda mencoba membeli " . $datas->judul_iklan;
          DB::table('notification')->insert([
                ['id_user' => Auth::id(), 
                'message' => $message]]);


          DB::table('iklan')
                  ->where('id_iklan', $id)
                  ->update(['harga' => $data['hargabaru'], 'id_buyer' => Auth::id()]);

          Session::flash('message','Berhasil melelang');
          return redirect('/');
        }
      else{
        Session::flash('message','Harga lebih kecil daripada yang terbaru');
        return redirect('/');
      }

        Session::flash('message','Pembelian selesai. Klik data penjual untuk melihat informasi penjual. Silahkan isi testimoni setelah penjual mengkonfirmasi pemebelian anda');
        return Redirect::to($url);
      
    }
    else if(Request::isMethod('get'))
    {
    return redirect('/');
    }
  }

  public function transaksibeli()
  {
    if(Auth::check())
    {
      $data=array();
      $data['transaksi']=DB::table('transaksi')->join('iklan','transaksi.idiklan','=','iklan.id_iklan')
          ->join('profileuser','transaksi.idpenjual','=','profileuser.id')
          ->select('iklan.*','profileuser.nama_user')
          ->where('transaksi.idpembeli','=',Auth::user()->id)->get();
      return view("transaksibeli",$data);
    }
    else
    {
      return redirect('/');
    }
  }


  public function batal($id){
    if(Auth::check())
    {
      $beli=DB::table('iklan')->select('iklan.id_iklan')->where('iklan.id_iklan','=',$id)->where('iklan.status','=',0)->get();
      $pembeli=DB::table('transaksi')->select('id_transaksi')->where('transaksi.idiklan','=',$id)->where('transaksi.idpembeli','=',Auth::user()->id)->get();
      if($pembeli && $beli)
      {
        DB::table('transaksi')->where('transaksi.idiklan', '=', $id)->delete();
        DB::table('iklan')->where('id_iklan', $id)->update(['status' => 1]);
        Session::flash('message','Pembatalan berhasil');
        return Redirect::back();
      }
      elseif(!$pembeli || !$beli)
      {
        Session::flash('message','Pembatalan gagal');
        return redirect('/');
      }
    }
    else
    {
      return redirect('/');
    }
  }


}

?>
