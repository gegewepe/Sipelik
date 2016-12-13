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
use Carbon\Carbon;



class HomeController extends controller{

  public function ShowIklan(){
    $data=array();
    $data['iklan']=DB::table('iklan')->join('profileuser','iklan.idpenjual','=','profileuser.id')->select('iklan.*','profileuser.nama_user')->where('iklan.status','=',1)->get();
    return view('iklan',$data);
  }

  public function ShowDetailIklan($id)
  {
    $sellingIklan=DB::table('iklan')->select('iklan.id_iklan')->where('iklan.id_iklan','=',$id)->where('iklan.status','=',1)->get();
    $bookedIklan=DB::table('iklan')->select('iklan.id_iklan')->where('iklan.id_iklan','=',$id)->where('iklan.status','=',0)->get();
    $soldIklan=DB::table('iklan')->select('iklan.id_iklan')->where('iklan.id_iklan','=',$id)->where('iklan.status','=',2)->get();
    if(!Auth::check())
    {
      if($sellingIklan)
      {
        $data=array();
        $data['iklan']=DB::table('iklan')->join('profileuser','iklan.idpenjual','=','profileuser.id')->select('iklan.*','profileuser.nama_user','profileuser.alamat_kirim')->where('iklan.id_iklan','=',$id)->get();
        return view('detailIklan',$data);
      }
      elseif($bookedIklan || $soldIklan)
      {
        return redirect('/');
      }
      else
      {
        return redirect('/');
      }
    }
    elseif(Auth::check())
    {

      if($sellingIklan)
      {
        $data=array();
        $data['iklan']=DB::table('iklan')->join('profileuser','iklan.idpenjual','=','profileuser.id')->select('iklan.*','profileuser.nama_user','profileuser.alamat_kirim')->where('iklan.id_iklan','=',$id)->get();
        return view('detailIklan',$data);
      }
      elseif($bookedIklan || $soldIklan)
      {
        $pembeli=DB::table('transaksi')->select('id_transaksi')->where('transaksi.idiklan','=',$id)->where('transaksi.idpembeli','=',Auth::user()->id)->get();
        $penjual=DB::table('transaksi')->select('id_transaksi')->where('transaksi.idiklan','=',$id)->where('transaksi.idpenjual','=',Auth::user()->id)->get();
        if($pembeli || $penjual)
        {
          $data=array();
          $data['iklan']=DB::table('iklan')->join('profileuser','iklan.idpenjual','=','profileuser.id')->select('iklan.*','profileuser.nama_user','profileuser.alamat_kirim')->where('iklan.id_iklan','=',$id)->get();
          return view('detailIklan',$data);
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
  }

  public function updateharga(){
    $data=Input::all();
    $datas=DB::table('transaksilelang')->where('id_iklan','=',$data['idiklan'])->get();
    if($data['hargabaru'] > $datas[0]->harga)
      {
        DB::table('transaksilelang')
            ->where('id_iklan', $data['idiklan'])
            ->update(['harga' => $data['hargabaru'],'id_user' => $data['idakun']]);
        Session::flash('message','Berhasil melelang');

        DB::table('Iklan')
            ->where('id_iklan', $data['idiklan'])
            ->update(['harga' => $data['hargabaru']]);
        Session::flash('message','Berhasil melelang');
        return redirect('/');
      }
    else{
      Session::flash('message','Harga lebih kecil daripada yang terbaru');
      return redirect('/');
    }
  }
  public function search()
  {
    $datas=Input::all();
    $data=array();
    $data['iklan']=DB::table('iklan')->join('profileuser','iklan.idpenjual','=','profileuser.id')->select('iklan.*','profileuser.nama_user')->where('iklan.status','=',1)->where('iklan.judul_iklan','LIKE','%'.$datas['barang'].'%')->get();
    return view('search',$data);
  }

  public function lihatbarang(){
    $data=array();
    $data['iklan']=DB::table('iklan')->select('iklan.*')->where('iklan.idpenjual','=',Auth::user()->id)->orderBy('iklan.status', 'asc')->get();
    return view('lihatbarang',$data);
  }

  

}

?>
