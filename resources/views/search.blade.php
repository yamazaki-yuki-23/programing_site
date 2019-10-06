@extends('layouts.qa')

@section('content')
    @if(count($posts) === 0)
        <div class="alert alert-danger" role="alert">{{$keyword}}に一致するQ&Aは見つかりませんでした。</div>
    @else
    <div class="card mx-sm-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2>キーワード：{{$keyword}}<h2>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>タイトル</th>
                        <th>言語</th>
                        <th>内容</th>
                        <th>回答状態</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><a href="{{route('show', ['post_id' => $post->id])}}">{!! nl2br(e(str_limit($post->title, 20)))!!}</a></td>
                            <td>{{$post->language}}</td>
                            <td>{!! nl2br(e(str_limit($post->content, 25)))!!}</td>
                            <td>{{$post->state}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mb-5">
            {{ $posts->links() }}
        </div>
    </div>    
    @endif
@endsection   