@extends('layout')
@section('titulo', $salas->name)
@section('conteudo')

    @auth
        <div class="p-2">
            <div class="card border-success " style="height: 92vh">
                <div class="card-header  bg-secondary-subtle text-center border-danger ">
                    <div class="btn-group w-100 h-100" role="group" aria-label="Basic example">
                        <a href="{{ route('sala.mural', $salas->salaSlug) }}" class="btn bg-secondary-subtle">Mural</a>
                        <a href="{{ route('sala.atividade', $salas->salaSlug) }}" class="btn bg-secondary-subtle">Atividades</a>
                        <a href="{{ route('sala.integrantes', $salas->salaSlug) }}" class="btn bg-secondary-subtle">Integrantes</a>
                    </div>
                </div>
                <div class="card-body text-center d-flex flex-column overflow-auto">
                    <div class="container-fluid text-center">
                        <div class="">
                            @yield('parte')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @else
    @endauth
@endsection
