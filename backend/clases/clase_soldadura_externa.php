<?php
 
require_once "../clases/clase_conexion.php";


class soldadura_externa{
    
    

    public static function crear_registro_tuberia_externa($tuberia_ex123,$Tex_ID_tubo,$Tex_No_tubo,$Tex_No_placa,
                                                          $Tex_ID_proyecto,$Tex_Lote_alambre,$Tex_Lote_fundente,
                                                          $Tex_FolioOperador,$Tex_Fecha,$Tex_Hora,$Tex_hora_db,
                                                          $Tex_Archivos_excel,$Tex_Observaciones) {
        $conexion_db =new Conexion();
        $query = "INSERT INTO " . $tuberia_ex123 . " (Tex_ID_tubo,Tex_No_tubo,Tex_No_placa,Tex_ID_proyecto,Tex_Lote_alambre,
                                                      Tex_Lote_fundente,Tex_FolioOperador,Tex_Fecha,Tex_Hora,Tex_hora_db,
                                                      Tex_Archivos_excel,Tex_Observaciones)
        VALUES ('$Tex_ID_tubo', '$Tex_No_tubo', '$Tex_No_placa', '$Tex_ID_proyecto','$Tex_Lote_alambre',
                '$Tex_Lote_fundente','$Tex_FolioOperador','$Tex_Fecha','$Tex_Hora','$Tex_hora_db','$Tex_Archivos_excel',
                '$Tex_Observaciones')";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end create_usuario

    public static function actualizar_RID_tubo($tuberia_ex123,$ID,$RID){
        $conexion_db=new Conexion();
        $query="UPDATE " . $tuberia_ex123 . " SET Tex_ID_Rtubo='" . $RID . "' WHERE Tex_ID_tubo=\"" . $ID . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;

    }

    //Metodos (funciones) para busqueda de registros
    //funcion que realiza un consulta para obtener todos los resgistros de una tabla
    //las tablas son de la tuberia que pasa por las maquinas de soldadura externa
    public static function obtener_todos_registros_externa($tuberia_ex123){
        $conexion_db =new Conexion();
        $query = "SELECT *FROM ". $tuberia_ex123;
        //echo "request: " . $query;
        
        $resultado = $conexion_db->query($query);
        
        $datos_in = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos_in[]=[
                    'T_ID_Rtubo'=>$row['Tex_ID_Rtubo'],
                    'T_ID_tubo'=>$row['Tex_ID_tubo'],
                    'T_No_tubo'=>$row['Tex_No_tubo'],
                    'T_No_placa'=>$row['Tex_No_placa'],
                    'T_ID_proyecto'=>$row['Tex_ID_proyecto'],
                    'T_Lote_alambre'=>$row['Tex_Lote_alambre'],
                    'T_Lote_fundente'=>$row['Tex_Lote_fundente'],
                    'T_FolioOperador'=>$row['Tex_FolioOperador'],
                    'T_Fecha'=>$row['Tex_Fecha'],
                    'T_Hora'=>$row['Tex_Hora'],
                    'T_Hora_db'=>$row['Tex_Hora_db'],
                    'T_Archivos_excel'=>$row['Tex_Archivos_excel'],
                    'T_Observaciones'=>$row['Tex_Observaciones']
                ];
                
            }//end while
            return $datos_in;
            
        }//end if
        
    }//fin de leer registros de tabla
    
    //funcion que realiza una consulta de un registro de la tabla
    //esta consulta se pude de ser apartir del columna o campo con el valor correspondiente buscado
    public static function obtener_registros_externa($tuberia_ex123,$T_C_get,$T_D_get) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM ".  $tuberia_ex123." WHERE " . $T_C_get. "=\"" . $T_D_get . "\"";
        $resultado = $conexion_db->query($query);
        $datos_in = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos_in[]=[
                    'T_ID_Rtubo'=>$row['Tex_ID_Rtubo'],
                    'T_ID_tubo'=>$row['Tex_ID_tubo'],
                    'T_No_tubo'=>$row['Tex_No_tubo'],
                    'T_No_placa'=>$row['Tex_No_placa'],
                    'T_ID_proyecto'=>$row['Tex_ID_proyecto'],
                    'T_Lote_alambre'=>$row['Tex_Lote_alambre'],
                    'T_Lote_fundente'=>$row['Tex_Lote_fundente'],
                    'T_FolioOperador'=>$row['Tex_FolioOperador'],
                    'T_Fecha'=>$row['Tex_Fecha'],
                    'T_Hora'=>$row['Tex_Hora'],
                    'T_Hora_db'=>$row['Tex_Hora_db'],
                    'T_Archivos_excel'=>$row['Tex_Archivos_excel'],
                    'T_Observaciones'=>$row['Tex_Observaciones'],
                    'T_Reporte_excel'=>$row['Tex_Reporte_excel']
                ];
            }//end while
            return $datos_in;
        }//end if
    }//fin de consulta de un registro de tabla

    //metodo para actualizar regsitro de tubo
    //actualiza un registro por medio de una consulta con los datos del campo o culumna 
    //y el valor corespondiente
    public static function actualizar_tubo_externa($tuberia_ex123,$T_Cbusqueda,$T_Dbusqueda,$T_Cactualizar,$T_Dactualizar) {
        $conexion_db = new Conexion(); 
        $query = "UPDATE " .$tuberia_ex123. " SET " . $T_Cactualizar . "='" . $T_Dactualizar .
                    "' WHERE " . $T_Cbusqueda . "=\"" . $T_Dbusqueda . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end update_usuario

    //metodo para borrar un registro de tubo
    //funcion que borra un registro por medio de una consulta con el dato de ID de tubo
    public static function borrar_tubo_externa($tuberia_ex123,$No_tubo) {
        $conexion_db = new Conexion();
        $query = "DELETE FROM " . $tuberia_ex123 . " WHERE Tex_No_tubo=\"" . $No_tubo . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end delete_usuario

}
?>