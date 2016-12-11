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
use Request;



class BuyerController extends controller{

  public function ShowTestimoniForm($id)
  {
    if(Auth::check())
    {
      $pembeli=DB::table('transaksi')->select('id_transaksi')->where('transaksi.idiklan','=',$id)->where('transaksi.idpembeli','=',Auth::user()->id)->get();
      $ada=DB::table('testimoni')->select('testimoni.id_iklan')->where('testimoni.id_iklan','=',$id)->get();
      if($pembeli && !$ada)
      {
        Session::flash('message','Anda hanya bisa melakukan testimoni sebanyak 1 kali');
        return view("testimoni",compact('id'));
      }
      elseif($ada)
      {
        Session::flash('message','Anda sudah melakukan testimoni sebelumnya');
        return redirect()->back();
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

  public function AddTestimoni(){
    if(Request::isMethod('post'))
    {
      $data=Input::all();
      Testimoni::insertGetId(array(
          'isi'=> $data['testimoni'],
          'score'=> $data['score'],
          'id_user'=> $data['iduser'],
          'id_iklan'=> $data['idiklan']));
      $id = $data['idiklan'];
      $dataa=array();
      $dataa['iklan']=DB::table('iklan')->join('profileuser','iklan.idpenjual','=','profileuser.id')->select('iklan.*','profileuser.nama_user','profileuser.alamat_kirim')->where('iklan.id_iklan','=',$id)->get();
      Session::flash('message','Terima kasih atas testimoni anda');
      return view('detailIklan',$dataa);
    }
    elseif(Request::isMethod('get'))
    {
      return redirect('/');
    }
  }

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
      $url = $data['url'];

      $status = DB::table('iklan')->select('iklan.id_iklan')->where('id_iklan','=',$id)->where('iklan.status','=',1)->get();

      if($status)
      {
         DB::table('iklan')
                ->where('id_iklan', $id)
                ->update(['status' => 0]);

        Transaksi::insertGetId(array(
        'tanggal_terjual'=> $data['tanggal'],
        'idpembeli'=> $data['idpembeli'],
        'idpenjual'=> $data['idpenjual'],
        'idiklan'=> $data['idiklan']));

        Session::flash('message','Pembelian selesai. Klik data penjual untuk melihat informasi penjual. Silahkan isi testimoni setelah penjual mengkonfirmasi pemebelian anda');
        return Redirect::to($url);
      }
      else
      {
        Session::flash('message','Barang sudah dibeli pembeli lain');
        return redirect('/');
      }
    }
    elseif(Request::isMethod('get'))
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
