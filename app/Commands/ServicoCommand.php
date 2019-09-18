<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use DB;

class ServicoCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'servico';

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
      $file = "c:\\importar\\servico.csv";

      if(file_exists($file)){
        unlink($file);
        echo "Arquivo excluido! \n";
        echo "Aguarde enquanto geramos um novo para você... \n";
        echo "A demora irá depender de quantas infomrações você tem no banco de dados. \n";
      }

      $fileH = fopen($file, 'w+');

      $info = DB::table('servic')
              ->select('*')
              ->orderBy('host')
              ->get();

      $tamanho = count($info);
      fwrite ($fileH, 'connect_timeout' . ';' . 'created_at' . ';' . 'host' . ';' . 'service_id' . ';' . 'name' . ';' . 'path' . ';' . 'port' . ';' . 'protocol' . ';' . 'read_timeout' . ';' . 'retries' . ';' . 'updated_at' . ';' . 'write_timeout' . ';' . PHP_EOL);
      for($i=0; $i<=$tamanho -1; $i++){
        $infoPesq = json_decode(json_encode($info));
        $infoconn = $infoPesq[$i]->content_timeout;
        $infocreat = $infoPesq[$i]->created_at;
        $infohost = $infoPesq[$i]->host;
        $infoserv = $infoPesq[$i]->service_id;
        $infoname = $infoPesq[$i]->name;
        $infopath = $infoPesq[$i]->path;
        $infoport = $infoPesq[$i]->port;
        $infoprot = $infoPesq[$i]->protocol;
        $inforead = $infoPesq[$i]->read_timeout;
        $inforetr = $infoPesq[$i]->retries;
        $infoupda = $infoPesq[$i]->updated_at;
        $infowrit = $infoPesq[$i]->write_timeout;
        fwrite ($fileH, $infoconn . ';' . $infocreat . ';' . $infohost . ';' . $infoserv . ';' . $infoname . ';' . $infopath . ';' . $infoport . ';' . $infoprot . ';' . $inforead . ';'
        . $inforetr . ';' . $infoupda . ';' .  $infowrit . ';' .  PHP_EOL);
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
