@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card mx-auto">
        <!-- Profile widget -->

        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3"><img src="{{ $user->avatar }}" alt="..." width="130"
                            class="rounded mb-2 img-thumbnail">
                        @if ($user->id == auth()->id()) )
                        <a href="/profile" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a>
                        @endif
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0">{{ $user->name }}</h4>
                        <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>{{ $user->alamat }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"><span class="mdi mdi-email"></span></h5>
                        {{ $user->email }}
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"><span class="mdi mdi-cellphone-basic"></span></h5>
                        {{ $user->nohp }}
                    </li>
                </ul>
            </div>
            {{-- ------------------------------------------------------------------------------------------------------------- --}}
            <div class="container mt-3">
                <br>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Data Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Post Hide</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">Edit Profile</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <div class="container">
                            @foreach ($user->postUser()->get() as $post)
                            <div class="card mt-2">
                                <div class="card-header" class="float-right">
                                    {{-- <form class="float-right" action="" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apa Yakin Anda Akan Menghapus Data ini?');">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-primary float-right"><i class="mdi mdi-pencil"></i></a>
                                    </form> --}}
                                    <h6>{{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</h6>
                                </div>
                                <div class="card-body">
                                    <p>{{ $post->title }}</p>
                                    <p>{{ $post->content }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                        <div class="container">
                            @foreach ($pos as $tampilkan)
                            <div class="card mt-2">
                                <div class="card-header">
                                    <a href="/hide/{{ $tampilkan->id }}?tebak=hide"><span
                                            class="mdi mdi-comment-remove-outline float-right">Unhide </span></a>
                                    <h6>{{ $tampilkan->user->name }} - {{ $tampilkan->created_at->diffForHumans() }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p>{{ $tampilkan->title }}</p>
                                    <p>{{ $tampilkan->content }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="menu2" class="container tab-pane fade"><br>
                        <div class="container">
                            <form class="pb-5" action="/profile/{{ $user->id }}/update" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="no_hp">Nomor Hp</label>
                                        <input type="text" class="form-control" id="nohp" name="nohp" value="{{$user->nohp}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{$user->alamat}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="avatar">Photo</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar" value="">
                                    </div>
                                </div>
                                <div class="form-group col-md-2 float-right">
                                    <button type="submit" class="form-control btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
    </div>
</div>

@endsection