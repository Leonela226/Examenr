<?php
namespace Controllers\Examen;

use Controllers\PublicController;
use Dao\Examen\Vehiculo;
use Utilities\Site;
use Views\Renderer;

class VehiculoList extends PublicController{
    public function run(): void
    {

        $dataView =[];
        $dataView["vehiculo"] = Vehiculo::obtenerVehiculo();
        $dataView["canView"] = ("vehiculolist-dsp");
        $dataView["canEdit"] =("vehiculolist-upd");
        $dataView["canInsert"] = ("vehiculolist-ins");
        $dataView["canDelete"] =("vehiculolist-del");
        $dataView["canActions"] = ("vehiculolist-actions");
      
        Site::addLink('public/css/vehiculolist.css');

        Renderer::render('examen/vehiculolist', $dataView);
    }
}