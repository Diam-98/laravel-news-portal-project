@extends('back.app')

@section('title', 'Dashboard - Accueil')

@section('dashboard-header')
    <div class="row">
        <div class="col-sm-12 mt-5">
            <h3 class="page-title mt-3">Profile de {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Profile</li>
            </ul>
        </div>
    </div>
@endsection

@section('dashboard-content')
    <div class="row">
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image">
                        <a href="#"> <img class="rounded-circle" alt="User Image" src="{{asset(\Illuminate\Support\Facades\Auth::user()->image ? \Illuminate\Support\Facades\Auth::user()->imageUrl() : 'back/assets/img/profiles/avatar-01.png')}}"> </a>
                    </div>
                    <div class="col ml-md-n2 profile-user-info">
                        <h4 class="user-name mb-3">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h4>
                        <h6 class="text-muted mt-1">Admin</h6>
                    </div>

                </div>
            </div>
            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#per_details_tab">A propos</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password_tab">Mot de passe</a> </li>
                </ul>
            </div>
            <div class="tab-content profile-tab-cont">
                <div class="tab-pane fade show active" id="per_details_tab">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Informations Personelles</span>
                                        <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Modifier
                                        </a>
                                    </h5>
                                    <div class="row mt-5">
                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Prenom et Nom</p>
                                        <p class="col-sm-9">{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                                    </div>

                                    <div class="row">
                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Email</p>
                                        <p class="col-sm-9">
                                            <a href="">{{ \Illuminate\Support\Facades\Auth::user()->email }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="row form-row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Prenom</label>
                                                        <input type="text" class="form-control" name="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                                                        @error('name')
                                                            <p class="text-red-500 mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                                                        @error('email')
                                                            <p class="text-red-500 mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @if(\Illuminate\Support\Facades\Auth::user()->image)
                                                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->imageUrl() }}" alt="{{ \Illuminate\Support\Facades\Auth::user()->name }}" width="120" height="120">
                                                @endif

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Photo profile</label>
                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Enregistrer les modifications</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">--}}
{{--                                <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title">Personal Details</h5>--}}
{{--                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body">--}}
{{--                                            --}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                    </div>
                </div>
                <div id="password_tab" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Modifier le mot de passe</h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-6">
                                    <form action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Ancien mot de passe</label>
                                            <input type="password" name="current_password" class="form-control">
                                            @error('current_password')
                                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nouveau mot de passe</label>
                                            <input type="password" name="password" class="form-control">
                                            @error('password')
                                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Confirmer motde passe</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                            @error('password_confirmation')
                                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary" type="submit">Enregistrer les modifications</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection








{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Profile') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('back.profile.partials.update-profile-information-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('back.profile.partials.update-password-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('back.profile.partials.delete-user-form')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}
