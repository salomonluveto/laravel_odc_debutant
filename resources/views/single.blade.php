@extends('layouts.app')
@section('title')
   {{ $article->title }} 
@endsection

@section('content')
@if ($article->pic)
    <img class="img-fluid mb-4" src="{{ Storage::url($article->pic) }}" alt="">
@endif
<h1>{{ $article->title }}</h1> 
<p>{{ $article->created_at }}</p>
<div>
   {!! nl2br($article->content) !!}
</div>


<div class="mt-5 btn-light">
   <hr>
   <h2 class="mt-5">Commenter</h2>

   <form action="{{ route('comments.store') }}" method="post">
      @csrf
      <input type="hidden" name="article" value="{{ $article->id }}">
      <p><input type="text" name="auteur" placeholder="Auteur" class="form-control"></p>
      <p><textarea placeholder="Commentaire" name="content" id="" cols="30" rows="5" class="form-control"></textarea></p>
      <p><button type="submit" class="btn btn-primary">Commenter</button></p>
   </form>
</div>

<div class="mt-4 bg-light py-3 px-3 mb-5">
   <h2 class="mb-4">Commentaires ({{ $article->comments->count() }})</h2>
   @forelse ($article->comments as $comment)
      <div class="mt-2 bg-white py-3 px-3">
         <h5><b id="auteur{{ $comment->id }}">{{ $comment->auteur }}</b></h5>
         <p><i style="color:gray;float:right;">{{ $comment->created_at }}</i></p>
         <div id="content{{ $comment->id }}">{!! nl2br($comment->content) !!}</div>
         <p style="text-align: right;" class="mt-2">
            <a href="{{ route('comments.update', ['comment'=>$comment->id]) }}" onclick="editer(event, {{ $comment->id }})" data-bs-toggle="modal" data-bs-target="#edit_comment" class="btn btn-warning">Edit</a> 
            <a href="{{ route('comments.destroy', ['comment'=>$comment->id]) }}" onclick="supprimer(event, {{ $comment->id }})" data-bs-toggle="modal" data-bs-target="#delete_comment" class="btn btn-danger">Suppr</a> 
         </p>
      </div>
   @empty
       Aucun commentaire
   @endforelse
   
</div>


<!-- Modal pour afficher le formulaire de modification-->
<div class="modal fade" id="edit_comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="exampleModalLabel">Editer</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <form action="" method="post">
         <div class="modal-body">
               @csrf
               @method('put')
               <p><input id="edit_auteur" type="text" name="auteur" placeholder="Auteur" class="form-control"></p>
               <p><textarea id="edit_content" name="content" id="" cols="30" rows="5" class="form-control"></textarea></p>
               
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Modifier</button>
            
         </div>
      </form>
     </div>
   </div>
 </div>

 <!-- Modal de suppression -->
 <div class="modal fade" id="delete_comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         Voulez-vous vraiment effectuer cette suppression ?
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
         <form action="" method="post">
           @csrf
           @method('DELETE')
           <button type="submit" class="btn btn-danger">Supprimer</button>
         </form>
         
       </div>
     </div>
   </div>
 </div>

 <script>
   //Fonction js pour recupérer les données d'un commentaire et les placer dans le formulaire du modal
   function editer(event, i) {
       var route = event.target.getAttribute('href')
       var form = document.querySelector('#edit_comment form')

       form.setAttribute('action', route)

       document.querySelector('#edit_auteur').value = document.querySelector('#auteur'+i).innerHTML
       document.querySelector('#edit_content').value = document.querySelector('#content'+i).innerHTML
       //alert(route)
   }

   //Fonction js pour la supression
   function supprimer(event) {
       var route = event.target.getAttribute('href')
       var form = document.querySelector('#delete_comment form')

       form.setAttribute('action', route)
       //alert(route)
   }
 </script>

@endsection
    



