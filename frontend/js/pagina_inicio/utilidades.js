let direccion_pagina="http://10.10.20.15";
let segundos_para_actualizar_conteo=0;
function fecha_Actual(){
    let fecha_label=document.getElementById('fecha_actual');
    let hora_label=document.getElementById('hora_actual');
    fecha_label.innerHTML="";
    hora_label.innerHTML="";
    const [fecha_array, hora_array]=obtener_fecha_hoy();
    fecha_label.innerHTML ="Fecha: " + fecha_array;
    hora_label.innerHTML= "Hora: " + hora_array;
    segundos_para_actualizar_conteo=segundos_para_actualizar_conteo + 1;
    if((contenido_conteo_dia_bol==true) && (segundos_para_actualizar_conteo == 300)){
        //console.log("segundos + retraso= " + segundos_para_actualizar_conteo);
        segundos_para_actualizar_conteo=0;
        contenido_conteo_dia();
        
    }
    let t = setTimeout(fecha_Actual, 1000);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }

function obtener_fecha_hoy(){
    let fecha = new Date();
    let año = fecha.getFullYear();
    let mes = fecha.getMonth() + 1;
    let dia = fecha.getDate();
    let h = fecha.getHours();
    let m = fecha.getMinutes();
    let s = fecha.getSeconds();
    mes=checkTime(mes);
    dia=checkTime(dia);
    m = checkTime(m);
    s = checkTime(s);
    let fecha_funcion=dia + "/" + mes + "/" + año;
    let hora_funcion=h + ":" + m + ":" + s;
    return [fecha_funcion, hora_funcion];
}