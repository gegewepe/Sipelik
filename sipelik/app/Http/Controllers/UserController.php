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



class UserController extends controller{

  public function ShowRegisterForm(){
    if(!Auth::check())
    {
		  return view("register");
    }
    else
    {
      return redirect('/');
    }
	}

	public function daftar()
  {
    if(Request::isMethod('post'))
    {
      $data=Input::all();
      $userexist = DB::table('profileuser')->select('profileuser.username')->where(strtolower('profileuser.username'),'=',strtolower($data['username']))->get();
  		if($userexist)
      {
        Session::flash('message','username sudah digunakan');
        return redirect('register');
      }
      elseif(!$userexist && $data['password']==$data['conpassword'])
  		{

          	$pass=bcrypt( $data['password']);
          	User::insertGetId(array(
             	 'username'=> $data['username'],
             	 'password'=> $pass,
             	 'nama_user'=> $data['nama'],
             	 'no_telp'=> $data['telp'],
             	 'alamat_user'=> $data['asal'],
             	 'alamat_kirim'=> $data['kirim'],
             	 'email'=> $data['email']
            	 
             	 ));
            $array = ['username'=>$data['username'], 'password'=>$data['password']];
            if(Auth::attempt($array,false)){
                $id=Auth::user()->id;
            }
           	return redirect('/');
      }
      else
      {
        Session::flash('message','konfirmasi password gagal');
  			return redirect('register');
      }
    }
    elseif(Request::isMethod('get'))
    {
      return redirect('/');
    }
  }

  public function loginform()
  {
    if(!Auth::check())
    {
      return view('login');
    }
    else
    {
      return redirect('/');
    }
  }

  public function login()
  {
    if(Request::isMethod('post'))
    {
      
      $rememberMe = false;
      if(isset($_POST['remember-me'])){
        $rememberMe = true;
      }
     
      $new = Input::only('username','password');
      print_r($new);
  /*
      if (Auth::attempt($new,$rememberMe))
      {
        $id=Auth::user()->id;
        return redirect('/');
      }
        else
      {
        Session::flash('message','Login anda gagal, silahkan cek kembali username dan password');
        return redirect('masuk');
      }
    */  
    }
    elseif(Request::isMethod('get'))
    {
      return redirect('/');
    } 
  }

  public function lihatakun(){
    if(Auth::check())
    {
      return view('lihatakun');
    }
    else
    {
      return redirect('/');
    }
  }

  public function editakun(){
    if(Auth::check())
    {
      return view('editakun');
    }
    else
    {
      return redirect('/');
    }
  }

  public function UpdateAccount(){
    if(Request::isMethod('post'))
    {
      $data=Input::all();

      if($data['password']==$data['conpassword'])
      {
        $pass=bcrypt( $data['password']);
        DB::table('profileuser')
            ->where('id', $data['idakun'])
            ->update(['username' => $data['username'], 'password' => $pass, 'nama_user' => $data['nama'],'alamat_user' => $data['asal'], 'no_telp' => $data['telp'], 'alamat_kirim' => $data['kirim'],'email' => $data['email']]);
        Session::flash('message','Berhasil edit akun');
        return redirect('/');
      }
      else
      {
        Session::flash('message','konfirmasi password gagal, akun gagal diedit');
        return redirect('/');
      }
    }
    elseif(Request::isMethod('get'))
    {
      return redirect('/');
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/');
  }


}

?>
