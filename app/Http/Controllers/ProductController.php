<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Brand;



class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        
        //se consultan las marcas que tienen productos registrados para el select por marca 
        $marcas = Brand::rightJoin('products', 'products.brands_id','=','brands.id')
        ->select('brands.name')
        ->distinct()->get();

        if (!empty($request->has('buscarSKU'))){
            $buscarSKU = $request->get('buscarSKU');

            //$products = Product::Where('sku', "like", '%'.$buscarSKU.'%')->paginate(10);
            $products = DB::table('products')
                            ->join('brands', 'products.brands_id', '=', 'brands.id')
                            ->where('sku', "like", '%'.$buscarSKU.'%')
                            ->select('products.id'
                                     ,'products.image_link'
                                     ,'products.sku'
                                     ,'products.title'
                                     ,'brands.name'
                                     ,'products.group_cva'
                                     ,'products.availability'
                                     ,'products.disponible')
                            ->paginate(10);

            return view("products.index", compact("products","marcas"));

        }elseif(!empty($request->has('marca'))){
            $marca = $request->get('marca');
            $products = DB::table('products')
                            ->join('brands', 'products.brands_id', '=', 'brands.id')
                            ->where('brands.name', "like", '%'.$marca.'%')
                            ->select('products.id'
                                     ,'products.image_link'
                                     ,'products.sku'
                                     ,'products.title'
                                     ,'brands.name'
                                     ,'products.group_cva'
                                     ,'products.availability'
                                     ,'products.disponible')
                            ->paginate(10);
            return view("products.index", compact("products","marcas"));
        }else{
            //$products = Product::where("disponible", ">=", 1)->paginate(10);

            $products = DB::table('products')
                            ->join('brands', 'products.brands_id', '=', 'brands.id')
                            ->where("products.disponible", ">=", 1)
                            ->select('products.id'
                                     ,'products.image_link'
                                     ,'products.sku'
                                     ,'products.title'
                                     ,'brands.name'
                                     ,'products.group_cva'
                                     ,'products.availability'
                                     ,'products.disponible')
                            ->paginate(10);

            
            
            return view("products.index", compact("products","marcas"));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        
        //cliente http
        $client = new Client();


        //peticion
        $response = $client->get('https://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?cliente=64302&marca=%&grupo=TARJETA%20MADRE&clave=%&codigo=%&tc=1&MonedaPesos=1&porcentaje=16');
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
                    ], ['sku'], ['disponible','disponible_cd', 'precio', 'moneda', 'updated_at']
                );
            }

            return view('products.create');
    
    
        }



        public function crear()
        {

            $product = new Product;
            $title = __('Crear producto');
            $textButton = __('Crear');
            $route = route('products.store');

            return view('products.crear', compact('title', 'textButton', 'route', 'product'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "sku" => "unique:products",
            "key_cva" => "string|max:20", 
            "title" => "string|max:140",
            "disponible" => "integer",
            "condicion"  => "string",
            "availability" => "string",
            "brands_id" => "integer",
            "google_product_category"  => "integer",
            "fb_product_category"  => "integer",
            "link" => "required|url",
            "image_link" => "required|url",
            "ficha_tecnica" => "string",
            "precio" => "numeric",
            "bonus" => "numeric",
            "sale_price" => "numeric",
            "price" => "numeric",
            

        ]);

        Product::create($request->only(
        "sku", 
        "key_cva", 
        "title", 
        "disponible", 
        "condicion", 
        "availability", 
        "brands_id",
        "google_product_category",
        "fb_product_category",
        "link",
        "image_link",
        "ficha_tecnica",
        "precio",
        "bonus",
        "sale_price",
        "price",
 
        ));

        return redirect(route("products.index"))
            ->with("Hecho!", __("¡Producto creado!"));

    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $update = true;
        $title = __("Editar producto");
        $textButton = __("Actualizar");
        $route = route("products.update", ["product" => $product]);
        return view("products.edit", compact("update", "title", "textButton", "route", "product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {


        $this->validate($request, [
            "sku". $product->id, 
            "key_cva", 
            "title", 
            "disponible", 
            "condicion", 
            "availability", 
            "brands_id",
            "google_product_category",
            "fb_product_category",
            "link",
            "image_link",
            "ficha_tecnica",
            "precio",
            "moneda",
            "iva",
            "total",
            "bonus",
            "price",
            "sale_price"
        ]);

        $product->fill($request->only(
            "sku", 
            "key_cva", 
            "title", 
            "disponible", 
            "condicion", 
            "availability", 
            "brands_id",
            "google_product_category",
            "fb_product_category",
            "link",
            "image_link",
            "ficha_tecnica",
            "precio",
            "moneda",
            "iva",
            "total",
            "bonus",
            "price",
            "sale_price"           
            ))->save();
        return back()->with("success", __("¡Producto actualizado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
        # code...
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    }

    
}
