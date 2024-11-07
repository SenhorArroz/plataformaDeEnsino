@extends('geral.sala')
@section('nome', 'Mural')
@section('parte')
    <div class="text-start">
        <br>
        <div class="row align-items-start">
            <h1 class="">{{ $post->titulo }}</h1>
        </div>
        <div class="row  align-items-center border-top border-success border-bottom ">
            <p class="fs-5">{!! $post->texto !!}</p>
        </div>
        <br>
        <div>
            <p>Área de comentários <i class="bi bi-chat-left-text"></i></p>


            <!-- Modal comentário -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog border-success modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content border-success text-center">
                        <div class="modal-header border-danger">
                            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Comentário</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('mural.postComment') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="slug" value="{{ $salas->salaSlug }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="postName" value="{{ $post->titulo }}">
                                <input type="hidden" name="criador_id" value="{{ auth()->user()->id }}">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="texto"
                                            style="height: 250px"></textarea>
                                        <label for="floatingTextarea2">Texto</label>
                                    </div>
                                </div><br>
                                <div class="modal-footer border-danger">
                                    <button class="btn btn-danger" data-bs-dismiss="modal">Voltar</button>
                                    <button class="btn btn-success">Comentar</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            @isset($comments)
                <div class="container"> </div>
                <div class="row mb-3" style="max-width: 40% ">
                    @foreach ($comments as $comment)
                        <div class="border-bottom border-danger-subtle  d-flex mb-2" style="">
                            <div class="fs-5 mb-0">{{ $comment->creator_name }}</div>
                            <p class="mb-0 ms-3" style="font-size:10px; margin-bottom: 0; align-self:flex-end;">
                                {{ $comment->created_at }}</p>
                        </div>
                        <div class="card-body border-bottom border-success-subtle">
                            <p class="card-text">{{ $comment->texto }}</p>
                        </div>
                    @endforeach
                </div> 
            </div>
        @endisset
    </div>
    </div>
    <div class="p-3 position-fixed " style="bottom: 15px; right: 10px;">
        <div class="mt-auto text-sm-end ">
            <button type="button" class="btn btn-success rounded-circle " style="width: 80px; height: 80px"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-circle-dotted heading" style="font-size: 40px"></i>
            </button>
        </div>
    </div>
@endsection
