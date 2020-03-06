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
            padding-left: 8%;  
            line-height: 10%;
            text-transform: uppercase
        }

        #texto-dos {
            float: right;
            padding-right: 5%;
            line-height: 20%;
            text-transform: uppercase
        }
    </style>

</head>

<body>
    {{-- <div align="center">
        <img src="{{ asset('argon') }}/img/brand/cabeceraSM.png" alt="cabecera" title="cabecera">
    </div> --}}
    
    <p align="justify">
        “ADENDUM” A LA ORDEN DE SERVICIO PARA LA PRESTACIÓN DE SERVICIOS QUE CELEBRAN,
        POR UNA PARTE, <strong>EL INSTITUTO TECNOLÓGICO DE OAXACA, REPRESENTADO POR EL 
            M.E. FERNANDO TOLEDO TOLEDO</strong>, EN SU CARÁCTER DE DIRECTOR; Y POR LA OTRA, EL (LA) 
        C. <strong style="text-transform:uppercase;">
            {{ $docente[0]->nombres }} {{ $docente[0]->ap_paterno }} @if( $docente[0]->ap_materno ){{ $docente[0]->ap_materno }} @endif
        </strong>
        A QUIENES EN LO SUCESIVO Y PARA LOS EFECTOS DEL PRESENTE 
        ADENDUM SE LES DENOMINARÁ <strong>“EL INSTITUTO”</strong> Y 
        <strong>"EL PRESTADOR DE SERVICIOS"</strong>, RESPECTIVAMENTE, 
        Y EN CONJUNTO <strong>“LAS PARTES”</strong> AL TENOR DE LAS SIGUIENTES:
    </p><br>
    <p align="center">
        <strong>DECLARACIONES</strong>
    </p><br>
    <p align="justify"> 
        <b>I. DE “EL INSTITUTO”:</b>
    </p>
    <p align="justify">
        <b>I.1</b> Que es una institución de educación superior tecnológica, adscrita al Tecnológico Nacional de México de conformidad con el
    </p>
    <p>
        <b>I </b> Decreto de Creación de este órgano desconcentrado, publicado en el Diario Oficial de la Federación el 23 de julio de 2014 y que su representante, tiene facultades para suscribir el presente Adendum, como se desprende del Artículo 7°, fracciones I, II, IV y, VI del Acuerdo que establece normas para la prestación de servicios del personal directivo y funcionarios docentes de los Institutos Tecnológicos dependientes de la Secretaría de Educación Pública (Acuerdo 93).
    </p>        
    <p align="justify">
        <b>I.2</b> Que, de acuerdo a sus necesidades para el 
        adecuado cumplimiento de sus controles administrativos, 
        requiere, temporalmente, contar con los servicios de una 
        persona física, profesionista con formación y 
        conocimientos <b>docentes para el proceso de 
        enseñanza-aprendizaje citado en la cláusula primera de 
        este instrumento para el curso <b style="text-transform:uppercase">{{ $data['idioma'] }} NIVEL {{ $data['nivel'] }}</b></b> , por lo
        que ha determinado llevar a cabo el presente adendum a 
        la orden de prestación de servicios, en los términos que 
        más adelante se detallará, para la contratación de 
        <b>“EL PRESTADOR DE SERVICIOS”</b>.    
    </p>
    <p align="justify">
        <b>I.3</b> Que cuenta con los recursos suficientes para 
        cubrir el importe de los honorarios de <b>“EL PRESTADOR DE 
        SERVICIOS”</b>, derivado de los ingresos propios que se generan por sus actividades propias (Cuotas de servicio), de conformidad con el Manual del Sistema de Ingresos Propios de los Planteles Educativos, emitido por la Secretaría de Educación Pública.
    </p>
    
    <p align="justify">
        <b>I.4</b> Que el presente instrumento se celebra de conformidad con lo dispuesto por los artículos 2606 del Código Civil Federal, 3 fracción VII de la Ley de Adquisiciones Arrendamientos y Servicios del Sector Público y, el numeral 41 del Manual del Sistema de Ingresos Propios de los Planteles Educativos.
    </p>
    <p align="justify">
        <b>I.5</b> Que cuenta con la autorización presupuestaria para ello, de conformidad con el Programa Operativo Anual para el año 2019.
    </p>
    <p align="justify">  
        <b>I.6</b> Que es su interés la realización del presente Adendum, para determinar las obligaciones entre “LAS PARTES” derivadas de la orden de servicio requerido.
    </p>
    <p align="justify">
        <b>I.7</b> Que para los efectos del presente Adendum, señala como su domicilio el ubicado en Avenida Ing. Víctor Bravo Ahuja # 125 Esq. Calzada Tecnológico, C.P. 68030, Oaxaca, Oax. México.
    </p>
    <p align="justify"> 
        <b>II. DE "EL PRESTADOR DE SERVICIOS":</b>
    </p>
    <p align="justify">
        <b>II.1</b> Que es una persona física de nacionalidad mexicana, en pleno uso y goce de las facultades que le otorgan las leyes de los Estados Unidos Mexicanos y que cuenta con los conocimientos profesionales y/o técnicos y, en su caso, con la experiencia necesaria para prestar el servicio objeto del presente instrumento.
    </p>
    <p align="justify">
        <b>II.2</b> Que cuenta con Registro Federal de 
        Contribuyentes número <b>{{ $data['rfc'] }}</b>, otorgado por el Servicio de Administración Tributaria, de la Secretaría de Hacienda y Crédito Público.
    </p>
    <p align="justify">
        <b>II.3</b> Que manifiesta, bajo protesta de decir verdad, que no se encuentra en ninguno de los supuestos señalados en los artículos 50 y 60 de la Ley de Adquisiciones Arrendamientos y Servicios del Sector Público, por lo que se considera apto para la celebración del presente instrumento.
    </p>
    <p align="justify">
        <b>II.4</b> Que cuenta con estudios y conocimientos
        en materia de {{ $data['titulo'] }} y que conoce plenamente las características y necesidades de los servicios en materia del presente instrumento, así como que ha considerado todos los factores que intervienen para desarrollar eficazmente las actividades que desempeñará.
    </p>
    <p align="justify">
        <b>II.5</b> Que manifiesta, BAJO PROTESTA DE DECIR 
        VERDAD, que no se encuentra inhabilitado para el
        desempeño de éstos, así como que a la suscripción 
        del presente no es parte de un juicio del orden
        civil, mercantil o laboral en contra de alguna 
        institución pública y que no se encuentra en
        algún otro supuesto o situación que pudiera
        generar conflicto de intereses para prestar 
        los servicios profesionales solicitados por 
        <b>“EL INSTITUTO”</b>.
    </p>
    <p align="justify">
        <b>II.6</b> Que declara su domicilio para todos los efectos relacionados 
        con el presente instrumento jurídico, así como para cualquier 
        tipo de notificación, el ubicado en 
        <b style="text-transform:uppercase">CALLE {{ $docente[0]->calle }}, {{ $docente[0]->numero }}, {{ $docente[0]->colonia }}, {{ $docente[0]->cp }}, {{ $docente[0]->municipio }}, OAXACA</b>
    </p>
    <p align="justify">
        <b>II.7</b> Que es su voluntad la celebración del presente instrumento en todos y cada uno de sus términos.
    </p>
    <p align="justify">
        <b>III DE LAS PARTES:</b>
    </p>
    <p align="justify">
        <b>III.1</b> Declaran las partes que tienen las facultades legales suficientes para celebrar este tipo de actos jurídicos.
    </p>
    <p align="justify">  
        <b>III.2</b> Manifiestan que se reconocen mutua y recíprocamente la personalidad con la que se ostentan para todos los efectos legales y convenidos a que hubiese lugar, y precisados en los términos del presente instrumento.
    </p>
    <p align ="justify">
        <b>III.3</b> Declaran que celebran el presente instrumento de manera voluntaria, libre y responsable, sin que al efecto exista dolo, lesión, error y/o algún vicio de la voluntad que lo invalide.
    </p>
    <p align="justify">  
        <b>III.4</b> Hechas las declaraciones que anteceden, y a efecto de perfeccionar el presente instrumento, han decidido obligarse de manera recíproca y equitativa con las siguientes:
    </p>
    <br>
    <p align="center"><b>CLÁUSULAS</b></p><br>
    <p align="justify">
        <b>PRIMERA.-</b> Las partes convienen que el objeto del presente instrumento consiste en que 
        <b>“EL PRESTADOR DE SERVICIOS”</b> otorgue de manera temporal a 
        <b>“EL INSTITUTO”</b> los servicios profesionales docentes, consistentes específicamente en la facilitación del aprendizaje a sus alumnos, siendo las actividades sustantivas:
    </p>
    <p align="justify">
        <b>1.</b>	Implementar el aprendizaje frente a grupo de la 
        signatura de <b>{{ $data['idioma'] }} NIVEL {{ $data['nivel'] }}</b> 
        con clave  lo cual se realizará en las instalaciones de 
        <b>“EL INSTITUTO”</b> de acuerdo al horario que sea 
        acordado entre las partes. Por la propia naturaleza del 
        servicio que se pacta, las partes reconocen que no existe 
        dependencia laboral de una con otra, por lo que 
        <b>“EL PRESTADOR DE SERVICIOS”</b> lo hará de manera libre 
        e independiente, con respeto a la libertad de cátedra, pero 
        con apego a los programas académicos autorizados a 
        <b>“EL INSTITUTO”</b>.
    </p>     
    <p align="justify">
        <b>2.</b>	Rendir los informes parciales de avance, así 
        como los finales que le sean requeridos respecto a los 
        servicios encomendados, de manera semanal o cuando éstos 
        le sean requeridos, mismos que deberán presentarse, por 
        escrito, al Jefe de Departamento requirente (Supervisor del 
        Servicio), en las instalaciones de <b>“EL INSTITUTO”</b>, así como 
        el resultado de los servicios pactados en este instrumento. 
        La presentación de esta información, constituye la evidencia de los trabajos que el profesor ha realizado y forman parte de los entregables que soportaran el pago de la prestación del servicio.
    </p><br>
    <p align="justify">
        <b>SEGUNDA.-</b> Convienen las partes que la 
        contraprestación por 
        los servicios mencionados en la cláusula primera 
        será un importe total bruto estimado de <b>$ {{ $data['importe'] }}.00 
        {{ NumerosEnLetras::convertir($data['importe']) }} ( 00/100 M.N.)</b>, previa entrega de los 
        informes de los servicios encomendados a satisfacción 
        de <b>“EL INSTITUTO”</b>.
    </p>
    <p align="justify">
        El pago derivado de este Adendum se realizará en una sola exhibición previa autorización del cumplimiento de actividades en las fechas y montos que se señalan a continuación:
    </p>     
    <p align="justify">
        FECHA DE PAGO: {{ $data['fecha_pago'] }}
