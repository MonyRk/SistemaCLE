@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="text-right">

                <a href="{{ back() }}" class="btn btn-sm btn-outline-primary mt-4">
                    <span>
                        <i class="fas fa-reply"></i> &nbsp; Regresar
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5 mb-5">
        @include('flash-message')
    </div>
    @include('layouts.footers.nav')
@endsection