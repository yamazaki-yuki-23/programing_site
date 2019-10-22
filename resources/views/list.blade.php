@extends('layouts.qa')

@section('content')
    <div class="container mt-2">
        <form method="GET" action="{{ route('search') }}">
            @csrf
            <div class="col-12 clearfix">
                <div class="float-right">
                    <div class="input-group">
                        <input type="text" class="form-control  {{ $errors->has('keyword') ? 'is-invalid' : '' }}" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードで検索">                        
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">検索</button>
                        </span>
                        @if ($errors->has('keyword'))
                            <div class="invalid-feedback">
                                {{ $errors->first('keyword') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <div class="card text-center">
            <nav class="bg-light">
                <div class="nav nav-tabs"  style="height:40px;" >
                    <a class="col-3" href="{{route('list')}}" ><button type="button"  class="btn btn-outline-info" id="nav-tag">新着</button></a>
                    <a class="col-3" href="{{route('nav', ['item' => 'no_solve'])}}"><button type="button" class="btn btn-outline-info" id="nav-tag">未解決</button></a>
                    <a class="col-3" href="{{route('nav', ['item' => 'solved'])}}"><button type="button" class="btn btn-outline-info" id="nav-tag">解決済</button></a>
                    <a class="col-3" href="{{route('nav', ['item' => 'popular'])}}"><button type="button" class="btn btn-outline-info" id="nav-tag">人気</button></a>
                </div>
            </nav>  

            <div class="tab-content" id="nav-tabContent">
                @if (count($postList) === 0)
                    <div class="alert alert-danger my-5" role="alert">選択に一致する質問はありませんでした</div>
                @else
                    @foreach ($postList as $post)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @if($post->state == '解決済')
                                        <div class="col-2"><p><span class="badge badge-danger">{{$post->state}}</span></p></div>
                                    @else
                                        <div class="col-2"><p><span class="badge badge-dark">{{$post->state}}</span></p></div>
                                    @endif
                                    <div class="col-10">
                                        <a  href="{{route('show', ['post' => $post->id]) }}">
                                            <h4 class="card-title text-left">{{$post->title }}</h4>
                                        </a>
                                        <h6 class="card-subtitle mb-2 text-left text-muted"><span class="badge badge-light">{{$post->language}}</span></h6>
                                        <h6 class="card-subtitle mb-2 text-right text-muted">{{$post->poster_name}}さん 
                                            <span class="pl-1">
                                                投稿日時 {{$post->created_at->format('Y.m.d') }}
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if($postList->hasPages())
                    <div class="d-flex justify-content-center mt-4 mb-2">
                        {{ $postList->links() }}
                    </div>
                    @else
                        <div class="d-flex justify-content-center mt-4 mb-2">
                            <a class="current" href="#"><h4>1</h4></a>
                        </div>
                    @endif
                @endif  
            </div>
        </div>
    </div>
@endsection