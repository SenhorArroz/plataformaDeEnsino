@extends('layout')
@section('titulo', $salas->name)
@section('conteudo')

    @auth
        <div class="p-2">
            <div class="card border-success " style="height: 92vh">
                <div class="card-header bg-secondary-subtle text-center border-danger ">
                    <div class="btn-group w-100 h-100" role="group" aria-label="Basic example">
                        @if (auth()->user()->userType == 1)
                        <a class="btn bg-secondary-subtle" data-bs-toggle="offcanvas" href="#offcanvasInfo" role="button" aria-controls="offcanvasInfo">
                            Informações
                          </a>
                          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasInfo" aria-labelledby="offcanvasInfoLabel">
                            <div class="offcanvas-header">
                              <h5 class="offcanvas-title" id="offcanvasInfoLabel">Informações da sala</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                              <div>
                                <p>{{$salas->descricao}}</p>
                                <h4>Código da sala: {{ $salas->codigo }}</h4>
                              </div>
                            </div>
                          </div>
                        @endif
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
