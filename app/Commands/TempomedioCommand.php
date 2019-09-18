<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use DB;

class TempomedioCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'tempomedio';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $file = "c:\\importar\\tempomedio.csv";

      if(file_exists($file)){
        unlink($file);
        echo "Arquivo excluido! \n";
        echo "Aguarde enquanto geramos um novo para você... \n";
        echo "A demora irá depender de quantas infomrações você tem no banco de dados. \n";
      }

      $fileH = fopen($file, 'w+');

      $info = DB::table('latencies')
              ->select('latencies.*', 'reques.*')
              ->join('reques', 'latencies.request_id', '=', 'reques.id')
              ->orderBy('proxy', 'asc')
              ->get();

      $tamanho = count($info);
      fwrite ($fileH, 'proxy' . ';' . 'request_lat' . ';' . 'kong' . ';' . 'method' . ';' . 'url' . ';' . 'size' . ';' . 'uuid' . ';' . PHP_EOL);
      for($i=0; $i<=$tamanho -1; $i++){
        $infoPesq = json_decode(json_encode($info));
        $infoprox = $infoPesq[$i]->proxy;
        $inforequ = $infoPesq[$i]->request_lat;
        $infokong = $infoPesq[$i]->kong;
        $infometh = $infoPesq[$i]->method;
        $infourl = $infoPesq[$i]->url;
        $infosize = $infoPesq[$i]->size;
        $infouuid = $infoPesq[$i]->uuid;
        fwrite ($fileH, $infoprox . ';' . $inforequ . ';' . $infokong . ';' . $infometh . ';' . $infourl . ';' . $infosize . ';' . $infouuid . ';' .  PHP_EOL);
      }

      echo "Arquivo gerado com sucesso. \n";
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
