function crear_numero(maquina){
    //
    let id_div = "CONTEO-" + maquina;
    let div_conteo = document.getElementById(id_div);
    //crear labels para numero de tubos soldados
    let label_numero = document.createElement('label');
    let class_numero = "numero-conteo";
    let id_numero = "numero-" + maquina;
    label_numero.setAttribute('class', class_numero);
    label_numero.setAttribute('id', id_numero);

    div_conteo.innerHTML = '';
    div_conteo.appendChild(label_numero);

}

function mostrar_conteos_internas(urlf_conteo,maquina_conteo){

    crear_numero(maquina_conteo);
    fetch(urlf_conteo).then(response => response.json())
            .then(data_conteo_in => datos_conteo(data_conteo_in))
            .catch(error => console.log(error))
        
        const datos_conteo=(data_conteo_in)=>{
            var numero_in = "";
            let id_numero = "numero-" + maquina_conteo;
            if(data_conteo_in.length<=0)
            {
                numero_in="no hay datos";
                console.log("conteo: " + numero_in);
            }
            //console.log("datos de "+ maquina_conteo+ ":" + data_conteo_in[0].T_numero_tubos);
            numero_in = data_conteo_in[0].T_numero_tubos;
            document.getElementById(id_numero).innerHTML = numero_in;

        }
        data_conteo_in = 0;

}

function mostrar_conteos_internas(urlf_conteo,maquina_conteo){

    crear_numero(maquina_conteo);
    fetch(urlf_conteo).then(response => response.json())
            .then(data_conteo_ex => datos_conteo_ex(data_conteo_ex))
            .catch(error => console.log(error))
        
        const datos_conteo_ex=(data_conteo_ex)=>{
            var numero_ex = "";
            let id_numero = "numero-" + maquina_conteo;
            if(data_conteo_ex.length<=0)
            {
                numero_ex="no hay datos";
                console.log("conteo: " + numero_ex);
            }
            //console.log("datos de "+ maquina_conteo+ ":" + data_conteo_ex[0].T_numero_tubos);
            numero_ex = data_conteo_ex[0].T_numero_tubos;
            document.getElementById(id_numero).innerHTML = numero_ex;

        }
        data_conteo_ex = 0;

}