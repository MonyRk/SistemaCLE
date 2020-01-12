@extends('viewsBase.show')

@section('regresar')
{{ route('verDocentes') }}
@endsection

@section('informacion')
<hr class="my-4"/>
    <h6 class="heading-small text-muted mb-4">{{ __('Información Profesional') }}</h6>
    <div>
        <div class="row">
            <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('Grado de Estudios: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->grado_estudios }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('RFC : ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <a href= "{{ route('verRfc',[$datos[0]->id_docente,$datos[0]->rfc]) }}" target="_blank" class="card-text font-weight-bold text-dark"><u>{{ $datos[0]->rfc }}</u></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-xl col-lg-6">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Título: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                <a href= "{{ route('verTitulo',[$datos[0]->id_docente,$datos[0]->titulo]) }}" target="_blank" class="card-text font-weight-bold text-dark"><u>{{ $datos[0]->titulo }}</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-lg-6">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Cédula Profesional: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                <a href= "{{ route('verCedula',[$datos[0]->id_docente,$datos[0]->ced_prof]) }}" target="_blank" class="card-text font-weight-bold text-dark"><u>{{ $datos[0]->ced_prof }}</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl col-lg-6">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Certificaciones: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                @if ($datos[0]->certificaciones != null)
                                    @php $documentos = ""; $documentos = explode(',',$datos[0]->certificaciones); @endphp
                                    @foreach ($documentos as $certificacion)
                                        <a href="{{ route('verCertificaciones',[$datos[0]->id_docente,$certificacion]) }}" class="card-text font-weight-bold text-dark"><u>{{ $certificacion }}</u></a><br>
                                    @endforeach
                                @endif
                                
                                {{-- <a href="{{ route('verCertificaciones',$datos[0]->id_docente) }}" class="card-text font-weight-bold">{{ $datos[0]->certificaciones }}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-lg-6">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Estatus: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                <p class="card-text font-weight-bold">{{ $datos[0]->estatus }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl col-lg">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Certificacion de Dominio del Idioma: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                @if ($datos[0]->dominio_idioma != null)
                                    <p class="card-text font-weight-bold">{{ $datos[0]->dominio_idioma }}</p>
                                    {{-- @php $documentos = ""; $documentos = explode(',',$datos[0]->certificaciones); @endphp
                                    @foreach ($documentos as $certificacion)
                                        <a href="{{ route('verCertificaciones',[$datos[0]->id_docente,$certificacion]) }}" class="card-text font-weight-bold text-dark"><u>{{ $certificacion }}</u></a><br>
                                    @endforeach --}}
                                @endif
                                
                                {{-- <a href="{{ route('verCertificaciones',$datos[0]->id_docente) }}" class="card-text font-weight-bold">{{ $datos[0]->certificaciones }}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-lg">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Curso de Entrenamiento para Profesores: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                @if ($datos[0]->curso != null)
                                    <p class="card-text font-weight-bold">{{ $datos[0]->curso }}</p>
                                    {{-- @php $documentos = ""; $documentos = explode(',',$datos[0]->certificaciones); @endphp
                                    @foreach ($documentos as $certificacion)
                                        <a href="{{ route('verCertificaciones',[$datos[0]->id_docente,$certificacion]) }}" class="card-text font-weight-bold text-dark"><u>{{ $certificacion }}</u></a><br>
                                    @endforeach --}}
                                @endif
                                
                                {{-- <a href="{{ route('verCertificaciones',$datos[0]->id_docente) }}" class="card-text font-weight-bold">{{ $datos[0]->certificaciones }}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-lg">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Años de Experiencia Docente: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                @if ($datos[0]->experiencia != null)
                                    <p class="card-text font-weight-bold">{{ $datos[0]->experiencia }}</p>
                                    {{-- @php $documentos = ""; $documentos = explode(',',$datos[0]->certificaciones); @endphp
                                    @foreach ($documentos as $certificacion)
                                        <a href="{{ route('verCertificaciones',[$datos[0]->id_docente,$certificacion]) }}" class="card-text font-weight-bold text-dark"><u>{{ $certificacion }}</u></a><br>
                                    @endforeach --}}
                                @endif
                                
                                {{-- <a href="{{ route('verCertificaciones',$datos[0]->id_docente) }}" class="card-text font-weight-bold">{{ $datos[0]->certificaciones }}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl col-lg">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Certificaciones de Didáctica: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                @if ($datos[0]->didactica != null)
                                    {{-- <p class="card-text font-weight-bold">{{ $datos[0]->curso }}</p> --}}
                                    @php $didactica = ""; $didactica = explode(';',$datos[0]->didactica); @endphp
                                    @foreach ($didactica as $nombre_didactica)
                                        <p  class="card-text font-weight-bold text-dark">{{ $nombre_didactica }}</p>
                                    @endforeach
                                @endif
                                
                                {{-- <a href="{{ route('verCertificaciones',$datos[0]->id_docente) }}" class="card-text font-weight-bold">{{ $datos[0]->certificaciones }}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl col-lg">
                <div class="card card-stats mb-4 mb-xl">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ __('Acciones de Actualización Docente: ') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="">
                                @if ($datos[0]->actualizacion != null)
                                    {{-- <p class="card-text font-weight-bold">{{ $datos[0]->curso }}</p> --}}
                                    @php $actualizaciones = ""; $actualizaciones = explode(';',$datos[0]->actualizacion); @endphp
                                    @foreach ($actualizaciones as $nombre_actualizacion)
                                        <p  class="card-text font-weight-bold text-dark">{{ $nombre_actualizacion }}</p>
                                    @endforeach
                                @endif
                                
                                {{-- <a href="{{ route('verCertificaciones',$datos[0]->id_docente) }}" class="card-text font-weight-bold">{{ $datos[0]->certificaciones }}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
