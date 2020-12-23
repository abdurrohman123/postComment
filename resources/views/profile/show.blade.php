@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mx-auto">
        <!-- Profile widget -->

        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3"><img src="{{ $show->avatar }}" alt="..." width="130"
                            class="rounded mb-2 img-thumbnail">

                        @if ($show->id == auth()->id())
                        <a href="/profile/{{ Auth::user()->email }}?tab=edit" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a>
                        
                        @endif
                    </div>
                    
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0">{{ $show->name }}</h4>
                        <p class="small mb-4"> {{ $show->email }} -- {{ $show->nohp }} -- {{ $show->alamat }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <br>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"><a href="/profile/{{ Auth::user()->email }}?tab=post" class="mdi mdi-monitor"></a> {{$show->posts->count()}} Post</h5>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"><a href="/profile/{{ Auth::user()->email }}?tab=like" class="mdi mdi-thumb-up-outline"></a> {{ $show->likes->count() }} Like</h5>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"><a href="/profile/{{ Auth::user()->email }}?tab=hide" class="mdi mdi-information-outline"></a> {{ $show->hideShows->count() }} Hide</h5>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"> <a href="#####" class="mdi mdi-comment-processing-outline"></a> {{ $show->comments->count() }} Comment</h5>
                    </li>
                    
                </ul>
            </div>
            {{-- ------------------------------------------------------------------------------------------------------------- --}}
            <div class="container mt-3">
                <br>
                
                <!-- Nav tabs -->
                @if ($show->id == auth()->id())

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ (!Request::get('tab') || Request::get('tab') == 'post' ) ? 'active' : '' }}" data-toggle="tab" href="#home">Data Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ (Request::get('tab') == 'hide') ? 'active' : '' }}" data-toggle="tab" href="#menu1">Data Hide</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ (Request::get('tab') == 'like') ? 'active' : '' }}" data-toggle="tab" href="#menu2">Data Like</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::get('tab') == 'edit') ? 'active' : '' }} 
                        {{-- @if(Request::get('tab') == 'edit')
                            active
                        @else
                            
                        @endif --}}
                        " data-toggle="tab" href="#borok">Edit Profile</a>
                    </li>
                </ul>
                @endif
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane  {{ (!Request::get('tab') || Request::get('tab') == 'post' ) ? 'active' : 'fade' }}"><br>
                        <div class="container">
                            @foreach ($show->profileShow()->get() as $tampilkan)
                            <div class="card mt-2">
                                <div class="card-header" class="float-right">
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
                    <div id="menu1" class="container tab-pane {{ (Request::get('tab') == 'hide') ? 'active' : 'fade'  }}"><br>
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
                    <div id="menu2" class="container tab-pane {{ (Request::get('tab') == 'like')  ? 'active' : 'fade' }}"><br>
                        <div class="container">
                            {{-- PERULANGAN YANG MENGAMBIL DATA DARI DALAM DATA --}}
                            @foreach ($like as $unlikeTampil)
                            <div class="card mt-2">
                                <div class="card-header">
                                    <a href="/unlike/{{ $unlikeTampil->id }}?pilih=unlike"><span
                                            class="mdi mdi-thumb-up-outline float-right">Unlike </span></a>
                                    <h6>{{ $unlikeTampil->user->name }} - {{ $unlikeTampil->created_at->diffForHumans() }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p>{{ $unlikeTampil->title }}</p>
                                    <p>{{ $unlikeTampil->content }}</p>
                                </div>
                            </div>
                            @endforeach
                            {{-- SAMPAI SINI --}}
                        </div>
                    </div>
                    <div id="borok" class="container tab-pane {{ (Request::get('tab') == 'edit') ? 'active' : 'fade'  }} "><br>
                        <div class="container">
                            <form class="pb-5" action="/profile/{{ $tampilkan->id }}/update" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$tampilkan->name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$tampilkan->email}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="no_hp">Nomor Hp</label>
                                        <input type="text" class="form-control" id="nohp" name="nohp" value="{{$tampilkan->nohp}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{$tampilkan->alamat}}">
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