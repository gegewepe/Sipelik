<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $datas = DB::table('iklan')->get();
            foreach($datas as $data){
                $id = $data->id_iklan;
                $jam = $data->sisa_jam;
                $menit = $data->sisa_menit;
                
                if($menit == 0 && $jam==0){
                    $buyer = $data->id_buyer;
                    if($buyer == null || $buyer==""){
                        DB::table('notification')->insert([['id_user' => $data->idpenjual, 'message' => $data->judul_iklan . " tidak laku"]]);
                    }
                    else{
                        DB::table('notification')->insert([['id_user' => $data->idpenjual, 'message' => $data->judul_iklan . " dibeli oleh " .
                            $buyer . " seharga " . $data->harga]]);
                        DB::table('notification')->insert([['id_user' => $buyer, 'message' => "Anda berhasil membeli " . $data->judul_iklan . " seharga " .
                             $data->harga]]);
                    }
                    DB::table('iklan')->where('id_iklan',$id)->update(['status'=>2]);
                }
                else if($data->status==1){
                        if($menit==0){
                            $jam--;
                            $menit = 59;
                        }
                        else $menit--;
                        DB::table('iklan')->where('id_iklan',$id)->update(['sisa_jam' => $jam,'sisa_menit' => $menit]);    
                } 
            }
        })->everyMinute();
    }

}
