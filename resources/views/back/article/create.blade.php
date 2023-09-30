@extends('back.app')

@section('title', 'Dashboard - Modififer article')

@section('dashboard-header')
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title mt-5">@if(isset($article)) Modification @else Ajout @endif d'un article</h3>
        </div>
    </div>
@endsection

@section('dashboard-content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ isset($article) ? route('article.update', $article->slug) : route('article.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($article))
                    @method('PUT')
                @endif
                <div class="row formtype">

                    @if(isset($article))
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre de l'article</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    value="{{ isset($article) ? old('title', $article->title) : old('title') }}"
                                    name="title"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cat_id">Categorie</label>
                                <select class="form-control" id="cat_id" name="category_id">
                                    @foreach($categories as $category)
                                        <option @if(isset($article)) @selected($article->category->id) @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3 mb-3">
                            <h3>L'image de l'article</h3>
                            <img src="{{ $article->imageUrl() }}" height="200" width="300" alt="{{ $article->slug }}">
                        </div>

                        <div class="col-md-6 mt-3 mb-3">
                            <div class="form-group">
                                <label>Changer l'image</label>
                                <div class="custom-file mb-3">
                                    <input
                                        type="file"
                                        class="custom-file-input"
                                        id="customFile"
                                        name="image"
                                    />
                                    <label class="custom-file-label" for="customFile">
                                        Choisir une image
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr>
                    @else
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Titre de l'article</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    value="{{  old('title') }}"
                                    name="title"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cat_id">Categorie</label>
                                <select class="form-control" id="cat_id" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Uploader une image</label>
                                <div class="custom-file mb-3">
                                    <input
                                        type="file"
                                        class="custom-file-input"
                                        id="customFile"
                                        name="image"
                                    />
                                    <label class="custom-file-label" for="customFile"
                                    >Choisir une image</label
                                    >
                                </div>
                            </div>
                        </div>
                    @endif

                    <textarea
                        class="form-control"
                        rows="5"
                        id="comment"
                        name="description">
                        {{ isset($article) ? $article->description : '' }}
                  </textarea>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Publication</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="article_active" name="isActive" value="1" {{ isset($article) && $article->isActive == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="article_active">Publier</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="article_inactive" name="isActive" value="0" {{ isset($article) && $article->isActive == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="article_inactive">Ne pas publier</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Partages</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="article_share_active" name="isSharable" value="1" {{ isset($article) && $article->isSharable == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="article_share_active">Partageable</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="article_share_inactive" name="isSharable" value="0" {{ isset($article) && $article->isSharable == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="article_share_inactive">Non Partageable</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Commentaires</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="article_comment_active" name="isComment" value="1" {{ isset($article) && $article->isComment == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="article_comment_active">Autorise</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="article_comment_inactive" name="isComment" value="0" {{ isset($article) && $article->isComment == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="article_comment_inactive">Non autorise</label>
                        </div>
                    </div>
                        <div class="col-md-12 mt-3">
                            <h5>Les tags existants</h5>
                            @foreach($article->tags as $tag)
                                <label class="label label-info btn btn-primary">{{ $tag->name }} </label>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input class="form-control" type="text" data-role="tagsinput" name="tags">
                                @if ($errors->has('tags'))
                                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                                @endif
                            </div>
                        </div>
                    <button type="submit" class="btn btn-primary buttonedit1">{{ isset($article) ? 'Mettre a jour l\'article' : 'Enregistrer l\'article' }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection
