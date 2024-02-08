<?php
 
require_once "../clases/clase_conexion.php";


class Ph_nomarch{
    
//-------------Funcion para crear registro en la tabla

    public static function crear_registro_nomarch_ph($Ph_Nombre,$Ph_Hora,$Ph_Fecha,$Ph_Fecha_db) {
        $conexion_db =new Conexion();
        $query = "INSERT INTO ph_nombres_archivos (Ph_Nombre, Ph_Hora, Ph_Fecha, Ph_Fecha_db)
        VALUES ('$Ph_Nombre', '$Ph_Hora', '$Ph_Fecha', '$Ph_Fecha_db')";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end create_usuario

//--------------Funciones para leer registros de tabla------------------
    public static function Leer_registros_nomarch_ph(){
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  ph_nombres_archivos";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Ph_Nombre'=>$row['Ph_Nombre'],
                    'Ph_Hora'=>$row['Ph_Hora'],
                    'Ph_Fecha'=>$row['Ph_Fecha'],
                    'Ph_Fecha_db'=>$row['Ph_Fecha_db']
                ];
            }//end while
            return $datos;
        }//end if
    }//end read_usuarios
    
    public static function Leer_registro_nomarch_ph($Ph_Nombre) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  ph_nombres_archivos WHERE Ph_Nombre=$Ph_Nombre";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Ph_Nombre'=>$row['Ph_Nombre'],
                    'Ph_Hora'=>$row['Ph_Hora'],
                    'Ph_Fecha'=>$row['Ph_Fecha'],
                    'Ph_Fecha_db'=>$row['Ph_Fecha_db']
                ];
            }//end while
            return $datos;
        }//end if
    }//end 

    public static function Leer_registro_1f_nomarch_ph($T_C_get,$T_D_get) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  ph_nombres_archivos WHERE " . $T_C_get. "=\"" . $T_D_get . "\"";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Ph_Nombre'=>$row['Ph_Nombre'],
                    'Ph_Hora'=>$row['Ph_Hora'],
                    'Ph_Fecha'=>$row['Ph_Fecha'],
                    'Ph_Fecha_db'=>$row['Ph_Fecha_db']
                ];
            }//end while
            return $datos;
        }//end if
    }//end read_usuario

//----------------------Funcion para actualizar un registro en la tabla
    public static function actualizar_registro_nomarch_ph($Ph_Nombre,$Ph_Hora,$Ph_Fecha,$Ph_Fecha_db) {
        $conexion_db = new Conexion();
        $query = "UPDATE ph_nombres_archivos SET 
                  Ph_Nombre='" . $Ph_Nombre . "', Ph_Hora='" . $Ph_Hora . "', Ph_Fecha='" . $Ph_Fecha . "', Ph_Fecha_db='" . $Ph_Fecha_db .
                  "' WHERE Op_Folio=" . $Ph_Nombre;
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end update_usuario

//-----------------------------Funcion para eliminar un registro de la tabla
    public static function borrar_registro_nomarch_ph($Ph_Nombre) {
        $conexion_db = new Conexion();
        $query = "DELETE FROM ph_nombres_archivos WHERE Ph_Nombre=$Ph_Nombre";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end delete_usuario

}
?>