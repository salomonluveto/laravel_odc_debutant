@extends('layouts.app')
@section('title')
   Nouveau Article
@endsection

@section('content')
<h1 class="mb-4">Nouveau Article <hr></h1> 

<div>
    @if ($errors->any())
        
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
          </div>
           
        @endforeach
        
    @endif
   <form action="{{ route('store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row mt-3">
            <div class="col-md-3">
                <label for="title">Titre : </label>
            </div>
            <div class="col-md-9">
                <input type="text" name="title" class="form-control">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <label for="title">Slug : </label>
            </div>
            <div class="col-md-9">
                <textarea name="slug" id="" maxlength="255" cols="30" class="form-control"></textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <label for="title">Description : </label>
            </div>
            <div class="col-md-9">
                <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <label for="title">Image : </label>
            </div>
            <div class="col-md-9">
                <input type="file" name="pic" accept="images/*">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
           
        </div>

   </form>
</div>
@endsection
    



