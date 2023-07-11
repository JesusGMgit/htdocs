urlf_proyectos=direccion_pagina + "/backend/api/ar_tProyectos.php";
function obtener_proyectos(){
    //?solicitar datos de los proyectos
    fetch(urlf_proyectos).then(response => response.json())
            .then(data_proyectos => datos_p_fetch(data_proyectos))
            .catch(error => console.log(error))
        
        const datos_p_fetch=(data_proyectos)=>{

            var combobox_proyectos = `<option selected>SELECCIONE UNO</option>`;
            
            for(p_i=0;p_i<data_proyectos.length;p_i++)
            {
                combobox_proyectos +=`<option>${data_proyectos[p_i].Pro_OrdenTrabajo}</option>`;
            }
            
            document.getElementById('proyecto_combobox').innerHTML = combobox_proyectos;
            
        }
        data_proyectos=0;
}

function obtener_informacion_proyecto(){

    proyecto_eleccion=document.getElementById('proyecto_combobox').value;
    
    urlf_proyecto=urlf_proyectos+"?Pro_OrdenTrabajo="+proyecto_eleccion;
    console.log("OT: " + proyecto_eleccion + " link: " + urlf_proyecto);
    fetch(urlf_proyecto).then(response => response.json())
            .then(data_proyecto => datos_ep_fetch(data_proyecto))
            .catch(error => console.log(error))
        
        const datos_ep_fetch=(data_proyecto)=>{
            let informacion_de_proyecto=`   <label>Proyecto : ${data_proyecto[0].Pro_Nombre}</label>
                                            <label>Orden de Trabajo: ${data_proyecto[0].Pro_OrdenTrabajo}</label>
                                            <label>Especificacion: ${data_proyecto[0].Pro_Especificacion}</label>
                                            <label>Espesor: ${data_proyecto[0].Pro_Espesor}</label>
                                            <label>Diametro: ${data_proyecto[0].Pro_Diametro}</label>
                                            <label>Tipo de Alambre: ${data_proyecto[0].Pro_Alambre}</label>
                                            <label>Tipo de Fundente: ${data_proyecto[0].Pro_Fundente}</label>
                                            <label>WPS: ${data_proyecto[0].Pro_WPS}</label>`;
            
            document.getElementById('div-informacion-proyecto').innerHTML=informacion_de_proyecto;
            
        }
        data_proyecto=0;


}