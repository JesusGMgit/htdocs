
function crear_tabla(maquina) {      
    //*crear cuepro de la tabla
    let table = document.createElement('table');
    let id_table="tabla_" + maquina;
    table.setAttribute("id",id_table);
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');
    table.appendChild(thead);
    table.appendChild(tbody);
    
    //*crear encabezado de tabla
    let encabezados=["No TUBO","REPORTE"]
    let fila_encabezados = document.createElement('tr');
    for(crear_i=0;crear_i<2;crear_i++){
        let cabezera = document.createElement('th');
        cabezera.innerHTML = encabezados[crear_i];
        fila_encabezados.appendChild(cabezera);
    }
    thead.appendChild(fila_encabezados);

    //*CARGAR EN PAGINA LOS ELEMENTOS
    tabla_maquina=document.getElementById(maquina);
    tabla_maquina.innerHTML="";
    tabla_maquina.appendChild(table);
    
}


function tabla_internas(urlf,maquina){
    crear_tabla(maquina);
    let id_tabla="tabla_" + maquina;
    //?solicitar datos de la maquina
    fetch(urlf).then(response => response.json())
            .then(data_in => datos1_fetch(data_in))
            .catch(error => console.log(error))
        
        const datos1_fetch=(data_in)=>{
            var tabla_a = "";
            
            if(data_in.length<=0)
            {
                tabla_a="no hay datos";
            }
            console.log("datos de "+ maquina+ ":"+data_in[0].T_No_tubo);
            for(in_i=0;in_i<data_in.length;in_i++)
            {
                tabla_a +=
                        `<tr>
                            <td>${data_in[in_i].T_No_tubo}</td>
                            <td>${data_in[in_i].T_Reporte_excel}</td>
                        </tr>`;
            }
            
            document.getElementById(id_tabla).innerHTML += tabla_a;
            
        }
        data_in=0;
}

function tabla_externas(urlf,maquina){
    crear_tabla(maquina);
    let id_tabla="tabla_" + maquina;
    fetch(urlf).then(response => response.json())
            .then(data => datos_fetch(data))
            .catch(error => console.log(error))
        
        const datos_fetch=(data)=>{
            var tabla_a = "";
            //console.log("no filas: "+data.length);
            if(data.length<=0)
            {
                tabla_a="no hay datos";
            }
            for(ex_i=0;ex_i<data.length;ex_i++)
            {
                tabla_a +=
                        `<tr>
                            <td>${data[ex_i].T_No_tubo}</td>
                            <td>${data[ex_i].T_Reporte_excel}</td>
                        </tr>`;
            }
            
            document.getElementById(id_tabla).innerHTML += tabla_a;
            
        }
        data=0;
}


