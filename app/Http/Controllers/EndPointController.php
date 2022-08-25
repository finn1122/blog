<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;




class EndPointController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /**$marcas = Brand::leftJoin('products', 'products.brands_id','=','brands.id')
                            ->select('brands.name')->distinct()->orderBy('brands.name','asc')
                            ->get();**/

        $marcas = DB::table('products')
                        ->join('brands', 'products.brands_id', '=', 'brands.id')
                        ->select('brands.name', 'brands.updated_at')->distinct()
                        ->get();


        $productosDisponibles = Product::where('disponible', 1)->count();




        return view('endpoint.index', compact("marcas"));
    }

    public function actualizar(Request $request){

        $marca = $request->get('endpoint');

        
        $client = new Client();


        //peticion
        $response = $client->get('https://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?cliente=64302&marca='.$marca.'&grupo=%25&clave=%25&codigo=%25&tc=1&MonedaPesos=1&porcentaje=16');
        //Para consultar productos por marca en pesos https://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?cliente=64302&marca=SEAGATE&grupo=%25&clave=%25&codigo=%25&tc=1&MonedaPesos=1&porcentaje=16

        //Para consultar grupo tarjetas de video en pesos https://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?cliente=64302&marca=%&grupo=VIDEO&clave=%&codigo=%&tc=1&MonedaPesos=1&porcentaje=16
        //convertir a array la respuesta
        $xml = simplexml_load_string($response->getBody()->getContents());


        //recorrer array
        foreach($xml as $item){


                $id = DB::table('brands')->where('name', $item->marca)->first();
                
                
                //insertar o actualizar en la bd 
                DB::table('products')->upsert([
                    ['sku' => $item->codigo_fabricante,
                    'key_cva' => $item->clave,
                    'title' => $item->descripcion,
                    'group_cva' => $item->grupo,                        
                    'brands_id' => $id->id,
                    'disponible' => $item->disponible,
                    'condicion' => 'new',
                    'availability' => 'in stock',
                    'google_product_category' => '279',
                    'fb_product_category' => '229',
                    'link' => 'https://www.facebook.com/SMARTICSOaxaca/shop',
                    'disponible_cd' => $item->disponibleCD,
                    'image_link' => $item->imagen,
                    'precio' => $item->precio,
                    'moneda' => $item->moneda,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                        ]
                    //  si nombre ya existe solo actualizar updated_at
                    ], ['sku'], ['moneda', 'disponible','disponible_cd', 'precio','updated_at']
                );
            }

            //actualizar fecha de ultima actualización en brands
            Brand::where('name', $marca)
                    ->update(['updated_at' => Carbon::now()]);

            
            $marcas = DB::table('products')
                    ->join('brands', 'products.brands_id', '=', 'brands.id')
                    ->select('brands.name', 'brands.updated_at')->distinct()
                    ->get();


            $productosDisponibles = Product::where('disponible', 1)->count();


            return view('endpoint.index', compact("marcas"));
    
    
        }

        
        

    
}
