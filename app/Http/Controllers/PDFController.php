<? php

namespace App\Http\Controllers;
use App\Charts\ParkingQtdChart;
use App\Models\Parking;
use Illuminate \Http\Request ; 
use PDF ;

  

classe PDFController estende Controller   

{

    /**

     * Exibir uma lista do recurso.

     *

     * @return \Illuminate\Http\Response

     */

    função pública gerarPDF () 

    {

        $data = [ 'title' => 'Bem-vindo ao ItSolutionStuff.com' ];   

        $pdf = PDF :: loadView ( 'myPDF' , $data );

  

        retornar $pdf -> download ( 'itsolutionstuff.pdf' );

    }

}