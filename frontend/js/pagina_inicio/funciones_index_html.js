let carga_primera_vez=true

function inicio_pagina(){
    fecha_Actual();
    if(carga_primera_vez=true){
        document.getElementById('contenido-foto').style.display='none';
        document.getElementById('contenido-reporte-tubo').style.display='flex';
        document.getElementById('contenido-reportes-dia').style.display='none';
        document.getElementById('contenido-contador-tubos').style.display='none';
        document.getElementById('contenido-proyectos').style.display='none';
        carga_primera_vez=false;
    }
            
}


function mostrar_contenidos(letra){
    // console.log(letra);
    switch(letra){
        case 'a':
            document.getElementById('contenido-foto').style.display='flex';
            document.getElementById('contenido-reporte-tubo').style.display='none';
            document.getElementById('contenido-reportes-dia').style.display='none';
            document.getElementById('contenido-contador-tubos').style.display='none';
            document.getElementById('contenido-proyectos').style.display='none';
            break;
        case 'b':
            document.getElementById('contenido-foto').style.display='none';
            document.getElementById('contenido-reporte-tubo').style.display='flex';
            document.getElementById('contenido-reportes-dia').style.display='none';
            document.getElementById('contenido-contador-tubos').style.display='none';
            document.getElementById('contenido-proyectos').style.display='none';
            break;
        case 'c':
            contenido_reportes_dia();
            document.getElementById('contenido-foto').style.display='none';
            document.getElementById('contenido-reporte-tubo').style.display='none';
            document.getElementById('contenido-reportes-dia').style.display='grid';
            document.getElementById('contenido-contador-tubos').style.display='none';
            document.getElementById('contenido-proyectos').style.display='none';
            break;
        case 'd':
            contenido_conteo_dia();
            document.getElementById('contenido-foto').style.display='none';
            document.getElementById('contenido-reporte-tubo').style.display='none';
            document.getElementById('contenido-reportes-dia').style.display='none';
            document.getElementById('contenido-contador-tubos').style.display='grid';
            document.getElementById('contenido-proyectos').style.display='none';
            
            break;
        case 'e':
            document.getElementById('contenido-foto').style.display='none';
            document.getElementById('contenido-reporte-tubo').style.display='none';
            document.getElementById('contenido-reportes-dia').style.display='none';
            document.getElementById('contenido-contador-tubos').style.display='none';
            document.getElementById('contenido-proyectos').style.display='flex';
            obtener_proyectos();
            break;
    }
    
}

function contenido_reportes_dia(){
    let urlf_reportes;
    let maquina_reportes;
    const [fecha_array_contenido, hora_array_contenido]=obtener_fecha_hoy();
    for(i_reportes=1;i_reportes<=3;i_reportes++){
        urlf_reportes = direccion_pagina + "/backend/api/ar_tTuberiaInterna_"+i_reportes+".php?T_Fecha=" +fecha_array_contenido;
        maquina_reportes= "INTERNA"+ i_reportes.toString() ;
        // console.log("primera funcion: "+urlf_reportes+ " - "+ maquina_reportes);
        tabla_internas(urlf_reportes,maquina_reportes);
    }

    for(i_reportes=1;i_reportes<=3;i_reportes++){
        urlf_reportes = direccion_pagina + "/backend/api/ar_tTuberiaExterna_"+i_reportes+".php?T_Fecha=" +fecha_array_contenido;
        maquina_reportes= "EXTERNA"+ i_reportes.toString() ;
        console.log("primera funcion: "+urlf_reportes+ " - "+ maquina_reportes);
        tabla_externas(urlf_reportes,maquina_reportes);
    }
}

function contenido_conteo_dia(){
    let urlf_conteo;
    let maquina_conteo;
    const [fecha_contenido, hora_contenido]=obtener_fecha_hoy();

    for(i_conteo =1; i_conteo <=3; i_conteo++){
        urlf_conteo = direccion_pagina + "/backend/api/ar_tTuberiaInterna_"+i_conteo+".php?T_conteo=0&T_Fecha=" +fecha_contenido;
        console.log(urlf_conteo);
        maquina_conteo = "INTERNA"+ i_conteo.toString();
        mostrar_conteos_internas(urlf_conteo, maquina_conteo)
    }

    for(i_conteo =1; i_conteo <=3; i_conteo++){
        urlf_conteo = direccion_pagina + "/backend/api/ar_tTuberiaExterna_"+i_conteo+".php?T_conteo=0&T_Fecha=" +fecha_contenido;
        console.log(urlf_conteo);
        maquina_conteo = "EXTERNA"+ i_conteo.toString();
        mostrar_conteos_internas(urlf_conteo, maquina_conteo)
    }
}