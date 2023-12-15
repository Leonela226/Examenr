<?php
namespace Controllers\Examen;

use Controllers\PublicController;
use Dao\Examen\Vehiculo as VehiculoDao;
use Utilities\Site;
use Utilities\Validators;
use Views\Renderer;

class VehiculoForm extends PublicController{

    private $mode = "INS";
    private $listUrl = "index.php?page=Examen_VehiculoList";
    private $viewData = [];
    private $error = [];
    private $modes = [
        "INS" => "Creando un nuevo vehiculo",
        "UPD" => "Editando el vehiculo %s (%s)",
        "DEL" => "Eliminando el vehiculo %s (%s)",
        "DSP" => "Detalle del vehiculo %s (%s)"
    ];

    private $Vehiculo = [
        "id_vehiculo" => -1,
        "marca" => "",
        "modelo" => "",
        "anio" => "",
        "kilometraje" => "",
        "id_estado" => "",
        "asignado" => ""
    ];

    public function run(): void
    {
        $this->init();
        if ($this->isPostBack()) {
            if ($this->validateFormData()) {
                $this->Vehiculo["marca"] = $_POST["marca"];
                $this->Vehiculo["modelo"] = $_POST["modelo"];
                $this->Vehiculo["anio"] = $_POST["anio"];
                $this->Vehiculo["kilometraje"] = $_POST["kilometraje"];
                $this->Vehiculo["id_estado"] = $_POST["id_estado"];
                $this->Vehiculo["asignado"] = $_POST["asignado"];
                $this->processAction();
            }
        }
        $this->prepareViewData();
        Site::addLink('public/css/vehiculolist.css');
        $this->render();
    }
    private function init()
    {
        if (isset($_GET["mode"])) {
            if (isset($this->modes[$_GET["mode"]])) {
                $this->mode = $_GET["mode"]; 


                if ($this->mode !== "INS") {
                    if (isset($_GET["id"])) {
                        $this->Vehiculo = VehiculoDao::obtenerVehiculoPorId(intval($_GET["id"]));
                    }
                }
            } else {
                $this->handleError("Error inesperado, no se encuentra la accion solicitada.");
            }
        } else {
            $this->handleError("Error, el programa fallo. Intente de nuevo.");
        }
    }

    private function processAction()
    {
        switch ($this->mode) {
            case 'INS':
                if (VehiculoDao::crearVehiculo(
                    $this->Vehiculo["marca"],
                    $this->Vehiculo["modelo"],
                    $this->Vehiculo["anio"],
                    $this->Vehiculo["kilometraje"],
                    $this->Vehiculo["id_estado"],
                    $this->Vehiculo["asignado"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Vehiculo agregado con exito.");
                }
                break;
            case 'UPD':
                if (VehiculoDao::actualizarVehiculo(
                    $this->Vehiculo["id_vehiculo"],
                    $this->Vehiculo["marca"],
                    $this->Vehiculo["modelo"],
                    $this->Vehiculo["anio"],
                    $this->Vehiculo["kilometraje"],
                    $this->Vehiculo["id_estado"],
                    $this->Vehiculo["asignado"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Vehiculo actualizado con exito.");
                }
                break;
            case 'DEL':
                if (VehiculoDao::deleteVehiculo(
                    $this->Vehiculo["id_vehiculo"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Vehiculo eliminado con exito.");
                }
                break;
        }
    }

    private function prepareViewData()
    {
        $this->viewData["mode"] = $this->mode;
        $this->viewData["vehiculo"] = $this->Vehiculo;
        if ($this->mode == "INS") {
            $this->viewData["modedsc"] = $this->modes[$this->mode];
        } else {
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->mode],
                $this->Vehiculo["marca"],
                $this->Vehiculo["id_vehiculo"]
            );
        }


        foreach ($this->error as $key => $error) {
            $this->viewData["vehiculo"][$key] = $error;
        }

        $this->viewData["readonly"] = in_array($this->mode, ["DSP", "DEL"]) ? 'readonly' : '';
        $this->viewData["showConfirm"] = $this->mode !== "DSP";
    }

    private function render()
    {
        Renderer::render("examen/vehiculoform", $this->viewData);
    }


    private function handleError($errMsg)
    {
        Site::redirectToWithMsg($this->listUrl, $errMsg);
    }


    private function validateFormData()
    {

        if (Validators::IsEmpty($_POST["marca"])) {
            $this->error["marca_error"] = "la marca del vehiculo es requerido.";
        }

        if (Validators::IsEmpty($_POST["modelo"])) {
            $this->error["modelo_error"] = "Elmodelo del vehiculo es requerido.";
        }

        if (Validators::IsEmpty($_POST["anio"])) {
            $this->error["anio_error"] = "El año del vehiculo es requerido.";
        }

        if (Validators::IsEmpty($_POST["kilometraje"])) {
            $this->error["kilometraje_error"] = "El kilometraje  es requerido.";
        }

        if (Validators::IsEmpty($_POST["asignado"])) {
            $this->error["asignado_error"] = "El asignado es requerido.";
        }

        return count($this->error) == 0;
    }

}

