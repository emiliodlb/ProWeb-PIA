<?php

class MesaDisponible {

    private $idUsuario;
    private $NombreUsuario;
    private $TelefonoUsuario;
    private $LugarMesa;
    private $EspacioMesa;
    private $DisponibilidadMesa;
    private $MesaUsuario;
    private $IdRol;

    public function __construct($idUsuario, $NombreUsuario, $TelefonoUsuario, $LugarMesa, $EspacioMesa, $DisponibilidadMesa, $MesaUsuario, $IdRol) {
        $this->idUsuario = $idUsuario;
        $this->NombreUsuario = $NombreUsuario;
        $this->TelefonoUsuario = $TelefonoUsuario;
        $this->LugarMesa = $LugarMesa;
        $this->EspacioMesa = $EspacioMesa;
        $this->DisponibilidadMesa = $DisponibilidadMesa;
        $this->MesaUsuario = $MesaUsuario;
        $this->IdRol = $IdRol;
    }

    // Getters
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNombreUsuario() {
        return $this->NombreUsuario;
    }

    public function getTelefonoUsuario() {
        return $this->TelefonoUsuario;
    }

    public function getLugarMesa() {
        return $this->LugarMesa;
    }

    public function getEspacioMesa() {
        return $this->EspacioMesa;
    }

    public function getDisponibilidadMesa() {
        return $this->DisponibilidadMesa;
    }

    public function getMesaUsuario() {
        return $this->MesaUsuario;
    }

    public function getIdRol() {
        return $this->IdRol;
    }

    // Setters
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setNombreUsuario($NombreUsuario) {
        $this->NombreUsuario = $NombreUsuario;
    }

    public function setTelefonoUsuario($TelefonoUsuario) {
        $this->TelefonoUsuario = $TelefonoUsuario;
    }

    public function setLugarMesa($LugarMesa) {
        $this->LugarMesa = $LugarMesa;
    }

    public function setEspacioMesa($EspacioMesa) {
        $this->EspacioMesa = $EspacioMesa;
    }

    public function setDisponibilidadMesa($DisponibilidadMesa) {
        $this->DisponibilidadMesa = $DisponibilidadMesa;
    }

    public function setMesaUsuario($MesaUsuario) {
        $this->MesaUsuario = $MesaUsuario;
    }

    public function setIdRol($IdRol) {
        $this->IdRol = $IdRol;
    }
}

?>