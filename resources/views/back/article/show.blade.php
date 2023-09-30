@extends('back.app')

@section('title', 'Dashboard - Articles')

@section('dashboard-header')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Details de l'article : {{ $article->title }}</h4>
        </div>
    </div>
@endsection

@section('dashboard-content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="blog-view">
                <article class="blog blog-single-post">
                    <h3 class="blog-title">{{ $article->title }}</h3>
                    <div class="blog-image">
                        <img src="{{ $article->imageUrl() }}" alt="{{ $article->slug }}" class="img-fluid mt-4">
                    </div>
                    <div class="blog-content mt-4">
                        {{ $article->description }}
                    </div>
                    <div class="col-md-12 mt-3">
                        <h5>Les tags existants</h5>
                        @foreach($article->tags as $tag)
                            <label class="label label-info btn btn-primary">{{ $tag->name }} </label>
                        @endforeach
                    </div>
                </article>
                <div class="widget author-widget clearfix">
                    <h3>A propos de l'auteur</h3>
                    <div class="about-author">
                        <div class="about-author-img">
                            <div class="author-img-wrap">
                                <img class="img-fluid rounded-circle" alt="" src="storage/{{ $article->author->image }}">
                            </div>
                        </div>
                        <div class="author-details">
                            <span class="blog-author-name">{{ $article->author->name }}</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
