function fecha_Actual(){
    let fecha_label=document.getElementById('fecha_actual');
    let hora_label=document.getElementById('hora_actual');
    fecha_label.innerHTML="";
    hora_label.innerHTML="";
    let fecha = new Date();
    let año = fecha.getFullYear();
    let mes = fecha.getMonth() + 1;
    let dia = fecha.getDate();
    let h = fecha.getHours();
    let m = fecha.getMinutes();
    let s = fecha.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    fecha_label.innerHTML ="Fecha: " + mes + "/" + dia + "/" + año;
    hora_label.innerHTML= "Hora: " + h + ":" + m + ":" + s;
    let t = setTimeout(fecha_Actual, 1000);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }