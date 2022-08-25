<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;





use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){

        //cliente http
        $client = new Client();


        //peticion
        $response = $client->get('http://www.grupocva.com/catalogo_clientes_xml/marcas2.xml');

        //convertir a array la respuesta
        $xml = simplexml_load_string($response->getBody()->getContents());


        //recorrer array
        foreach($xml as $item){ 

                
                //insertar o actualizar en la bd 
                DB::table('brands')->upsert([
                    [
                        'name' => $item->descripcion,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                        ]
                    //  si nombre ya existe solo actualizar updated_at
                    ], ['name'], ['updated_at']
                );


        }


    }
}
