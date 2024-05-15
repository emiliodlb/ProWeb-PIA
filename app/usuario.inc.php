<?php

class usuario {

    private $IdUsuario;
    private $NombreUsuario;
    private $TelefonoUsuario;
    private $LugarMesa;
    private $EspacioMesa;
    private $DisponibilidadMesa;
    private $PasswordUsuario;
    private $IdRol;

    public function  __construct($IdUsuario, $NombreUsuario, $TelefonoUsuario, $LugarMesa, $EspacioMesa, $DisponibilidadMesa, $PasswordUsuario, $IdRol) {

        $this -> IdUsuario = $IdUsuario;
        $this -> NombreUsuario = $NombreUsuario;
        $this -> TelefonoUsuario = $TelefonoUsuario;
        $this -> LugarMesa = $LugarMesa;
        $this -> EspacioMesa = $EspacioMesa;
        $this -> DisponibilidadMesa = $DisponibilidadMesa;
        $this -> PasswordUsuario = $PasswordUsuario;
        $this -> IdRol = $IdRol;

    }

    public function getIdUsuario () {
        return $this -> IdUsuario;
    }
    public function getNombreUsuario () {
        return $this -> NombreUsuario;
    }
    public function getTelefonoUsuario () {
        return $this -> TelefonoUsuario;
    }
    public function getLugarMesa () {
        return $this -> LugarMesa;
    }
    public function getEspacioMesa () {
        return $this -> EspacioMesa;
    }
    public function getDisponibilidadMesa () {
        return $this -> DisponibilidadMesa;
    }
    public function getPasswordUsuario () {
        return $this -> PasswordUsuario;
    }
    public function getIdRol () {
        return $this -> IdRol;
    }

    public function setNombreUsuario($NombreUsuario) {
        $this -> NombreUsuario = $NombreUsuario;
    }
    public function setTelefonoUsuario($TelefonoUsuario) {
        $this -> TelefonoUsuario = $TelefonoUsuario;
    }
    public function setLugarMesa($LugarMesa) {
        $this -> LugarMesa = $LugarMesa;
    }
    public function setEspacioMesa($EspacioMesa) {
        $this -> EspacioMesa = $EspacioMesa;
    }
    public function setDisponibilidadMesa($DisponibilidadMesa) {
        $this -> DisponibilidadMesa = $DisponibilidadMesa;
    }
    public function setPasswordUsuario($PasswordUsuario) {
        $this -> PasswordUsuario = $PasswordUsuario;
    }
    public function setIdRol($IdRol) {
        $this -> IdRol = $IdRol;
    }
}

