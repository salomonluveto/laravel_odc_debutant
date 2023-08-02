<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    //
    public function index() {
        //Article est la class Model de la table articles
        //la méthode all() permet à recupérer tous les enregistrements
        $articles = Article::orderBy('id', 'desc')->get();

        
        return view('articles', ['articles'=>$articles]);
    }

    
    public function show($id) {
        //Afficher un enregistrement
        $article = Article::find($id);
         
        return view('single', compact('article'));
        
    }

    //Méthode qui affiche le formulaire d e modification d'unarticle
    public function edit($id) {
        
        $article = Article::find($id);
         
        return view('edit', compact('article'));
        
    }

    //Afficher le formulaire d'enregistrement
    public function create() {
         
        return view('create');
        
    }

    //Enregistrer un article
    public function store(Request $request) {
        //Valider les données provenant du formulaire
        $validate = $request->validate([
            'title'=>'required|max:200|unique:articles',
            'slug'=>'required',
            'content'=>'required'
        ]);

        //Verfier si l'image est chargé
        if($request->hasFile('pic')) {
            $nameFile = date('Ymdhis').'.'.$request->pic->extension();
            $pic = $request->pic->storeAs('articles', $nameFile, 'public');
        }
        else {
            $pic = null;
        }
        //Enregistrement 
        $article = Article::create([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'content'=>$request->content,
            'pic'=>$pic
        ]);

        return redirect()->route('articles');
    }

    //Modifer
    public function update(Request $request, $id) {

        $validate = $request->validate([
            'title'=>'required|max:200',
            'slug'=>'required',
            'content'=>'required'
        ]);

        $pic = $article->namefile??null;

        if($request->hasFile('pic')) {
            if(!empty($article->namefile))
            {
                Storage::delete($pic);
            }

            $nameFile = date('Ymdhis').'.'.$request->pic->extension();
            $pic = $request->pic->storeAs('articles', $nameFile, 'public');
        }
       

        $article = Article::find($id);

        $article->title = $request->title;
        $article->slug = $request->slug;
        $article->content = $request->content;
        $article->pic = $pic;

        $article->save();

        return redirect()->route('single', ['id'=>$id]);
    }

    //Supprmer
    public function destroy($id) {
        $article = Article::find($id);

        $article->delete();

        return redirect()->route('articles');
    }
}
