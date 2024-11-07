<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comentariospost;

class MenuSalaController extends Controller
{
    public function criarPost(Request $request){
        $comment = $request->all();
        $post = Post::create([
            'sala_id' => $comment['sala_id'],
            'titulo' => $comment['titulo'],
            'texto' => $comment['content'],
        ]);
        return redirect()->route('sala.mural', $request['slug']);
    }
    public function criarCommentPost(Request $request){
        $comment = $request->all();
        $post = Comentariospost::create([
            'post_id' => $comment['post_id'],
            'criador_id' => $comment['criador_id'],
            'texto' => $comment['texto'],
        ]);
        $post = Post::where('id');
        $slug = $request['slug'];
        $postName = $request['postName'];
        $id = $request['post_id'];
        return redirect()->route('mural.post', ['slug' => $slug, 'postName' => $postName, 'id' => $id]);
    }
}
