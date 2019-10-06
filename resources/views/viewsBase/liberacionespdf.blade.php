<!DOCTYPE html>
<html>
<head>
		@php
        setlocale (LC_TIME, "es_ES");
    @endphp
<style>
#caja {
	width: 100%;
	height: 50px;
}
#texto-uno {
	float: left;
	line-height: 10%;
}
#texto-dos {
	float: right;
	line-height: 20%;
}
</style>
</head>
<body background="{{ asset('argon') }}/img/brand/fondo.png">
<br><br><br><br><br><br><br><br>
<p align="right">Oaxaca de Ju&aacute;rez, Oax, a {{ strftime("%e-%b-%Y") }}
<br>
OFICIO No. CIDEP-660/2019
</p>
<br><br><br>
<p>A QUIEN CORRESPONDA:</p><br>
@yield('contenidoLiberacion')
<br><br>
<p align="center"> A&nbsp;T&nbsp;E&nbsp;N&nbsp;T&nbsp;A&nbsp;M&nbsp;E&nbsp;N&nbsp;T&nbsp;E <br>
<em><small>Excelencia en Educaci&oacute;n Tecnol&oacute;gica <br>
    “Tecnolog&iacute;a Propia e Independencia Econ&oacute;mica”</small></em>
</p>
<br><br><br>
<p align="center">JURADO</p>
<br><br><br><br>
<div id="caja">
<div id="texto-uno">
        LIC. JUANA ISABEL RAM&Iacute;REZ HERN&Aacute;NDEZ
</div>
<div id="texto-dos">
        DR. RAFAEL GABRIEL REYES MORALES
</div>
<br>
<div id="texto-uno">
        <small> JEFE DE LA DIVISI&Oacute;N DE ESTUDIOS PROFESIONALES
</div>
<div id="texto-dos">
        SUBDIRECTOR ACAD&Eacute;MICO</small>
</div>
</div>
</body> 
</html>