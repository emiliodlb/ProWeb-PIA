<?php

class Orden {

    private $IdOrden;
    private $TotalOrden;
    private $FechaOrden;
    private $IdMesa;
    private $IdEstatusOrden;

    public function __construct($IdOrden, $TotalOrden, $FechaOrden, $IdMesa, $IdEstatusOrden) {
        $this->IdOrden = $IdOrden;
        $this->TotalOrden = $TotalOrden;
        $this->FechaOrden = $FechaOrden;
        $this->IdMesa = $IdMesa;
        $this->IdEstatusOrden = $IdEstatusOrden;
    }

    //get
    public function getIdOrden() {
        return $this->IdOrden;
    }

    public function getTotalOrden() {
        return $this->TotalOrden;
    }

    public function getFechaOrden() {
        return $this->FechaOrden;
    }

    public function getIdMesa() {
        return $this->IdMesa;
    }

    public function getIdEstatusOrden() {
        return $this->IdEstatusOrden;
    }

    //set
    public function setTotalOrden($TotalOrden) {
        $this->TotalOrden = $TotalOrden;
    }

    public function setFechaOrden($FechaOrden) {
        $this->FechaOrden = $FechaOrden;
    }

    public function setIdMesa($IdMesa) {
        $this->IdMesa = $IdMesa;
    }

    public function setIdEstatusOrden($IdEstatusOrden) {
        $this->IdEstatusOrden = $IdEstatusOrden;
    }
}

?>
