var busqueda_reporte_externas=0; 
var busqueda_reporte_internas=0;

// console.log("IP servidor: " + direccion_pagina);

function descarga_reportes(){
    document.getElementById('links_descarga').innerHTML="";
    No_tubo=document.getElementById("No_tubo").value;
    // console.log("No tubo: " + No_tubo);

    for(i=1;i<=3;i++){
        urlf = direccion_pagina + "/backend/api/ar_tTuberiaInterna_"+i+".php?T_No_tubo=" + No_tubo;
        tabla_internas_1(urlf,("INTERNA"+i));   
    }
    // if(busqueda_reporte_internas==0){
    //     let p_no_reporte=document.createElement('p');
    //     p_no_reporte.innerHTML='NO HAY REPORTE EN MAQUINAS INTERNAS';
    //     document.getElementById('links_descarga').appendChild(p_no_reporte);
    // }
    // console.log("bri: " + busqueda_reporte_internas);
    
    for(i=1;i<=3;i++){
        urlf = direccion_pagina + "/backend/api/ar_tTuberiaExterna_"+i+".php?T_No_tubo=" + No_tubo;
        tabla_externas_1(urlf,("EXTERNA"+i)); 
    }
    // if(busqueda_reporte_externas==0){
    //     let p_no_reporte=document.createElement('p');
    //     p_no_reporte.innerHTML='NO HAY REPORTE EN MAQUINAS EXTERNAS';
    //     document.getElementById('links_descarga').appendChild(p_no_reporte);
    // }
    // console.log("bre: " + busqueda_reporte_externas);
    
    busqueda_reporte_internas=0;
    busqueda_reporte_externas=0;
}


function tabla_externas_1(urlf,maquina_1){
    
    fetch(urlf).then(response => response.json())
            .then(data11 => datos11_fetch(data11))
            .catch(error => console.log(error))
        
        const datos11_fetch=(data11)=>{
            let maquina=maquina_1;
            try{
                nom_reporte=data11[0].T_Reporte_excel;
                
                if(nom_reporte!="" && busqueda_reporte_externas==0){
                    
                    ruta_reporte ="/Reportes/"+maquina+"/"+nom_reporte;
                    let informacion_tubo=`<label>No. de Tubo: ${data11[0].T_No_tubo}</label>
                                          <label>No. de Placa: ${data11[0].T_No_placa}</label>
                                          <label>Maquina: ${maquina}</label>
                                          <label>Fecha: ${data11[0].T_Fecha} --- Hora: ${data11[0].T_Hora}</label>
                                          <label>Folio Operador: ${data11[0].T_FolioOperador}</label>`;

                    var link_reporte=`<a href=${ruta_reporte}>Descargar Reporte : ${nom_reporte} </a>`;

                    let label_externas=document.createElement('label');
                    let div_informacion_tubo=document.createElement('div');

                    div_informacion_tubo.id="div_externas";
                    div_informacion_tubo.innerHTML=informacion_tubo;
                    label_externas.innerHTML=link_reporte;

                    document.getElementById('links_descarga').appendChild(div_informacion_tubo);
                    datos_operador(data11[0].T_FolioOperador, "div_externas");
                    document.getElementById('links_descarga').appendChild(label_externas);
                    console.log("encontrado en " + maquina);
                    busqueda_reporte_externas=1;
               
                }else{
                    busqueda_reporte_externas=0;
                }
            }catch{
                console.log("no encontrado en " + maquina);
            }
        

        }
        data11=0;
}

function tabla_internas_1(urlf,maquina_2){
    
    fetch(urlf).then(response => response.json())
            .then(data12 => datos12_fetch(data12))
            .catch(error => console.log(error))
        
        const datos12_fetch=(data12)=>{
            let maquina=maquina_2;
            try{
                nom_reporte=data12[0].T_Reporte_excel;
                if(nom_reporte!="" && busqueda_reporte_internas==0){
                    ruta_reporte ="/Reportes/"+maquina+"/"+nom_reporte;
                    let informacion_tubo=`<label>No. de Tubo: ${data12[0].T_No_tubo}</label>
                                          <label>No. de Placa: ${data12[0].T_No_placa}</label>
                                          <label>Maquina: ${maquina}</label>
                                          <label>Fecha: ${data12[0].T_Fecha} --- Hora: ${data12[0].T_Hora}</label>
                                          <label>Folio Operador: ${data12[0].T_FolioOperador}</label>`;
                 
                    var link_reporte=`<a href=${ruta_reporte}>Descargar Reporte : ${nom_reporte} </a>`;

                    let label_internas=document.createElement('label');
                    let div_informacion_tubo=document.createElement('div');

                    div_informacion_tubo.id="div_internas";
                    div_informacion_tubo.innerHTML=informacion_tubo;
                    label_internas.innerHTML=link_reporte;

                    document.getElementById('links_descarga').appendChild(div_informacion_tubo);
                    datos_operador(data12[0].T_FolioOperador, "div_internas");
                    document.getElementById('links_descarga').appendChild(label_internas);
                    console.log("encontrado en " + maquina);
                    busqueda_reporte_internas=1; 
                }else{
                    busqueda_reporte_internas=0;  
                }
            }catch{
            console.log("no encontrado en " + maquina);
            }
        }
        data12=0;
}


function datos_operador(Folio_Operador,div_inex){
    urlf_operador = direccion_pagina + "/backend/api/ar_tOperadores.php?Op_Folio=" + Folio_Operador;

    fetch(urlf_operador).then(response => response.json())
            .then(data_operador => datos_operador_fetch(data_operador))
            .catch(error => console.log(error))
        
        const datos_operador_fetch=(data_operador)=>{
            console.log(data_operador[0])
            let clave = data_operador[0].Op_Clave_soldador;
            // let p_clave=document.createElement('p');
            let label_clave =  document.createElement('label');
            label_clave.innerHTML=`<label>SC-${clave}</label>`;
            // p_clave.innerHTML=label_clave;
            document.getElementById(div_inex).appendChild(label_clave);
            // document.getElementById('links_descarga').appendChild(p_clave);
            
        }
        
        data_operador=0;
}

function informacion_tubo_reporte(No_tubo_i,No_placa_i,){
    
}