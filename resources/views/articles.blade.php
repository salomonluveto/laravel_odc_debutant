@extends('layouts.app')

@section('title')
    Articles
@endsection

@section('content')
<h1>Liste des articles <hr> </h1>
@foreach ($articles as $item)
    <div class="mt-3 bg-light py-3 px-3">
        <h3>{{ $item->title }}</h3>
        <p>{{ $item->slug }}</p>
        <p style="text-align:right;color:gray;"><i>{{ $item->created_at }}</i></p>
        <p><a class="btn btn-primary" href="{{ route('single', ['id'=>$item->id])}}">Voir plus</a> 
            <a class="btn btn-warning" href="{{ route('edit', ['id'=>$item->id])}}">Editer</a> 
            <a class="btn btn-danger" onclick="supprimer(event)" data-bs-toggle="modal" data-bs-target="#exampleModal" href="{{ route('destroy', ['id'=>$item->id])}}">Supprimer</a>
        </p>
    </div>
    
@endforeach  

<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    function supprimer(event) {
        var route = event.target.getAttribute('href')
        var form = document.querySelector('#exampleModal form')

        form.setAttribute('action', route)
        //alert(route)
    }
  </script>
@endsection

   
   