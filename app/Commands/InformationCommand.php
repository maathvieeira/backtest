<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use DB;

class InformationCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'informacao';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Everything informations send of logs';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Importando arquivo! \n";
        echo "Aguarde um momento... \n";

        $fp  = 'c:\importar\logs_.txt';

        $conents_arr = file($fp,FILE_IGNORE_NEW_LINES);

        foreach($conents_arr as $key=>$value)
        {
            $conents_arr[$key]  = rtrim($value, "\r");
        }

        $tamanho = count($conents_arr);
        $useragent = 'user-agent';
        $contentlength = 'Content-Length';
        $accessCredentials = 'access-control-allow-credentials';
        $accessorigin = 'access-control-allow-origin';
        $contentType = 'Content-Type';

        for($i=0; $i<=$tamanho -1; $i++){
          $arq = json_decode($conents_arr[$i]);
          //request
          $tiporequest = $arq->request;
          $stdClass = json_decode(json_encode($tiporequest));
          //response
          $tiporesponse = $arq->response;
          $stdClassResp = json_decode(json_encode($tiporesponse));
          //route
          $tiporoute = $arq->route;
          $stdClassRoute = json_decode(json_encode($tiporoute));
          //service
          $tiposervice = $arq->service;
          $stdClassServ = json_decode(json_encode($tiposervice));
          //service
          $tipolatencies = $arq->latencies;
          $stdClassLat = json_decode(json_encode($tipolatencies));
          //insert request
          DB::table('reques')->insert(
            ['method' => $stdClass->method, 'uri' => $stdClass->uri, 'url' => $stdClass->url, 'size' => $stdClass->size, 'upstream_uri' => $arq->upstream_uri, 'uuid' => $arq->authenticated_entity->consumer_id->uuid, 'client_ip' => $arq->client_ip, 'created_at' => $arq->started_at]
          );
          //seleciona id do request com base no client_ip
          $pesq = DB::table('reques')->select('id')->where('client_ip', '=', $arq->client_ip)->get();
          $idPesq = json_decode(json_encode($pesq));
          $idReq = $idPesq[0]->id;
          //insere as informações do headers do request
          DB::table('headersrequest')->insert(
            ['accept' => $stdClass->headers->accept, 'host' => $stdClass->headers->host, 'user_agent' => $stdClass->headers->$useragent, 'headers_id' => $idReq]
          );
          //insere as informações do response
          DB::table('respons')->insert(
            ['status' => $stdClassResp->status, 'size' => $stdClassResp->size, 'request_id' => $idReq]
          );
          //pesquisa qual o id do response
          $pesqResponse = DB::table('reques')->select('id')->where('client_ip', '=', $arq->client_ip)->get();
          $idPesqResponse = json_decode(json_encode($pesqResponse));
          $idReqResponse = $idPesqResponse[0]->id;
          //insere as informações do headers do request
          DB::table('headersresponse')->insert(
            ['content_length' => $stdClassResp->headers->$contentlength, 'via' => $stdClassResp->headers->via, 'connection' => $stdClassResp->headers->Connection, 'access_control_allow_credentials' => $stdClassResp->headers->$accessCredentials, 'content_type' => $stdClassResp->headers->$contentType,  'server' => $stdClassResp->headers->server,
            'access_control_allow_origin' => $stdClassResp->headers->$accessorigin, 'headers_id' => $idReqResponse]
          );
          //insere informações na tabela routes
          DB::table('route')->insert(
            ['created_at' => $stdClassRoute->created_at, 'hosts' => $stdClassRoute->hosts, 'route_id' => $stdClassRoute->id, 'methods' => $stdClassRoute->methods[0], 'path' => $stdClassRoute->paths[0], 'preserve_host' => $stdClassRoute->preserve_host, 'protocols' => $stdClassRoute->protocols[0],
            'regex_priority' => $stdClassRoute->regex_priority, 'service_id' => $stdClassRoute->service->id, 'strip_path' => $stdClassRoute->strip_path, 'updated_at' => $stdClassRoute->updated_at, 'request_id' => $idReq]
          );
          //insere informações na tabela service
          DB::table('servic')->insert(
            ['content_timeout' => $stdClassServ->connect_timeout, 'created_at' => $stdClassServ->created_at, 'host' => $stdClassServ->host, 'service_id' => $stdClassServ->id, 'name' => $stdClassServ->name, 'path' => $stdClassServ->path, 'port' => $stdClassServ->port, 'protocol' => $stdClassServ->protocol,
            'read_timeout' => $stdClassServ->read_timeout, 'retries' => $stdClassServ->retries, 'updated_at' => $stdClassServ->updated_at, 'write_timeout' => $stdClassServ->write_timeout, 'request_id' => $idReq]
          );
          //insere informações na tabela latencies
          DB::table('latencies')->insert(
            ['proxy' => $stdClassLat->proxy, 'kong' => $stdClassLat->kong, 'request_lat' => $stdClassLat->request, 'request_id' => $idReq]
          );
        }
        echo "Arquivo importado com sucesso!";
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
