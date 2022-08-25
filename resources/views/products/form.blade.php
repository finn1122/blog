        
        


        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ $route }}" method="POST" >
            @csrf
            @isset($update)
            @method("PUT")
          </div>

                
            @endisset
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white-400 sm:p-6 ">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="md:grid md:grid-cols-3 md:gap-6 col-span-6 sm:col-span-3 ">
                      <label for="sku" class="block text-sm font-medium text-gray-900">SKU</label>
                      <input type="text" name="sku" value="{{ old("sku") ?? $product->sku }}" autocomplete="given-name" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm ">
                      <p class="text-gray-600 text-xs italic">{{ __("SKU o Codigo del fabricante")}} </p>  
                        @error("sku")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-6">
                        <label for="title" class="block text-sm font-medium text-gray-900">Titulo</label>
                        <input type="text" name="title" value="{{ old("title") ?? $product->title }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                        <p class="text-gray-600 text-xs italic">{{ __("Titulo del producto")}} </p>
                        @error("title")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="disponible" class="block text-sm font-medium text-gray-900">Disponible</label>
                        <input type="text" name="disponible" value="{{ old("disponible") ?? $product->disponible }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                        <p class="text-gray-600 text-xs italic">{{ __("Piezas disponibles")}} </p>
                        @error("disponible")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3 select-auto">
                        <label for="availability" class="block text-sm font-medium text-gray-900">Availability</label>
                        <select class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-white-300 rounded-sm border" name="availability">
                            <option {{old('availability',$product->availability)=="in stock"? 'selected':''}}  value="in stock">in stock</option>
                            <option {{old('availability',$product->availability)=="out of stock"? 'selected':''}}  value="out of stock">out of stock</option>
                            <option {{old('availability',$product->availability)=="discontinued"? 'selected':''}}  value="discontinued">discontinued</option>
                         </select>
                        @error("availability")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="google_product_category" class="block text-sm font-medium text-gray-900">Google product category</label>
                        <input type="text" name="google_product_category" value="{{ old("google_product_category") ?? $product->google_product_category }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                        <p class="text-gray-600 text-xs italic">{{ __("Example: 279")}} </p>
                        @error("google_product_category")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="fb_product_category" class="block text-sm font-medium text-gray-900">Fb product category</label>
                        <input type="text" name="fb_product_category" value="{{ old("fb_product_category") ?? $product->fb_product_category }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                        <p class="text-gray-600 text-xs italic">{{ __("Example: 229")}} </p>
                        @error("fb_product_category")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="brands_id" class="block text-sm font-medium text-gray-900">Brands ID</label>
                        <input type="text" name="brands_id" value="{{ old("brands_id") ?? $product->brands_id }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                        
                        @error("brands_id")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="condicion" class="block text-sm font-medium text-gray-900">Condición</label>
                        <select class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-white-300 rounded-sm border" name="condicion">
                                <option {{old('condicion',$product->condicion)=="in stock"? 'selected':''}}  value="new">New</option>
                                <option {{old('condicion',$product->condicion)=="out of stock"? 'selected':''}}  value="refurbished">Reacondicionado</option>
                                <option {{old('condicion',$product->condicion)=="discontinued"? 'selected':''}}  value="used">Usado</option>
                        </select>
                    </div>

                    

                    <div class="col-span-6 sm:col-span-6">
                        <label for="link" class="block text-sm font-medium text-gray-900">Shop link</label>
                        <input type="url" name="link" value="{{ old("link") ?? $product->link }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                        <p class="text-gray-600 text-xs italic">{{ __("Ejemplo: www.imagen.com/imagen.jpg")}} </p>
                        @error("link")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-6">
                        <label for="image_link" class="block text-sm font-medium text-gray-900">URL imagen principal</label>
                        <input type="url" name="image_link" value="{{ old("image_link") ?? $product->image_link }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                        <p class="text-gray-600 text-xs italic">{{ __("Ejemplo: https://www.facebook.com/SMARTICSOaxaca/shop")}} </p>
                        @error("image_link")
                        <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                                {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="col-span-6 sm:col-span-6">
                        <label for="about" class="block text-sm font-medium text-gray-700">
                          Ficha tecnica
                        </label>
                        <div class="mt-1">
                       
                            <textarea name="ficha_tecnica" class=" shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" name="ficha_tecnica">{{ old("ficha_tecnica") ?? $product->ficha_tecnica }}</textarea>
                            <p class="text-gray-600 text-xs italic">{{ __("Ficha tecnica del producto") }}</p>
                            @error("ficha_tecnica")
                            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    
                    </div>

                    <div class="col-span-6 sm:col-span-1">
                      <label for="precio" class="block text-sm font-medium text-gray-900">Precio neto</label>
                      <input type="int" name="precio" value="{{ old("precio") ?? $product->precio }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                      <p class="text-gray-600 text-xs italic">{{ __("Example: 279")}} </p>
                      @error("precio")
                      <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                              {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-1">
                      <label for="bonus" class="block text-sm font-medium text-gray-900">Bonus</label>
                      <input type="int" name="bonus" value="{{ old("bonus") ?? $bonus = ($product->sale_price - $product->precio) }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                      <p class="text-gray-600 text-xs italic">{{ __("Example: 279")}} </p>
                      @error("bonus")
                      <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                              {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                      <label for="price" class="block text-sm font-medium text-gray-900">Price</label>
                      <input type="int" name="price" value="{{ old("price") ?? $product->sale_price + 50 }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                      <p class="text-gray-600 text-xs italic">{{ __("Example: 279")}} </p>
                      @error("price")
                      <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                              {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                      <label for="sale_price" class="block text-sm font-medium text-gray-900">Sale price</label>
                      <input type="int" name="sale_price" value="{{ old("sale_price") ?? $product->sale_price }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-sm border">
                      <p class="text-gray-600 text-xs italic">{{ __("Example: 279")}} </p>
                      @error("sale_price")
                      <div class="border dorder-red-400 rounded-b bg-red-100 ,t-1 px-4 py-3 text-red-700">
                              {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ $textButton }}
                  </button>
                </div>
              </div>
            </form>

        
      

