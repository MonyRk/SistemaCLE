@extends('viewsBase.liberacionespdf')
@section('contenidoLiberacion')
@php
    setlocale (LC_TIME, "es_ES");
@endphp

<p align="justify">
        Por este conducto, los que suscriben, integrantes del Jurado para el proceso 
        de convalidaci&oacute;n de acreditaci&oacute;n de una lengua extranjera, hacen constar que el (la) 
        estudiante <strong> C. {{ $datosEstudiante[0]->ap_paterno }} @if ($datosEstudiante[0]->ap_materno!=null) {{ $datosEstudiante[0]->ap_materno }} @endif {{ $datosEstudiante[0]->nombres }}</strong>
        con n&uacute;mero de control <strong>{{ $datosEstudiante[0]->num_control }}</strong> de la carrera
        {{ $datosEstudiante[0]->carrera }} con clave del plan de estudios {{ $plan }} 
        acredit&oacute; por Examen de 4 habilidades alcanzando el nivel {{ $nivel }} en la Coordinaci&oacute;n 
        de Lenguas Extranjeras con n&uacute;mero de registro TecNM-SEV-DECyaD-PCLE-01/18-ITO-32.
    
</p>
<p align="justify"> Por lo anterior se considera que el (la) estudiante <strong>S&Iacute; CUMPLE</strong>, 
    con el requisito de lengua extranjera para efectos de titulaci&oacute;n en una licenciatura del 
    Sistema Nacional de Educaci&oacute;n Superior Tecnol&oacute;gica.</p>
   <p align="justify"> Se extiende la presente en la ciudad de Oaxaca de Ju&aacute;rez, Oax a los 
        {{ NumerosEnLetras::convertir(strftime("%d")) }} d&iacute;as del mes de {{ strftime("%B") }} 
        del año {{ NumerosEnLetras::convertir(strftime("%Y")) }}, a petici&oacute;n del (la) interesado (a).
@endsection