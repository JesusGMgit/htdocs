<?php
 
require_once "../clases/clase_conexion.php";


class soldadura_interna{

//----------------------------- Create - funciones para crear registros en las tablas--------------------
    //metodo para crear registros de tuberia
    public static function crear_registro_tuberia_interna($tuberia_123,$Tin_ID_tubo,$Tin_No_tubo,$Tin_No_placa,
                                                          $Tin_ID_proyecto,$Tin_Lote_alambre,$Tin_Lote_fundente,
                                                          $Tin_FolioOperador,$Tin_Fecha,$Tin_Hora,$Tin_hora_db,
                                                          $Tin_Archivos_excel,$Tin_Observaciones) {
        $conexion_db =new Conexion();
        $query = "INSERT INTO " . $tuberia_123 . " (Tin_ID_tubo,Tin_No_tubo,Tin_No_placa,Tin_ID_proyecto,Tin_Lote_alambre,
                                                      Tin_Lote_fundente,Tin_FolioOperador,Tin_Fecha,Tin_Hora,Tin_hora_db,
                                                      Tin_Archivos_excel,Tin_Observaciones)
        VALUES ('$Tin_ID_tubo', '$Tin_No_tubo', '$Tin_No_placa', '$Tin_ID_proyecto','$Tin_Lote_alambre',
                '$Tin_Lote_fundente','$Tin_FolioOperador','$Tin_Fecha','$Tin_Hora','$Tin_hora_db','$Tin_Archivos_excel',
                '$Tin_Observaciones')";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            echo "Tubo No: " . $Tin_No_tubo . " fue registrado";
            return TRUE;
        }//end if
        return FALSE;
    }//end 

//----------------------------- Read - funciones para leer registros de las tablas--------------------
    //Metodos (funciones) por busqueda para de registros
    //funcion que realiza un consulta para obtener todos los resgistros de una tabla
    //las tablas son de la tuberia que pasa por las maquinas de soldadura interna
    public static function obtener_todos_registros_interna($tuberia_123){
        $conexion_db =new Conexion();
        $query = "SELECT *FROM ". $tuberia_123;
        //echo "request: " . $query;
        
        $resultado = $conexion_db->query($query);
        
        $datos_in = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos_in[]=[
                    'T_ID_Rtubo'=>$row['Tin_ID_Rtubo'],
                    'T_ID_tubo'=>$row['Tin_ID_tubo'],
                    'T_No_tubo'=>$row['Tin_No_tubo'],
                    'T_No_placa'=>$row['Tin_No_placa'],
                    'T_ID_proyecto'=>$row['Tin_ID_proyecto'],
                    'T_Lote_alambre'=>$row['Tin_Lote_alambre'],
                    'T_Lote_fundente'=>$row['Tin_Lote_fundente'],
                    'T_FolioOperador'=>$row['Tin_FolioOperador'],
                    'T_Fecha'=>$row['Tin_Fecha'],
                    'T_Hora'=>$row['Tin_Hora'],
                    'T_Hora_db'=>$row['Tin_Hora_db'],
                    'T_Archivos_excel'=>$row['Tin_Archivos_excel'],
                    'T_Observaciones'=>$row['Tin_Observaciones']
                ];
                
            }//end while
            return $datos_in;
            
        }//end if
        
    }//fin de leer registros de tabla
    
    
    //funcion que realiza una consulta de un registro de la tabla
    //esta consulta se pude de ser apartir del columna o campo con el valor correspondiente buscado
    public static function obtener_registros_interna_un_filtro($tuberia_123,$T_C_get,$T_D_get) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM ".  $tuberia_123." WHERE " . $T_C_get. "=\"" . $T_D_get . "\"";
        $resultado = $conexion_db->query($query);
        $datos_in = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos_in[]=[
                    'T_ID_Rtubo'=>$row['Tin_ID_Rtubo'],
                    'T_ID_tubo'=>$row['Tin_ID_tubo'],
                    'T_No_tubo'=>$row['Tin_No_tubo'],
                    'T_No_placa'=>$row['Tin_No_placa'],
                    'T_ID_proyecto'=>$row['Tin_ID_proyecto'],
                    'T_Lote_alambre'=>$row['Tin_Lote_alambre'],
                    'T_Lote_fundente'=>$row['Tin_Lote_fundente'],
                    'T_FolioOperador'=>$row['Tin_FolioOperador'],
                    'T_Fecha'=>$row['Tin_Fecha'],
                    'T_Hora'=>$row['Tin_Hora'],
                    'T_Hora_db'=>$row['Tin_Hora_db'],
                    'T_Archivos_excel'=>$row['Tin_Archivos_excel'],
                    'T_Observaciones'=>$row['Tin_Observaciones'],
                    'T_Reporte_excel'=>$row['Tin_Reporte_excel']
                ];
            }//end while
            return $datos_in;
        }//end if
    }//fin de consulta de un registro de tabla

    //lee el registro especificado apartir de dos columnas/campos especificos(en este caso No de tubo e Id de poyecto)
    public static function obtener_registros_interna_dos_filtros($tuberia_123, $T_C1, $T_D1, $T_C2, $T_D2){

        $conexion_db =new Conexion();
        $query = "SELECT *FROM ".  $tuberia_123." WHERE " . $T_C1 . "=\"" . $T_D1 . "\" AND "
                                                                . $T_C2 . "=\"" . $T_D2 . "\"";
            //echo "\n" . $query . "\n";
        $resultado = $conexion_db->query($query);
        $datos_in = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos_in[]=[
                    'T_ID_Rtubo'=>$row['Tin_ID_Rtubo'],
                    'T_ID_tubo'=>$row['Tin_ID_tubo'],
                    'T_No_tubo'=>$row['Tin_No_tubo'],
                    'T_No_placa'=>$row['Tin_No_placa'],
                    'T_ID_proyecto'=>$row['Tin_ID_proyecto'],
                    'T_Lote_alambre'=>$row['Tin_Lote_alambre'],
                    'T_Lote_fundente'=>$row['Tin_Lote_fundente'],
                    'T_FolioOperador'=>$row['Tin_FolioOperador'],
                    'T_Fecha'=>$row['Tin_Fecha'],
                    'T_Hora'=>$row['Tin_Hora'],
                    'T_Hora_db'=>$row['Tin_Hora_db'],
                    'T_Archivos_excel'=>$row['Tin_Archivos_excel'],
                    'T_Observaciones'=>$row['Tin_Observaciones'],
                    'T_Reporte_excel'=>$row['Tin_Reporte_excel']
                ];
            }//end while
            return $datos_in;
        }//end if
    }//fin de consulta de un registro de tabla

