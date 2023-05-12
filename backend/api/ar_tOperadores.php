<?php

require_once "../clases/clase_operadores.php";
//header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);
            
        if($_POST != NULL) {
            if(Operador::crear_operador($_POST['Op_Folio'],$_POST['Op_Nombre'],$_POST['Op_Clave_soldador'],$_POST['Op_Puesto'])){
                    
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
            // echo "i= " . $i . " " . $Garray_columnas[$i] . ' = ' . $Garray_datos[$i] . "\n";
            $i+=1;
        }
        if(isset($_GET[$Garray[0]])){
            if($Garray_datos[0]==""){
                echo "null";
            }else{
                echo json_encode(Operador::Leer_operador($Garray_datos[0]));
            }
        }//end if
        else {
            echo json_encode(Operador::Leer_operadores());
        }//end else

        break;

    case 'PUT':

        $_PUT=json_decode(file_get_contents('php://input'),true);
        //echo "get: ". $_GET['Us_ID'];
        //echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(Operador::actualizar_operador($_GET['Op_Folio'],$_PUT['Op_Nombre'],$_PUT['Op_Clave_soldador'],$_PUT['Op_Puesto'])) {
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

        if(isset($_GET['Op_Folio'])){
            if(Operador::borrar_operador($_GET['Op_Folio'])) {
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