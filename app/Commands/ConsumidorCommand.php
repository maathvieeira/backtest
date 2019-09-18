<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use DB;

class ConsumidorCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'consumidor';

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
      $file = "c:\\importar\\consumidor.csv";

      if(file_exists($file)){
        unlink($file);
        echo "Arquivo excluido! \n";
        echo "Aguarde enquanto geramos um novo para você... \n";
        echo "A demora irá depender de quantas infomrações você tem no banco de dados. \n";
      }

      $fileH = fopen($file, 'w+');

      $info = DB::table('reques')
              ->select('reques.id', 'uuid', 'method', 'url', 'size', 'client_ip', 'accept', 'host', 'user_agent', 'headers_id')
              ->join('headersrequest', 'reques.id', '=', 'headersrequest.headers_id')
              ->orderBy('uuid')
              ->get();

      $tamanho = count($info);
      fwrite ($fileH, 'Consumidor Uuid' . ';' . 'Method' . ';' . 'Url' . ';' . 'Size' . ';' . 'Client_ip' . ';' . 'Accept' . ';' . 'Host' . ';' . 'User_Agent' . ';' . PHP_EOL);
      for($i=0; $i<=$tamanho -1; $i++){
        $infoPesq = json_decode(json_encode($info));
        $infouuid = $infoPesq[$i]->uuid;
        $infomethod = $infoPesq[$i]->method;
        $infourl = $infoPesq[$i]->url;
        $infosize = $infoPesq[$i]->size;
        $infoclient = $infoPesq[$i]->client_ip;
        $infoaccept = $infoPesq[$i]->accept;
        $infohost = $infoPesq[$i]->host;
        $infoagent = $infoPesq[$i]->user_agent;
        fwrite ($fileH, $infouuid . ';' . $infomethod . ';' . $infourl . ';' . $infosize . ';' . $infoclient . ';' . $infoaccept . ';' . $infohost . ';' . $infoagent . ';' . PHP_EOL);
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
