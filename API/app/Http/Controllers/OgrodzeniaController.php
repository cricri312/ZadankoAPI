<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ogrodzenia;
use App\Services\OgrodzeniaService;
class OgrodzeniaController extends Controller
{
    //
    function getAll(){
        return Ogrodzenia::all();
    }

    function calcPanelsAndPales(OgrodzeniaService $ogrodzeniaService,Request $req)
    {   
        try {
            $calcAll=$ogrodzeniaService->handleCalcPanelsAndPales($req);
            $panelQuantity=$calcAll[0];
            $paleQuantity=$calcAll[1];
            $ifPanelAndPalesIsInStock=$ogrodzeniaService->handleIfPanelAndPalesIsInStock($panelQuantity,$paleQuantity);
            $json=json_encode(array('panelQuantity'=>$panelQuantity,'paleQuantity'=>$paleQuantity,'state'=>$ifPanelAndPalesIsInStock));
            return $json ;
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Warring not number value']);
        }
        
    }
}
