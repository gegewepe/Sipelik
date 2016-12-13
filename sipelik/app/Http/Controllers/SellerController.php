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



class SellerController extends controller{


  public function tambahbarang(){
    if(Auth::check())
    {
      return view("tambahbarang");
    }
    else
    {
      return redirect('/');
    }
  }

  public function tambahbarangproses(){
    if(Request::isMethod('post'))
    {
      $data=Input::all();
        $rules = array(
              'file' => 'image|max:3000',
          );
      
         // PASS THE INPUT AND RULES INTO THE VALIDATOR
          $validation = Validator::make($data, $rules);
             $file = array_get($data,'file');
             // SET UPLOAD PATH
              $destinationPath = 'uploads';
              // GET THE FILE EXTENSION
              $extension = $file->getClientOriginalExtension();
              $nama= $file->getClientOriginalName();

              // RENAME THE UPLOAD WITH RANDOM NUMBER
              $fileName = $nama; 
              // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
              $upload_success = $file->move($destinationPath, $fileName);
              $filepath = $destinationPath . '/' . $nama;
      $data=Input::all();
      
      $now = Carbon::now()->addHours(6)->toDateTimeString();

      Iklan::insertGetId(array(
      'judul_iklan'=> $data['judul'],
      'harga'=> $data['harga'],
      'deskripsi_iklan'=> $data['deskripsi'],
      'stok'=> $data['stok'],
      'gambar'=>$filepath,
      'idpenjual'=> $data['idpenjual']));
      
      $datas=DB::table('Iklan')->where('harga','=',$data['harga'])->where('stok','=',$data['stok'])->where('deskripsi_iklan','=',$data['deskripsi'])->get();
      
      transaksilelang::insertGetId(array(
          'id_iklan'=> $datas[0]->id_iklan,
          'id_user'=> 0,
          'harga'=> $data['harga'],
          'waktu'=> $now));
      
      Session::flash('message','Iklan berhasil dibuat');
      return redirect('/');
    }
    elseif(Request::isMethod('get'))
    {
      return redirect('/');
    } 
  }


  public function editbarang($id){
    if(Auth::check())
    {
      $dibeli=DB::table('transaksi')->select('id_transaksi')->where('transaksi.idiklan','=',$id)->where('transaksi.idpenjual','=',Auth::user()->id)->get();
      $penjual=DB::table('iklan')->select('id_iklan')->where('iklan.id_iklan','=',$id)->where('iklan.idpenjual','=',Auth::user()->id)->get();
      if($penjual && !$dibeli)
      {
        return view("editbarang",compact('id'));
      }
      else
      {
        Session::flash('message','Anda tidak bisa edit iklan ini. Silahkan cek transaksi penjualan anda');
        return redirect('/');
      }
    }
     else
    {
      return redirect('/');
    }
  }

  public function editbarangproses(){
    if(Request::isMethod('post'))
    {
      $data=Input::all();
       $rules = array(
              'file' => 'image|max:3000',
          );
      
         // PASS THE INPUT AND RULES INTO THE VALIDATOR
          $validation = Validator::make($data, $rules);
             $file = array_get($data,'file');
             // SET UPLOAD PATH
              $destinationPath = 'uploads';
              // GET THE FILE EXTENSION
              $extension = $file->getClientOriginalExtension();
              $nama= $file->getClientOriginalName();

              // RENAME THE UPLOAD WITH RANDOM NUMBER
              $fileName = $nama; 
              // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
              $upload_success = $file->move($destinationPath, $fileName);
              $filepath = $destinationPath . '/' . $nama;
      DB::table('iklan')
          ->where('id_iklan', $data['idiklan'])
          ->update(['gambar'=> $filepath, 'judul_iklan' => $data['judul'], 'harga' => $data['harga'], 'deskripsi_iklan' => $data['deskripsi'],'stok' => $data['stok']]);
      Session::flash('message','Edit iklan berhasil');
      return redirect('/');
    }
      elseif(Request::isMethod('get'))
    {
      return redirect('/');
    }
  }

  public function transaksijual()
  {
    if(Auth::check())
    {
      $data=array();
      $data['transaksi']=DB::table('transaksi')->join('iklan','transaksi.idiklan','=','iklan.id_iklan')
                                           ->join('profileuser','transaksi.idpembeli','=','profileuser.id')
                                           ->select('iklan.*','profileuser.nama_user')
                                           ->where('transaksi.idpenjual','=',Auth::user()->id)->get();
      return view("transaksijual",$data);
    }
    else
    {
      return redirect('/');
    }
  }

  public function konfirmasi($id){
    if(Auth::check())
    {
      $penjual=DB::table('transaksi')->select('id_transaksi')->where('transaksi.idiklan','=',$id)->where('transaksi.idpenjual','=',Auth::user()->id)->get();
      if($penjual)
      {
        DB::table('iklan')->where('id_iklan', $id)->update(['status' => 2]);
        Session::flash('message','Konfirmasi berhasil');
        return Redirect::back();
      }
      elseif(!$penjual)
      {
        Session::flash('message','Konfirmasi gagal');
        return redirect('/');
      }
    }
    else
    {
      return redirect('/');
    }
  }

  public function hapusbarang($id){
    if(Auth::check())
    {
      $dibeli=DB::table('transaksi')->select('id_transaksi')->where('transaksi.idiklan','=',$id)->where('transaksi.idpenjual','=',Auth::user()->id)->get();
      $penjual=DB::table('iklan')->select('id_iklan')->where('iklan.id_iklan','=',$id)->where('iklan.idpenjual','=',Auth::user()->id)->get();
      if($penjual && !$dibeli)
      {
        DB::table('iklan')->where('iklan.id_iklan','=',$id)->delete();
        Session::flash('message','Iklan telah dihapus');
        return Redirect::back();
      }
      else
      {
        Session::flash('message','Hapus iklan gagal');
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
