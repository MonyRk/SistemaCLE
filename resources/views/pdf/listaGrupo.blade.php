<!DOCTYPE html>
<html>
<head>
<style>
/* table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  table-layout: fixed;
}


th, td {
    width: 100px;
    word-wrap: break-word;
} */
table, th, td{
    table-layout: fixed;
    border: 1px solid black;
    border-collapse: collapse;
    /* width: 250px; */
}

.col-small {
    width: 13%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}
.col-med {
    width: 30%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}
</style>
</head>
<body>

<h2>Grupo: {{ $alumnos_en_el_grupo[0]->grupo }}</h2>

<table style="width:100%" id="datatable">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width=50px;">Número <br> de Control</th>
                        <th scope="col">Nombre</th>
                        <th scope="col" colspan="18">Asistencias</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos_en_el_grupo as $alumno) 
                    
                    <tr>
                        <td scope="row" class="col-small">
                            {{ $alumno->num_control }}
                        </td>
                        <td scope="row" class="col-med">
                           {{ $alumno->nombres }} {{ $alumno->ap_paterno }} @if($alumno->ap_materno != null) {{ $alumno->ap_materno }} @endif
                        </td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>

</body>
</html>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        
                        
                    </div>
                </div>
            </div>
        </div>
{{-- endsection contenido --}}
        
    </div>
</body>
</html>