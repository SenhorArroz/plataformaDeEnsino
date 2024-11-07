<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\Sala;
use \App\Models\Post;
use App\Models\Comentariospost;
use \App\Models\Salas_aluno;

class SiteController extends Controller
{
    public function index(){
        
        $viewName = 'home';
        return view('geral.home', compact('viewName'));
    }
    public function loginView(){
        $viewName = 'login';
        return view('login.login', compact('viewName'));
    }
    public function registrarView(){
        $viewName = 'registro';
        return view('login.registro', compact('viewName'));
    }
    public function perfil($slug){
        if(!Auth::check()){
            return redirect()->route('site.home');
        }
        $viewName = 'perfil';
        $user = User::where('userSlug', $slug)->first();
        return view('geral.perfil', compact('user', 'viewName'));
    }
    public function salasdeaula(){
        if(!Auth::check()){
            return redirect()->route('site.home');
        }
        $viewName = 'salasdeaula';
        $alunoSalas = [];
        if(Auth::user()->userType == 0){
            $alunoSalas = Salas_aluno::where('id_user', Auth::user()->id)->get();
        }
        $salas = Sala::paginate(4);
        return view('geral.salasdeaula', compact('viewName', 'salas', 'alunoSalas'));
    }
    //views da sala
    public function acessarSala($slug){
        if(!Auth::check()){
            return redirect()->route('site.home');
        }
        $viewName = 'salasdeaula';
        $salas = Sala::where('salaSlug', $slug)->first();
        $professor = User::where('id', $salas->criador_id)->first();
        $posts = Post::where('sala_id', $salas->id)->get();
        return view('geral.salasMenu.mural', compact('salas', 'viewName', 'posts', 'professor'));
    }
    
    public function salaMural($slug){
        if(!Auth::check()){
            return redirect()->route('site.home');
        }
        $viewName = 'salasdeaula';
        $salas = Sala::where('salaSlug', $slug)->first();
        $professor = User::where('id', $salas->criador_id)->first();
        $posts = Post::where('sala_id', $salas->id)->get();
        return view('geral.salasMenu.mural', compact('salas', 'viewName', 'posts', 'professor'));
    }
    public function salaAtividades($slug){
        if(!Auth::check()){
            return redirect()->route('site.home');
        }
        $viewName = 'salasdeaula';
        $salas = Sala::where('salaSlug', $slug)->first();
        $professor = User::where('id', $salas->criador_id)->first();
        return view('geral.salasMenu.atividades', compact('salas', 'viewName', 'professor'));
    }
    public function salaIntegrantes($slug){
        if(!Auth::check()){
            return redirect()->route('site.home');
        }
        $viewName = 'salasdeaula';
        $salas = Sala::where('salaSlug', $slug)->first();
        $professor = User::where('id', $salas->criador_id)->first();
        return view('geral.salasMenu.integrantes', compact('salas', 'viewName', 'professor'));
    }
    public function postView($slug, $postName, $id){
        $viewName = 'salasdeaula';
        $salas = Sala::where('salaSlug', $slug)->first();
        $professor = User::where('id', $salas->criador_id)->first();
        $post = Post::where('id', $id)->first();

        $comments = Comentariospost::where('post_id', $post->id)->with('creator')->orderBy('id', 'asc')->get()->map(function ($comment) {
            $comment->creator_name = $comment->creator->firstName . ' ' . $comment->creator->lastName;
            return $comment;
        });;
        return view('geral.salasMenu.post', compact('viewName', 'salas', 'professor', 'post', 'comments'));
    }
}
