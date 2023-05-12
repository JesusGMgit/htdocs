<?php

require_once "../clases/clase_usuario.php";
//header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);
            
        if($_POST != NULL) {
            if(Usuario::crear_usuario($_POST["Us_Folio"],$_POST['Us_Usuario'],$_POST['Us_Puesto'],$_POST['Us_Contraseña'])){
                    
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
            if(isset($Garray_datos[0])){
            
                if($Garray_datos[0]==""){
                    echo "null";
                }else{
                    echo json_encode(Usuario::obtener_registro_usuario($Garray_datos[0]));
                }
                
            }//end if
            else{
                echo json_encode(Usuario::obtener_registros_usuarios());
            }
   

        break;

    case 'PUT':

        $_PUT=json_decode(file_get_contents('php://input'),true);
        //echo "get: ". $_GET['Us_ID'];
        //echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(Usuario::update_usuario($_GET['Us_ID'],$_PUT['Us_Usuario'],$_PUT['Us_Nivel'],$_PUT['Us_Contraseña'],$_PUT['Us_Descripcion'])) {
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

        if(isset($_GET['Us_ID'])){
            if(Usuario::delete_usuario($_GET['Us_ID'])) {
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