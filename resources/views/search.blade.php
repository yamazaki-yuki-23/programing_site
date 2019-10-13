@extends('layouts.qa')

@section('content')
    <div class="container mt-5">
        <div class="card text-center">
            <nav class="bg-light">
                <div class="panel-heading">
                    <h3 class="text-left pl-5">【{{$keyword}}】の検索結果：{{$count}}件<h3>
                </div>
            </nav>  
            <div class="tab-content" id="nav-tabContent">
                @if ($count === 0)
                    <div class="mt-5 text-danger" role="alert">選択に一致する質問はありませんでした</div>
                @else
                    @foreach ($posts as $post)
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
                                            <span class="pl-4">
                                                投稿日時 {{$post->created_at->format('Y.m.d') }}
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($posts->hasPages())
                    <div class="d-flex justify-content-center mt-4 mb-2">
                        {{ $posts->appends(request()->input())->links() }}
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