<?php

class Producto {

    private $IdProducto;
    private $NombreProducto;
    private $DescripcionProducto;
    private $PrecioProducto;

    public function __construct($IdProducto, $NombreProducto, $DescripcionProducto, $PrecioProducto) {
        $this->IdProducto = $IdProducto;
        $this->NombreProducto = $NombreProducto;
        $this->DescripcionProducto = $DescripcionProducto;
        $this->PrecioProducto = $PrecioProducto;
    }

    //get
    public function getIdProducto() {
        return $this->IdProducto;
    }

    public function getNombreProducto() {
        return $this->NombreProducto;
    }

    public function getDescripcionProducto() {
        return $this->DescripcionProducto;
    }

    public function getPrecioProducto() {
        return $this->PrecioProducto;
    }

    //set
    public function setNombreProducto($NombreProducto) {
        $this->NombreProducto = $NombreProducto;
    }

    public function setDescripcionProducto($DescripcionProducto) {
        $this->DescripcionProducto = $DescripcionProducto;
    }

    public function setPrecioProducto($PrecioProducto) {
        $this->PrecioProducto = $PrecioProducto;
    }
}

?>
