@extends('back.app')

@section('title', 'Dashboard - Articles')

@section('dashboard-header')
    <div class="row align-items-center">
        <div class="col">
            <div class="mt-5">
                <h4 class="card-title float-left mt-2">Articles</h4>
                <a
                    href="{{ route('article.create') }}"
                    class="btn btn-primary float-right veiwbutton"
                >Ajouter un article</a
                >
            </div>
        </div>
    </div>
@endsection

@section('dashboard-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body booking_card">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>ID Article</th>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Categorie</th>
                                <th>Publication</th>
                                <th>Partage</th>
                                <th>Commentaires</th>
                                <th>Auteur</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($articles as $article)
                                    <tr>
                                        <td>ART-000{{ $article->id }}</td>
                                        <td>
                                            <img src="{{ $article->imageUrl() }}" alt="{{ $article->slug }}" width="100" height="100">
                                        </td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->category->name }}</td>
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-success-light mr-2">
                                                    {{ $article->isActive == 1 ? 'PUBLIE' : 'NON PUBLIE' }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-success-light mr-2">
                                                    {{ $article->isShare == 1 ? 'ACTIVE' : 'DESACTIVE' }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-success-light mr-2">
                                                    {{ $article->isComment == 1 ? 'ACTIVE' : 'DESACTIVE'}}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-03.jpg" alt="User Image"></a>
                                                <a href="profile.html">{{ $article->author->name }}
                                                    <span>#000 {{ $article->author->id }}</span>
                                                </a>
                                            </h2>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('article.show', $article->slug) }}">
                                                        <i class="fas fa-eye m-r-5"></i> Voir
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('article.edit', $article->slug) }}">
                                                        <i class="fas fa-pencil-alt m-r-5"></i> Modifier
                                                    </a>
                                                    <a class="dropdown-item" href="#" onclick="confirm('Estes vous sure de vouloir supprimer cet element ?')" >
                                                        <form action="{{ route('article.destroy', $article->slug) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <i class="fas fa-trash-alt m-r-5"></i>
                                                            <button type="submit" class="btn text-danger">Supprimer</button>
                                                        </form>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
