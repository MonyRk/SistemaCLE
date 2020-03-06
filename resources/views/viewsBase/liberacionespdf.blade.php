<!DOCTYPE html>
<html>
<head>
    @php
        setlocale (LC_TIME, "es_ES");
        $formato = App\NumFormato::first();
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
<br><br><br><br><p align="center">{{ $membrete[0]->descripcion }}</p><br><br>
<p align="right">Oaxaca de Ju&aacute;rez, Oax, a {{ strftime("%e") }} de {{ strftime('%B') }} de {{ strftime('%Y') }}
<br>
OFICIO No. CIDEP-{{ $formato->num }}/{{ date('Y') }}
</p>
<br><br>
<p>A QUIEN CORRESPONDA:</p><br>
@yield('contenidoLiberacion')
<br><br>
<p align="center"> A&nbsp;T&nbsp;E&nbsp;N&nbsp;T&nbsp;A&nbsp;M&nbsp;E&nbsp;N&nbsp;T&nbsp;E <br>
<em><small>Excelencia en Educaci&oacute;n Tecnol&oacute;gica <br>
    “Tecnolog&iacute;a Propia e Independencia Econ&oacute;mica”</small></em>
</p>
<br><br>
<p align="center">JURADO</p>
<br><br><br>
<div id="caja">
<div id="texto-uno">
        M.E. GABRIELA AGUILAR ORTIZ
</div>
<div id="texto-dos">
        M.C. GLADYS CATELLANOS HERN&Aacute;NDEZ
</div>
<br>
<div id="texto-uno">
        <small> JEFA DEL DEPTO. DE GESTI&Oacute;N TECNOL&Oacute;GICA
</div>
<div id="texto-dos">
        SUBDIRECTORA ACAD&Eacute;MICA
</div> <br>
<div id="texto-uno">
        Y VINCULACI&Oacute;N </small>
</div>
</div>
</body> 
</html>