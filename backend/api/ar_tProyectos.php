<?php
//editar para la tabla Proyectos
require_once "../clases/clase_proyecto.php";
//header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        // echo json_encode($_POST);
            
        if($_POST != NULL) {
            if(Proyecto::crear_proyecto($_POST['Pro_Nombre'],$_POST['Pro_Diametro'],$_POST['Pro_Espesor'],
                                        $_POST['Pro_Alambre'],$_POST['Pro_Fundente'],$_POST['Pro_OrdenTrabajo']
                                        ,$_POST['Pro_Especificacion'],$_POST['Pro_WPS'])){
                    
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
            // $temporal=!$Garray_datos[$i] ;
            //  echo $temporal . " i= " . $i . " " . $Garray_columnas[$i] . ' = ' . $Garray_datos[$i] . "\n";
            $i+=1;
        }
        if(isset($Garray_datos[0])){
            
            if($Garray_datos[0]==""){
                echo "null";
            }else{
                //obtener un regitro de la tabla proyectos )
                // echo json_encode(Proyecto::Leer_proyecto($Garray_datos[0]));
                echo json_encode(Proyecto::Leer_proyecto($Garray_columnas[0],$Garray_datos[0]));
            }
                
        }//end if
        else {
            //todos los registros de la tabla proyectos
            echo json_encode(Proyecto::Leer_proyectos());
        }//end else

        break;

    case 'PUT':

        $_PUT=json_decode(file_get_contents('php://input'),true);
        //echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(Proyecto::actualizar_proyecto($_PUT['Pro_ID'],$_PUT['Pro_Nombre'],$_PUT['Pro_Diametro'],$_PUT['Pro_Espesor'],
                                             $_PUT['Pro_Alambre'],$_PUT['Pro_Fundente'],$_PUT['Pro_OrdenTrabajo'],
                                             $_PUT['Pro_Especificacion'],$_PUT['Pro_WPS'])) {
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
        // echo $_GET['Pro_ID'];
        if(isset($_GET['Pro_ID'])){
            if(Proyecto::borrar_proyecto($_GET['Pro_ID'])) {
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