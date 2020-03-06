<!DOCTYPE html>
<html>
<head>
    <style>
     
        table, th, td{
            table-layout: fixed;
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 8pt;
            /* width: 250px; */
        }
        
    
        </style>
</head>
<body>
<table id="datatable">
    <thead class="thead-light">
        <tr>                        
            <th  scope="col" class="col-17">Curp</th>
            {{-- <th scope="col">contraseña</th> --}}
        </tr>
    </thead>
    <tbody>
        
        @foreach ($personas as $persona) 
        {{-- {{ dd($persona->curp) }} --}}
        @if($persona->curp != 'AOCE000802HOCLRRA3')
        
        <tr>
            <td scope="row">
                {{ $persona->nombres }}
            </td>
            {{-- <td scope="row">
                {{ bcrypt($persona->curp) }}
            </td> --}}
        </tr>
        @else
        @break
        @endif
        @endforeach
    </tbody>
</table>

</body>
</html>