                <table  cellspacing="0" cellpadding="0" align="center" border="1" style="padding-top:100px;">
                    <thead>
                        <tr colspan="2" ><h3 align="center">Estudiantes por Carrera</h3></tr>
                        <tr >
                            <th>Carrera</th>
                            <th>N&uacute;m. Estudiantes</th>
                        </tr>
                    </thead>
                    <tbody class="bordes">
                        @php
                        $i=0;
                        @endphp
                        @foreach ($nombre_carreras as $carrera)
                        <tr class="bordes">
                            <td class="bordes">{{ $carrera }}</th>
                            <td class="bordes" align="center">{{ $carreras[$i] }}</td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

  {{-- <div>
        <h3 class="text-dark" align="center">Ingresos Estimados de la CLE del Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h3>
    <h2 class="text-center mt-3" align="center">$ {{ $ingresos*814 }}.00</h2>

    <h3 class="mt-6 text-center" align="center">Total de Estudiantes inscritos durante el periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h3>
    <h2 class="text-center mt-3" align="center"> {{ $ingresos }}</h2>

    <h3 class="text-dark" align="center">Datos Estadisticos del Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h3>

   </div> --}}
{{-- <div> --}}
        {{-- <table  align="center">
                <thead>
                    <tr colspan="2" ><h3 align="center">Estudiantes por Carrera</h3></tr>
                    <tr >
                        <th>Carrera</th>
                        <th>N&uacute;m. Estudiantes</th>
                    </tr>
                </thead>
                <tbody class="bordes">
                    @php
                    $i=0;
                    @endphp
                    @foreach ($nombre_carreras as $carrera)
                    <tr class="bordes">
                        <td class="bordes">{{ $carrera }}</th>
                        <td class="bordes" align="center">{{ $carreras[$i] }}</td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            <table class="bordes" style="width=50%" align="center">
                    <thead class="bordes">
                        <tr colspan="2" class="bordes"><h3 align="center">Estudiantes por Nivel</h3></tr>
                        <tr class="bordes">
                            <th class="bordes">Nivel</th>
                            <th class="bordes">N&uacute;m. Estudiantes</th>
                        </tr>
                    </thead>
                    <tbody class="bordes">
                            @php
                            $i=0;
                            @endphp
                            @foreach ($nombre_niveles as $nivel)
                            <tr class="bordes">
                                <td class="bordes">{{ $nivel }}{{ $modulos[$i] }}</th>
                                <td class="bordes" align="center">{{ $niveles[$i] }}</td>
                            </tr>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                    </tbody>
                </table> --}}
    {{-- <table style="width=100%">
        <tr>
            <td style="width=50%">
                <table class="bordes" align="center">
                    <thead class="bordes">
                        <tr colspan="2" class="bordes" ><h3 align="center">Estudiantes por Carrera</h3></tr>
                        <tr class="bordes">
                            <th class="bordes">Carrera</th>
                            <th class="bordes">N&uacute;m. Estudiantes</th>
                        </tr>
                    </thead>
                    <tbody class="bordes">
                        @php
                        $i=0;
                        @endphp
                        @foreach ($nombre_carreras as $carrera)
                        <tr class="bordes">
                            <td class="bordes">{{ $carrera }}</th>
                            <td class="bordes" align="center">{{ $carreras[$i] }}</td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </td>
            <td style="width=50%">
                <table class="bordes" style="width=50%" align="center">
                    <thead class="bordes">
                        <tr colspan="2" class="bordes"><h3 align="center">Estudiantes por Nivel</h3></tr>
                        <tr class="bordes">
                            <th class="bordes">Nivel</th>
                            <th class="bordes">N&uacute;m. Estudiantes</th>
                        </tr>
                    </thead>
                    <tbody class="bordes">
                            @php
                            $i=0;
                            @endphp
                            @foreach ($nombre_niveles as $nivel)
                            <tr class="bordes">
                                <td class="bordes">{{ $nivel }}{{ $modulos[$i] }}</th>
                                <td class="bordes" align="center">{{ $niveles[$i] }}</td>
                            </tr>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <table style="width=100%">
            <tr>
                <td style="width=50%">
                        <table class="bordes" style="width=50%" align="center">
                                <thead class="bordes">
                                    <tr colspan="2" class="bordes"><h3 align="center">Estudiantes por G&eacute;nero</h3></tr>
                                    <tr class="bordes">
                                        <th class="bordes">G&eacute;nero</th>
                                        <th class="bordes">N&uacute;m. Estudiantes</th>
                                    </tr>
                                </thead>
                                <tbody class="bordes">
                                    @php $estudiantes_genero= ""; $estudiantes_genero = explode(',',$generos); @endphp
                                    <tr class="bordes">
                                        <td class="bordes">Mujeres</td>
                                        <td class="bordes" align="center">{{ $estudiantes_genero[0] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bordes">Hombres</td>
                                        <td class="bordes" align="center">{{ $estudiantes_genero[1] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                </td>
                <td style="width=50%">
                    <table class="bordes" style="width=50%" align="center">
                        <thead class="bordes">
                            <tr colspan="2" class="bordes" ><h3 align="center">&Iacute;ndices de Aprobaci&oacute;n</h3></tr>
                            <tr class="bordes">
                                <th class="bordes">&Iacute;ndice</th>
                                <th class="bordes">N&uacute;m. Estudiantes</th>
                            </tr>
                        </thead>
                        <tbody class="bordes">
                            <tr class="bordes">
                                <td class="bordes">Aprobados</td>
                                <td class="bordes" align="center">{{ $aprobados }}</td>
                            </tr>
                            <tr>
                                <td class="bordes">Reprobados</td>
                                <td class="bordes" align="center">{{ $reprobados }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
             --}}
{{-- </div> --}}