@extends('layouts.app')

@section('content')


        <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
            <div class="text-center">
                <h1 class="mb-5">{{ __("Listado de productos") }}</h1>
                <a href="{{ route("products.crear") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    {{ __("Crear producto") }}
                </a>
            </div>
        </div>
        <br>
	
        <div class="mb-4 flex justify-between items-center">
			<div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <form>
					<input type="search" name="buscarSKU"
						class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
						placeholder="Buscar por SKU" value="{{ $buscarSKU ?? ''}}">
                    </form>
				</div>
			</div>
			<div>
                <div class="relative md:w-3/3">
                    <form class="form-inline">
                        <select name="buscarMarca" id="buscarMarca" class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                            
                            
                            @forelse($marcas as $marca)
                                                      
                            <option value="{{ $marca->name}}"> {{ $marca->name ?? ''}}</option>
                            
                            @empty
                            @endforelse
                            
                        </select>
                        
                    </form>
                        
                </div>					
			</div>
        </div>
             
        
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table name="example" id="example" class="min-w-full divide-y divide-gray-200 table-auto">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Producto
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Marca
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Disponible
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    @forelse($products as $product)
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                        <img class="object-contain md:object-scale-down" src="{{ $product->image_link }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $product->sku }}
                                        </div>
                                        <div class="text-sm text-gray-500 overflow-ellipsis overflow-hidden ...">
                                            {{ $product->title }}
                                        </div>
                                        </div>
                                    </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $product->group_cva }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $product->availability }}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->disponible }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route("products.edit", ["product" => $product->id]) }}" class="text-blue-400">{{ __("Editar") }}</a>
                                        <p>
                                        <a
                                            href="#"
                                            class="text-red-400"
                                            onclick=".preventDefault();
                                                document.getElementById('delete-project-{{ $product->id }}--form').submit();"
                                                >{{ __("Eliminar")}}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
            

            @if($products->count() ?? '')
                <div class="mt-3">
                    {{ $products->links() }}
                </div>
            @endif
        
@endsection


@section('js')
    <script>
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            "ajax": "data/arrays.txt",
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": "<button>Click!</button>"
            } ]
        } );
    
        $('#example tbody').on( 'click', 'button', function () {
            var data = table.row( $(this).parents('tr') ).data();
            alert( data[0] +"'s salary is: "+ data[ 5 ] );
        } );
    } );

    </script>
@endsection
            


