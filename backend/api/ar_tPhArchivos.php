<?php

require_once "../clases/clase_PH.php";
//header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);
            
        if($_POST != NULL) {
            if(Ph_nomarch::crear_registro_nomarch_ph($_POST['Ph_Nombre'],$_POST['Ph_Hora'],$_POST['Ph_Fecha'],
                                        $_POST['Ph_Fecha_db'])){
                    
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
            $Garray_columnas[$i]=$key;
            $Garray_datos[$i]=$_GET[$key];
            // echo "i= " . $i . " " . $Garray_columnas[$i] . ' = ' . $Garray_datos[$i] . "\n";
            $i+=1;
        }
        if(isset($Garray_datos[0])){
            
            if($Garray_datos[0]==""){
                echo "null";
            }else{
                echo json_encode(Ph_nomarch::Leer_registro_1f_nomarch_ph($Garray_columnas[0],$Garray_datos[0]));
            }
            
        }//end if
        else {
            echo json_encode(Ph_nomarch::Leer_registros_nomarch_ph());
        }//end else

        break;

    case 'PUT':

        $_PUT=json_decode(file_get_contents('php://input'),true);
        //echo "get: ". $_GET['Us_ID'];
        //echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(Ph_nomarch::actualizar_registro_nomarch_ph($_PUT['Ph_Nombre'],$_PUT['Ph_Hora'],$_PUT['Ph_Fecha'],$_PUT['Ph_Fecha_db'])) {
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

    case 'DELETE':

        if(isset($_GET['Ph_Nombre'])){
            if(Ph_nomarch::borrar_registro_nomarch_ph($_GET['Ph_Nombre'])) {
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