<?php

require_once "../clases/clase_soldadura_interna.php";
//header("Content-Type: application/json");
$Maquina="tuberia_soldadura_interna_2";

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);

        if($_POST != NULL) {
            if(isset($_POST['T_AID'])){
                
            }elseif(isset($_POST['T_ID_tubo'])){
                soldadura_interna::crear_registro_tuberia_interna($Maquina,$_POST['T_ID_tubo'],$_POST['T_No_tubo'],$_POST['T_No_placa'],
                                        $_POST['T_ID_proyecto'],$_POST['T_Lote_alambre'],$_POST['T_Lote_fundente'],$_POST['T_FolioOperador']
                                        ,$_POST['T_Fecha'],$_POST['T_Hora'],$_POST['T_Hora_db'],$_POST['T_Archivos_excel']
                                        ,$_POST['T_Observaciones']);
                    
                http_response_code(200);
            }//end if
            else {
                http_response_code(400);
            }//end else
        }//end if
        else {
            http_response_code(405);
        }//end else
            
        break;

    case 'GET':
        $Garray_columnas= array();
        $Garray_datos=array();
        $Garray=array();
        $i=0;
        foreach($_GET as $key => $value) {
            $Garray[$i]=$key;
            $Garray_columnas[$i]=str_replace("T","Tin",$key);
            $Garray_datos[$i]=$_GET[$key];
            // $temporal=!$Garray_datos[$i] ;
            // echo $temporal . " i= " . $i . " " . $Garray_columnas[$i] . ' = ' . $Garray_datos[$i] . "\n";            
            $i+=1;
        }
        
        if(isset($Garray[0])){
            if($Garray_datos[0]==""){
                //respuesta si no se especifica el valor del campo que se hara la consulta
                echo "null";
            }
            elseif(isset($Garray_columnas[1])){
                if ($Garray_columnas[0]=="Tin_conteo")
                {
                    echo json_encode(soldadura_interna::conteo_tubos($Maquina,$Garray_columnas[1],$Garray_datos[1]));
                }
                else{
                    //entra en la funcion para obtner registros para dos filtros (dos campos)
                    echo json_encode(soldadura_interna::obtener_registros_interna_dos_filtros($Maquina,$Garray_columnas[0],$Garray_datos[0],
                                                                                              $Garray_columnas[1], $Garray_datos[1]));
                }
            }
            else{
                //entra en la funcion para obtener registros con un filtro(un campo)
                echo json_encode(soldadura_interna::obtener_registros_interna_un_filtro($Maquina,$Garray_columnas[0],$Garray_datos[0]));
            }
        }
        else {
            //echo "TODOS LOS REGISTROS DE TUBERIA EXTERNA 3";
            echo json_encode(soldadura_interna::obtener_todos_registros_interna($Maquina));
        }//end else

        break;

    case 'PUT':
        $array_columnas= array();
        $array_datos=array();
        $_PUT=json_decode(file_get_contents('php://input'),true);
        $i=0;
        if($_PUT != NULL) {
            foreach($_PUT as $key => $value) {
                $array_columnas[$i]=str_replace("T","Tin",$key);
                $array_datos[$i]=$_PUT[$key];
                //echo "i= " . $i . " " . $array_columnas[$i] . ' = ' . $array_datos[$i] . "\n";
                $i+=1;
            }
            if(isset($array_columnas[2]))
            {
                soldadura_interna::actualizar_todos_valores_tubo_interna($Maquina,$array_columnas,$array_datos);
            }
            elseif(soldadura_interna::actualizar_unvalor_tubo_interna($Maquina,$array_columnas[0],$array_datos[0],$array_columnas[1],$array_datos[1])){
                http_response_code(200);
            }
            else {
                http_response_code(400);
            }//end else
        }//end if
        else {
            http_response_code(405);
        }//end else

        break;

    case 'DELETE':

        if(isset($_GET['T_No_tubo'])){
            if(soldadura_interna::borrar_tubo_interna($Maquina,$_GET['T_No_tubo'])) {
                http_response_code(200);
            }//end if
            else {
                http_response_code(400);
            }//end else
        }//end if 
        else {
            http_response_code(405);
        }//end else

        break;

    default:

        http_response_code(405);

        break;

}//end while
?>