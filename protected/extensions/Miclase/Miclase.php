<?php

class Miclase {
    
    public $fecha;

    function __construct() {
        $this->fecha = '';
    }
    
    public function setHtml($param = "") {
        $this->fecha = $param? $param : "Ahora mismo ya esta creada la instancia en la cache, refresca";
    }
    
    public function getHtml() {
        return $this->fecha;
    }

}