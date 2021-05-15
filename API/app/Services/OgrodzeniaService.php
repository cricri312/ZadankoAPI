<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
 class OgrodzeniaService{

    public function handleCalcPanelsAndPales(&$req)
    {
        $width = $req['width'];
        $panelQuantity=ceil($width/2.5);
        $paleQuantity=$panelQuantity+1;
        return [$panelQuantity,$paleQuantity];
    }
    public function handleIfPanelAndPalesIsInStock($PanelQuantity,$PaleQuantity)
    {
        $ogrodzenia=DB::table('ogrodzenias')->first();
        if($PanelQuantity>$ogrodzenia->panelQuantity && $PaleQuantity>$ogrodzenia->paleQuantity) return response("Not enough Panel and Pale");
        else if($PanelQuantity>$ogrodzenia->panelQuantity) return response("Not enough Panel");
        else if($PaleQuantity>$ogrodzenia->paleQuantity) return response("Not enough Pale");
        else return response("All done");
    }
 }