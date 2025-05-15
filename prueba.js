// para insertar datos en entradas y detalles entrada, necesitan mandar un formulario con los siguientes datos:

// url de envio: ?c=Entradas&a=procesarEntradaConDetalles

// id_proveedor
// numero_de_lote
// fecha_ingreso
// precio_compra
// id_insumo4
// fecha_vencimiento
// precio
// cantidad_entrante
// estado


//un ejemplo seria:

// id_proveedor=1
// numero_de_lote=5844668  
// fecha_ingreso=2025-04-19
// precio_compra=58
// id_insumo=1
// fecha_vencimiento=2025-04-15
// precio=25
// cantidad_entrante=85
// estado=0


// para consultar entradas serian:

// ?c=Entradas&a=getDetalles  y por post mandar parametro, en este caso el modelo espera el id_entrada para filtrar, de no pasarlo, manda todo lo q haya en detalles_entrada

// ?c=Entradas&a=getEntradas  espera por post parametros, los cuales son id_proveedor, numero_de_lote, id, de no pasarlos manda todo lo q haya en entradas


// para insertar datos en horarios necesitan mandar un formulario con los siguientes datos:
// url de envio: ?c=Horarios&a=procesarHorario

let object = {
    "id_personal": 1,
    "hora_entrada": "08:00:00",
    "hora_salida": "14:30:00",
    "dias": ["Lunes", "Martes", "Jueves"]
}

// los nombres de los meses deben estar bien escritos, con sus respectivos acentos y primera letra en mayuscula
// para verificar si se puede hacer una cita segun el horario del personal, se debe enviar el id_personal por post a la url:
//?c=Horario&a=estadoDoctor

// para buscar todos los horarios registrados se consulta a la url:    ?c=Horario&a=getTodos
// para consultar todos los horarios de un personal se consulta a la url:  ?c=Horario&a=getPersonal    y por post mandar el id_personal