<br>
        MONTO A PAGAR: $ {{ $data['importe'] }}
    </p>
    <p align="justify">
        <b>“EL PRESTADOR DE SERVICIOS”</b> está de acuerdo 
        en que <b>“EL INSTITUTO”</b> le retendrá de los pagos que 
        reciba por concepto de honorarios, la cantidad que resulte 
        aplicable en los términos de la Ley del Impuesto Sobre la 
        Renta y de la Ley del IVA, contra entrega del recibo de 
        honorarios correspondiente.     
    </p>        
    <p align="justify">
        Para la liberación de los pagos a que haya lugar, así como 
        para todos los demás actos conducentes, se señala como 
        Supervisor del Servicio al Coordinador de Verano 2019 de 
        <b>“EL INSTITUTO”</b>, quién deberá emitir el oficio en que se 
        especifique que éste ha recibido los trabajos de 
        <b>“EL PRESTADOR DE SERVICIOS”</b>, a entera satisfacción.
    </p>
    <p align="justify">
        La supervisión del servicio a que se refiere el párrafo anterior,
        así como el resultado de los servicios pactados podrán ser 
        revisados y/o modificados en cualesquier momento por el 
        Supervisor del Servicio.
    </p>     <br>
    <p align="justify">
        <b>TERCERA.- “EL PRESTADOR DE SERVICIOS”</b> tendrá las siguientes obligaciones:
    </p>     
    <p align="justify">
        <br><b>1.</b>	Aplicar toda su capacidad y sus conocimientos 
        para cumplir satisfactoriamente con las actividades que le 
        encomiende <b>“EL INSTITUTO”</b>.
        <br><b>2.</b>	Responder de la calidad de los servicios prestados 
        y de cualquier otra responsabilidad en la que incurra, así 
        como de los daños y perjuicios que por inobservancia o 
        negligencia de su parte se causaren a <b>“EL INSTITUTO”</b>.
        <br><b>3.</b>	Desempeñar los servicios objeto del presente instrumento a <b>“EL INSTITUTO”</b> en forma personal e independiente, por lo que, en virtud de lo anterior, será el único responsable de la ejecución de los servicios cuando no se ajusten a los términos y condiciones del presente instrumento.
        <br><b>4.</b>	No divulgar a terceras personas, por medio de publicaciones, informes, o cualquier otro medio, los datos y resultados que obtenga con motivo de la prestación de los servicios prestados y que son objeto de este instrumento, o la información que <b>“EL INSTITUTO”</b> le proporcione o a la que tenga acceso de manera directa o indirectamente, por motivo de la realización del presente instrumento.   
    </p>
    <p><br>
        <b>CUARTA.- “EL PRESTADOR DE SERVICIOS”</b> tendrá los siguientes derechos:
    </p>    
    <p align="justify">
        <br><b> 1.</b>	Recibir el pago oportuno de la contraprestación a que se hace referencia en la cláusula segunda de este instrumento por parte de <b>“EL INSTITUTO”</b> según el calendario indicado en la cláusula Segunda y previa entrega de los entregables respectivos; el pago lo realizará <b>“EL INSTITUTO”</b> mediante cheque nominativo.
            
        <br><b>2.</b>	A que se le informe dentro de un plazo prudente, respecto de cualquier contingencia que se presente durante o a consecuencia de la prestación del servicio.      
    </p><br>
    <p align="justify">
        <b>QUINTA.- “EL PRESTADOR DE SERVICIOS”</b> no podrá, con motivo de la prestación de los servicios que realice a <b>“EL INSTITUTO”</b>, asesorar, patrocinar o constituirse en consultor de cualquier persona que tenga relaciones directas o indirectas con el objeto de las actividades que lleve a cabo.
    </p>     <br>
    <p align="justify"> 
        <b>SEXTA.-</b> Las partes acuerdan que el presente instrumento es de carácter netamente civil de conformidad con el artículos 2606, 2610 y demás relativas del Código Civil Federal.
    </p>
    <p align="justify">
        La vigencia de este instrumento jurídico será a 
        partir del {{ $data['inicio'] }} al {{ $data['fin'] }}
        por lo que, en consecuencia, <b>“EL INSTITUTO”</b> no 
        asume responsabilidad alguna de índole laboral o de 
        seguridad social, con respecto a 
        <b>“EL PRESTADOR DE SERVICIOS”</b>.
    </p>
    <p align="justify">        
        <b>“EL INSTITUTO”</b> y <b>“EL PRESTADOR DE SERVICIOS”</b>, podrán convenir la realización de un nuevo Adendum por la misma o diferentes actividades encomendadas.
    </p>  <br>
    <p align="justify"> 
        <b>SÉPTIMA.- “EL PRESTADOR DE SERVICIOS”</b> no podrá ceder en forma parcial ni total a favor de cualquier persona física o moral, los derechos o las obligaciones derivadas del presente instrumento jurídico.
    </p>    <br>
    <p align="justify">
        <b>OCTAVA.-</b> Serán causas de rescisión las siguientes:
    </p>
    <p align="justify">
        <br><b>1.</b>	Prestar los servicios, objeto de este instrumento, deficientemente, de manera inoportuna o por no apegarse a lo estipulado en el presente instrumento.
        <br><b>2.</b>	No observar la discreción debida respecto de la información a la que tenga acceso como consecuencia de la prestación de los servicios encomendados.
        <br><b>3.</b>	Suspender injustificadamente la prestación de los servicios, objeto de este instrumento o por negarse a corregir las actividades o informes rechazados por <b>“EL INSTITUTO”</b>.
        <br><b>4.</b>	Negarse a informar a <b>“EL INSTITUTO”</b> sobre la prestación y/o el resultado de los servicios encomendados.
        <br><b>5.</b>	Impedir el desempeño normal de labores de <b>“EL INSTITUTO”</b> durante la prestación de los servicios objeto de este instrumento.
        <br><b>6.</b>	Si se comprueba que las de este instrumento jurídico fueron realizadas con falsedad; y 
        <br><b>7.</b>	Por incumplimiento de cualquiera de las obligaciones establecidas en este instrumento.
        <br><b>8.</b>	Que en la revisión realizada por el Supervisor del Servicio sobre el cumplimiento en tiempo, forma y calidad del servicio a que se refiere el presente instrumento se determinará la continuidad o término del servicio.         
    </p>        
    <p align="justify">
        Para los efectos a que se refiere esta cláusula, 
        <b>“EL INSTITUTO”</b> comunicará por escrito a 
        <b>“EL PRESTADOR DE SERVICIOS”</b> el incumplimiento
        en que éste hubiere incurrido, para que en un término 
        de cinco días hábiles, exponga lo que a su derecho
        convenga, y aporte, en su caso, las pruebas 
        correspondientes tendientes a desvirtuar la
        imputación hecha por <b>“EL INSTITUTO”</b>.
    </p>
    <p align="justify">
        Transcurrido el término señalado en el párrafo anterior, 
        <b>“EL INSTITUTO”</b>, tomando en cuenta los argumentos y
        pruebas ofrecidas por “EL PRESTADOR DE SERVICIOS”, 
        determinará de manera fundada y motivada si resulta 
        procedente o no rescindir el presente instrumento y 
        comunicará por escrito, de manera inmediata, a 
        <b>“EL PRESTADOR DE SERVICIOS”</b> de dicha determinación, 
        sin que exista responsabilidad alguna por parte de 
        <b>“EL INSTITUTO”</b>.
    </p>
            
    <p align="justify">
        <b>“EL PRESTADOR DE SERVICIOS”</b> comunicará a <b>“EL INSTITUTO”</b>, a través del Supervisor del
        Servicio de cualquier hecho o circunstancia que sea de su 
        conocimiento y en virtud del cual se pudiera generar un
        beneficio o perjuicio a la institución o a cualquiera de 
        los integrantes de la comunidad tecnológica, entendiéndose
        por esta, alumnos, profesores, trabajadores o cualquier 
        otra persona o sus bienes, en caso de que estos se 
        encuentren sujetos de algún riesgo, que sea conocido por 
        <b>"EL PRESTADOR DE SERVICIOS”</b> o que en su caso, debiera conocer.
    </p>     <br>    
    <p align="justify">   
        <b>NOVENA.- “EL INSTITUTO”</b>, en cualquier momento, podrá dar por terminado anticipadamente el presente instrumento sin responsabilidad y sin necesidad de que medie resolución judicial alguna, dando aviso por escrito a <b>"EL PRESTADOR DE SERVICIOS”</b> con quince días naturales de anticipación. En todo caso, <b>“EL INSTITUTO”</b>, deberá cubrir las contraprestaciones que correspondan por los servicios prestados y que haya recibido a su entera satisfacción.
    </p>
    <p align="justify">
        Asimismo <b>"EL PRESTADOR DE SERVICIOS”</b> podrá darlo por terminado anticipadamente, previo aviso que por escrito realice a <b>“EL INSTITUTO”</b> en el plazo señalado en el párrafo que antecede. En dado caso, <b>“EL INSTITUTO”</b> se reserva el derecho de aceptar la terminación anticipada del presente instrumento sin que ello implique la renuncia a deducir las acciones legales que, en su caso, procedan.
    </p>     <br>
    <p align="justify">
        <b>DÉCIMA.- "EL PRESTADOR DE SERVICIOS”</b> no será responsable por cualquier evento de caso fortuito o de fuerza mayor que le impida parcial o totalmente cumplir con las obligaciones contraídas, en la inteligencia de que dichos supuestos deberán quedar plenamente acreditados.
    </p>    <br>
    <p align="justify">
        <b>DÉCIMA PRIMERA.- "EL PRESTADOR DE SERVICIOS”</b> reconoce por este medio que <b>“EL INSTITUTO”</b> no adquiere obligación alguna de carácter laboral a su favor en virtud de no ser aplicables a la relación laboral que consta en este instrumento, los artículos 1º y 8º de la Ley Federal del Trabajo y 2º y 8º de la Ley Federal de los Trabajadores al Servicio del Estado, reglamentaria del apartado “B” del artículo 123 Constitucional, por lo que <b>"EL PRESTADOR DE SERVICIOS”</b> no será considerado como trabajador de <b>“EL INSTITUTO”</b> para los efectos legales a que haya lugar y en particular, para obtener las prestaciones establecidas por la Ley del Instituto de Seguridad y Servicios Sociales de los Trabajadores del Estado.
    </p> <br>
    <p align="justify"> 
        <b>DÉCIMA SEGUNDA.-</b> Las partes establecen como domicilio para oír y recibir notificaciones relacionas con el presente instrumento, los señalados en el apartado de Declaraciones, con los numerales <b>I.7</b> y <b>II.6</b>.
    </p>    <br>
    <p align="justify">
        <b>DÉCIMA TERCERA.- “LAS PARTES” </b>acuerdan expresamente que en virtud de lo señalado en las declaratorias I.4; I.5; II.4; II.5 y, II.7 del presente instrumento <b>"EL PRESTADOR DE SERVICIOS”</b> no deberá identificarse, ni ostentarse como trabajador de <b>“EL INSTITUTO”</b> por ningún medio ni en ninguna circunstancia. La contravención a esta será motivo de recisión de la Orden de Servicio y del presente Adendum. 
    </p>    <br>
    <p align="jsutify">
        <b>DÉCIMA CUARTA.-</b> Las partes aceptan que todo lo no previsto en el presente instrumento jurídico se regirá por las disposiciones contenidas en el código civil federal y en caso de existir controversia para su interpretación y cumplimiento, se someterán “LAS PARTES” a la jurisdicción de los tribunales federales renunciando a cualquier otro fuero que les pudiera corresponder en razón de sus domicilios presentes o futuros o por cualquier otra causa.
    </p>    
    <p align="justify" style="text-transform:uppercase;">
            LEÍDO QUE FUE POR LAS PARTES QUE INTERVIENEN EN EL PRESENTE INSTRUMENTO Y SABEDORES DE SU CONTENIDO, ALCANCE Y EFECTOS LEGALES, SE FIRMA AL CALCE Y AL MARGEN EN TODAS SUS 
            FOJAS ÚTILES, EN LA CIUDAD DE OAXACA, OAX. 
            A {{ NumerosEnLetras::convertir(strftime("%d")) }} d&iacute;as del mes de {{ strftime("%B") }} 
            del año {{ NumerosEnLetras::convertir(strftime("%Y")) }}.
    </p>
    <br><br>
    <div id="caja">
            <div id="texto-uno">
                <b>“EL INSTITUTO”</b>
            </div>
            <div id="texto-dos">
                <b>"EL PRESTADOR DE SERVICIOS”</b>
            </div>
            <br><br><br><br><br>
            <div id="texto-uno">
                M.E. FERNANDO TOLEDO TOLEDO
            </div>
            <div id="texto-dos" style="text-transform: uppercase;">
                {{ $docente[0]->nombres }} {{ $docente[0]->ap_paterno }} @if( $docente[0]->ap_materno ){{ $docente[0]->ap_materno }} @endif
            </div><br>
            <div id="texto-uno">
               DIRECTOR
            </div>
            <br><br><br><br><br>
            <div id="texto-dos">
                <b>SUPERVISOR DEL SERVICIO</b>    
            </div>    
            <br><br><br><br><br><br>
            <div id="texto-dos">
                M.E. GABRIELA AGUILAR ORTIZ
            </div>
            
    </div>
    
           
            
            
            
    </p>
</body>

</html>