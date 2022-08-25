<?php

namespace App\Http\Controllers;

//use App\Models\Factura;
use Illuminate\Support\Facades\DB;
//use GuzzleHttp\Client;
//use Illuminate\Http\Request;
use Carbon\Carbon;


class FacturaController extends Controller
{
    //
    public function index(){


        //$feed = file_get_contents('/home/finn/Documents/noviembre-diciembre 2020/noviembre/CFDI_52A16C04-6D8A-492F-84C3-AB5D71332CB1_02_01_2021/0344a695-9e9d-4e5f-8207-355860ba193c.xml');
        

        //$xml = simplexml_load_string($feed);

        $xml = simplexml_load_file('/home/finn/Documents/noviembre-diciembre 2020/noviembre/CFDI_52A16C04-6D8A-492F-84C3-AB5D71332CB1_02_01_2021/0344a695-9e9d-4e5f-8207-355860ba193c.xml'); 
        
        $ns = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('c', $ns['cfdi']);
        $xml->registerXPathNamespace('t', $ns['tfd']);


        foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
            echo $tfd['SelloCFD']; 
            echo "<br />";
            //valor a registrar en la tabla facturas
            $fecha = $tfd['FechaTimbrado']; 
            echo "<br />"; 
            echo $tfd['UUID']; 
            echo "<br />";
            //valor a registrar en la tabla facturas
            $no_certificado = $tfd['NoCertificadoSAT']; 
            echo "<br />"; 
            echo $tfd['Version']; 
            echo "<br />"; 
            echo $tfd['SelloSAT']; 
         }

         
         
        //EMPIEZO A LEER LA INFORMACION DEL CFDI E IMPRIMIRLA 
        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){ 
              //echo $cfdiComprobante['version']; 
              //echo "<br />"; 
              echo $cfdiComprobante['Fecha']; 
              echo "<br />"; 
              //echo $cfdiComprobante['Sello']; 
              //echo "<br />"; 
              echo $cfdiComprobante['Total']; 
              echo "<br />"; 
              echo $cfdiComprobante['SubTotal']; 
              echo "<br />"; 
              echo $cfdiComprobante['Certificado']; 
              echo "<br />"; 
              echo $cfdiComprobante['FormaPago']; 
              echo "<br />"; 
              echo $cfdiComprobante['NoCertificado']; 
              echo "<br />"; 
              //echo $cfdiComprobante['TipoDeComprobante']; 
              //echo "<br />";
              
        } 
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){ 
           //echo $Emisor['rfc']; 
           //echo "<br />"; 
           echo $Emisor['Nombre']; 
           echo "<br />"; 
        } 
        /*foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor//cfdi:DomicilioFiscal') as $DomicilioFiscal){ 
           echo $DomicilioFiscal['pais']; 
           echo "<br />"; 
           echo $DomicilioFiscal['calle']; 
           echo "<br />"; 
           echo $DomicilioFiscal['estado']; 
           echo "<br />"; 
           echo $DomicilioFiscal['colonia']; 
           echo "<br />"; 
           echo $DomicilioFiscal['municipio']; 
           echo "<br />"; 
           echo $DomicilioFiscal['noExterior']; 
           echo "<br />"; 
           echo $DomicilioFiscal['codigoPostal']; 
           echo "<br />"; 
        } 
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor//cfdi:ExpedidoEn') as $ExpedidoEn){ 
           echo $ExpedidoEn['pais']; 
           echo "<br />"; 
           echo $ExpedidoEn['calle']; 
           echo "<br />"; 
           echo $ExpedidoEn['estado']; 
           echo "<br />"; 
           echo $ExpedidoEn['colonia']; 
           echo "<br />"; 
           echo $ExpedidoEn['noExterior']; 
           echo "<br />"; 
           echo $ExpedidoEn['codigoPostal']; 
           echo "<br />"; 
        } */
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){ 
           echo $Receptor['Rfc']; 
           echo "<br />"; 
           echo $Receptor['Nombre']; 
           echo "<br />"; 
        } /*
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor//cfdi:Domicilio') as $ReceptorDomicilio){ 
           echo $ReceptorDomicilio['pais']; 
           echo "<br />"; 
           echo $ReceptorDomicilio['calle']; 
           echo "<br />"; 
           echo $ReceptorDomicilio['estado']; 
           echo "<br />"; 
           echo $ReceptorDomicilio['colonia']; 
           echo "<br />"; 
           echo $ReceptorDomicilio['municipio']; 
           echo "<br />"; 
           echo $ReceptorDomicilio['noExterior']; 
           echo "<br />"; 
           echo $ReceptorDomicilio['noInterior']; 
           echo "<br />"; 
           echo $ReceptorDomicilio['codigoPostal']; 
           echo "<br />"; 
        } */
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto){ 
           echo "<br />"; 
           echo $Concepto['Unidad']; 
           echo "<br />"; 
           echo $Concepto['Importe']; 
           echo "<br />"; 
           echo $Concepto['Cantidad']; 
           echo "<br />"; 
           echo $Concepto['Descripcion']; 
           echo "<br />"; 
           echo $Concepto['ValorUnitario']; 
           echo "<br />";   
           echo "<br />"; 
        } 
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Impuestos//cfdi:Traslados//cfdi:Traslado') as $Traslado){ 
           echo $Traslado['TasaOCuota']; 
           echo "<br />"; 
           echo $Traslado['Importe']; 
           echo "<br />"; 
           echo $Traslado['Impuesto']; 
           echo "<br />";   
           echo "<br />"; 
        } 
         
        DB::table('facturas')->upsert([
            ['no_certificado' => $no_certificado,
            'fecha' => $fecha,
            'updated_at' => Carbon::now()
                ]
            //  si nombre ya existe solo actualizar updated_at
            ], ['no_certificado'], ['fecha','updated_at']
        );         

    }


}
