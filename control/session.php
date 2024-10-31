<?php 
 class Session {
 
    public function __construct() {
        session_start();
    }

    //getidUsuario().Devuelve el idUsuario logeado.
    public function getIdUsuario(){
        $usuario = null;
        if($this->validar()){
            $obj = new ABMUsuario();
            $param['idUsuario'] = $_SESSION['idUsuario'];
            $resultado = $obj->buscar($param);

            if(count($resultado) > 0){
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

    // getRol(). Devuelve el rol del rol  logeado.
    public function getRol(){
        $list_rol = null;
        if($this->validar()){
            $obj = new ABMUsuario();
             $param['idUsuario'] = $_SESSION['idUsuario'];
             $resultado = $obj->darRoles($param);
             
            if(count($resultado) > 0){
                $list_rol = $resultado;
            }
        }
        return $list_rol;
    }
        
    // Actualiza las variables de sesion con los valores ingresados.
    public function iniciar($nombreidUsuario ,$psw){
        $boolean = false;
        $obj = new ABMUsuario();
        $param['usnombre'] = $nombreidUsuario;
        $param['uspass'] = $psw;
        $param['usdeshabilitado'] ='0000-00-00 00:00:00';

        $resultado = $obj->buscar($param);
        if(count($resultado) > 0){
            $usuario = $resultado[0];
            $_SESSION['idUsuario'] = $usuario->getIdUsuario();
            $boolean = true;
        } else {
            $this->cerrar();
        }
        return $boolean;
    }
    
    
    // validar(). Valida si la sesion actual tiene idUsuario y password  validos. Devuelve true o false.
    // @param no hay
    //return boolean

    public function validar() {
    $boolean = false;
    $objUsuario = new abmUsuario();
    
    if ($this->activa()) {
        $usuarioSesion = $this->getIdUsuario();
        
        $arrayUsuarios = $objUsuario->buscar(['usNombre' => $usuarioSesion->getUsNombre()]);
        
        if (count($arrayUsuarios) > 0) {
            $objUsuario = $arrayUsuarios[0];
            if ($objUsuario->getUsPass() == $usuarioSesion->getUsPass()) {
                $boolean = true;
            }
        }
    }

    return $boolean;
}

   

    //activa(). Devuelve true o false si la sesion esta activa o no. 
    public function activa(){
        return session_status() == PHP_SESSION_ACTIVE;
    }

    //cerrar(). Cierra la sesion actual.
    public function cerrar(){
        session_destroy();
    }

}