//----------------------------- Update- funciones para actualizar registros de las tablas--------------------
    //metodo para actualizar regsitro de tubo
    //actualiza un registro por medio de una consulta con los datos de dos campos o culumnas
    //y el valor corespondiente (id del registro de tubo y Id de proyecto(ya no incluido))
    public static function actualizar_unvalor_tubo_interna($tuberia_123,$T_Cb1,$T_Db1,$T_Ca,$T_Da) {
        $conexion_db = new Conexion(); 
        $query = "UPDATE " .$tuberia_123. " SET " . $T_Ca . "='" . $T_Da .
                    "' WHERE " . $T_Cb1 . "=\"" . $T_Db1 . "\"";
                                // AND "
                               //. $T_Cb2 . "=\"" . $T_Db2 . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end update_usuario

    public static function actualizar_todos_valores_tubo_interna($tuberia_123,$T_C,$T_D) {
        $datos= $T_C[2] . "='" . $T_D[2] . "', " . 
                $T_C[3] . "='" . $T_D[3] . "', " .
                $T_C[4] . "='" . $T_D[4] . "', " .
                $T_C[5] . "='" . $T_D[5] . "', " .
                $T_C[7] . "='" . $T_D[7] . "', " .
                $T_C[8] . "='" . $T_D[8] . "', " .
                $T_C[9] . "='" . $T_D[9] . "', " .
                $T_C[10] . "='" . $T_D[10] . "', " .
                $T_C[13] . "='" . $T_D[13] . "'";
   
        $conexion_db = new Conexion(); 
        $query = "UPDATE " .$tuberia_123. " SET " . $datos .
                 " WHERE " . $T_C[0] . "=\"" . $T_D[0] . "\" AND "
                 . $T_C[2] . "=\"" . $T_D[2] . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }

//----------------------------- Delete - funciones para eliminar registros de la tablas--------------------
    //metodo para borrar un registro de tubo
    //funcion que borra un registro por medio de una consulta con el dato de ID de tubo
    public static function borrar_tubo_interna($tuberia_123,$No_tubo) {
        $conexion_db = new Conexion();
        $query = "DELETE FROM " . $tuberia_123 . " WHERE Tin_No_tubo=\"" . $No_tubo . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end delete_usuario

}
?>