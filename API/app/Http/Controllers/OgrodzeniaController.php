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
        abort_if(!$req['width'], 401, 'Sorry, you are not allowed to do this'); 
        if($req['width']<0) return response()->json(['message'=>'Warring not number value']);
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
