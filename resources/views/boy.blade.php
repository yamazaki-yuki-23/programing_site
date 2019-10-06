@extends('layouts.qa')


@section('content')
    <div class="container mt-4">
        <form method="POST" action="{{ route('search') }}">
            @csrf
            <div class="col-12 clearfix">
                <div class="float-right">
                    <div class="input-group">
                        <input type="text" class="form-control  {{ $errors->has('keyword') ? 'is-invalid' : '' }}" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードで検索">
                        @if ($errors->has('keyword'))
                            <div class="invalid-feedback">
                                {{ $errors->first('keyword') }}
                            </div>
                        @endif
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">検索</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-4">
        <div class="card text-center">
            <nav class="bg-light">
                <div class="nav nav-tabs"  style="height:40px;" >
                    <a class="col-3" href="{{route('young')}}" ><button type="button"  class="btn btn-outline-info" style="width:80%">新着</button></a>
                    <a class="col-3" href="{{route('nav', ['item' => 'no_solve'])}}"><button type="button" class="btn btn-outline-info" style="width:80%">未解決</button></a>
                    <a class="col-3" href="{{route('nav', ['item' => 'solved'])}}"><button type="button" class="btn btn-outline-info" style="width:80%">解決済</button></a>
                    <a class="col-3" href="{{route('nav', ['item' => 'popular'])}}"><button type="button" class="btn btn-outline-info" style="width:80%">人気</button></a>
                </div>
            </nav>  
            <div class="tab-content" id="nav-tabContent">
                    @if (count($postList) === 0)
                        <div class="alert alert-danger" role="alert">選択に一致する質問はありませんでした</div>
                    @else

                        @foreach ($postList as $post)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <p>{{$post->state}}</p>
                                        </div>
                                        <div class="col-10">
                                            <a  href="{{route('show', ['post' => $post->id]) }}">
                                                <h2 class="card-title text-left">{{$post->title }}</h2>
                                            </a>
                                            <h6 class="card-subtitle mb-2 text-left text-muted">{{$post->language}}</h6>
                                            <h6 class="card-subtitle mb-2 text-right text-muted">{{$post->poster_name}}さん 
                                                <span class="pl-4">
                                                    投稿日時 {{$post->created_at->format('Y.m.d') }}
                                                </span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif  
                    <div class="d-flex justify-content-center mt-4 mb-2">
                        {{ $postList->links() }}
                    </div>
            </div>
        </div>
    </div>
@endsection