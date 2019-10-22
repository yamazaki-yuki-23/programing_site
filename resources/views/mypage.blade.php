@extends('layouts.qa')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <h3 class="text-primary">{{$user_name}}さんの情報</h3>
            <ul class="bg-secondary nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" href="#home"  data-toggle="tab" role="tab" aria-controls="home" aria-selected="true" style="color:black">成績</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  id="post-tab" href="#post" data-toggle="tab" role="tab" aria-controls="post" aria-selected="false" style="color:black">質問一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="answer-tab" href="#answer" data-toggle="tab" role="tab" aria-controls="answer" aria-selected="false" style="color:black">回答一覧</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card mt-5">
                        <h3>質問・回答の成績</h3>
                        <div class="row">
                            <div class="card-body col-6">
                                <h5 class="card-title"><span class="text-warning">質問の成績</span></h5>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr><td>解決済</td><td class="pl-2">{{$count_solutions}}件</td></tr>
                                        <tr><td>解決率</td><td class="pl-2">{{$resolution_rate}}％</td></tr>
                                        <tr><td>総数</td><td class="pl-2">{{$count_posts}}件</td></tr>                            
                                        <tr><td>いいねをされた回数</td><td class="pl-2">{{$total_likes}}件</td></tr>                            
                                    </tbody>
                                </table>                    
                            </div>
                            <div class="card-body col-6">
                                <h5 class="card-title"><span class="text-warning">回答の成績</span></h5>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr><td>総数</td><td class="pl-2">{{$count_answers}}件</td></tr>
                                        <tr><td>高評価をされた回数</td><td class="pl-2">{{$count_goods}}件</td></tr>
                                    </tbody>
                                </table>                    
                            </div>
                        </div>                    
                    </div>
                </div>

                <div class="tab-pane fade" id="post" role="tabpanel" aria-labelledby="post-tab">
                    <div class="card mt-5">
                        <h3>質問一覧</h3>
                        <table class="mt-2 table table-bordered">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col">総質問数</th>
                                    <th scope="col">未解決</th>
                                    <th scope="col">解決済</th>
                                    <th scope="col">いいね</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$count_posts}}件</td>
                                    <td>{{$count_not_solutions}}件</td>
                                    <td>{{$count_solutions}}件</td>
                                    <td>{{$total_likes}}回</td> 
                                </tr>
                            </tbody>
                        </table>
                        <ul class="bg-light nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="total-tab" href="#total_post"  data-toggle="tab" role="tab" aria-controls="total_post" aria-selected="true" style="color:black">すべて</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  id="unsolved-tab" href="#unsolved_post" data-toggle="tab" role="tab" aria-controls="unsolved_post" aria-selected="false" style="color:black">未解決</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="solved-tab" href="#solved_post" data-toggle="tab" role="tab" aria-controls="solved_post" aria-selected="false" style="color:black">解決済</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="total_post" role="tabpanel" aria-labelledby="total-tab">
                                <div class="card mt-5">
                                    @if($count_posts === 0)
                                        <div class="text-center alert alert-info mt-3" role="alert"　style="margin-left:4%; margin-right:8.5%;">まだ回答がついていません</div>
                                    @else
                                        @foreach ($total_posts as $post)
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <p style="font-size:1.2vw;">{{$post->state}}</p>
                                                        </div>
                                                        <div class="col-10">
                                                            <a  href="{{route('show', ['post' => $post->id]) }}">
                                                                <h3 class="card-title text-left">{{$post->title }}</h3>
                                                            </a>
                                                            <h6 class="card-subtitle mb-2 text-left text-muted">{{$post->language}}</h6>
                                                            <h6 class="card-subtitle mb-2 mr-3 text-right text-muted" style="font-size:1.1vw;">投稿日時 {{$post->created_at->format('Y.m.d') }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if($total_posts->hasPages())
                                        <div class="d-flex justify-content-center mt-2 mb-2">
                                            {{ $total_posts->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade" id="unsolved_post" role="tabpanel" aria-labelledby="unsolved-tab">
                                <div class="card mt-5">
                                    @if($count_not_solutions === 0)
                                        <div class="text-center alert alert-info mt-3" role="alert"　style="margin-left:4%; margin-right:8.5%;">まだ回答がついていません</div>
                                    @else
                                        @foreach ($unsolved_post as $post)
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <p style="font-size:1.2vw;">{{$post->state}}</p>
                                                        </div>
                                                        <div class="col-10">
                                                            <a  href="{{route('show', ['post' => $post->id]) }}">
                                                                <h3 class="card-title text-left">{{$post->title }}</h3>
                                                            </a>
                                                            <h6 class="card-subtitle mb-2 text-left text-muted">{{$post->language}}</h6>
                                                            <h6 class="card-subtitle mb-2 mr-3 text-right text-muted" style="font-size:1.1vw;">投稿日時 {{$post->created_at->format('Y.m.d') }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if($unsolved_post->hasPages())
                                        <div class="d-flex justify-content-center mt-2 mb-2">
                                            {{ $unsolved_post->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade" id="solved_post" role="tabpanel" aria-labelledby="solved-tab">
                                <div class="card mt-5">
                                    @if($count_solutions === 0)
                                        <div class="text-center alert alert-info mt-3" role="alert"　style="margin-left:4%; margin-right:8.5%;">まだ回答がついていません</div>
                                    @else
                                        @foreach ($solved_post as $post)
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <p style="font-size:1.2vw;">{{$post->state}}</p>
                                                        </div>
                                                        <div class="col-10">
                                                            <a  href="{{route('show', ['post' => $post->id]) }}">
                                                                <h3 class="card-title text-left">{{$post->title }}</h3>
                                                            </a>
                                                            <h6 class="card-subtitle mb-2 text-left text-muted">{{$post->language}}</h6>
                                                            <h6 class="card-subtitle mb-2 mr-3 text-right text-muted" style="font-size:1.1vw;">投稿日時 {{$post->created_at->format('Y.m.d') }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if($solved_post->hasPages())
                                        <div class="d-flex justify-content-center mt-2 mb-2">
                                            {{ $solved_post->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="answer" role="tabpanel" aria-labelledby="answer-tab">
                    <div class="card mt-5">
                        <h3>回答一覧</h3>
                        <table class="mt-2 table table-bordered">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col">総回答数</th>
                                    <th scope="col">高評価</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$count_answers}}件</td>
                                    <td>{{$count_goods}}回</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card mt-5">
                            @if($count_answers === 0)
                                <div class="text-center alert alert-info mt-3" role="alert"　style="margin-left:4%; margin-right:8.5%;">まだ回答がついていません</div>
                            @else
                                @foreach ($comment_post as $post)
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-2">
                                                    <p style="font-size:1.2vw;">{{$post->state}}</p>
                                                </div>
                                                <div class="col-10">
                                                    <a  href="{{route('show', ['post' => $post->id]) }}">
                                                        <h3 class="card-title text-left">{{$post->title }}</h3>
                                                    </a>
                                                    <h6 class="card-subtitle mb-2 text-left text-muted">{{$post->language}}</h6>
                                                    <h6 class="card-subtitle mb-2 mr-3 text-right text-muted" style="font-size:1.1vw;">投稿日時 {{$post->created_at->format('Y.m.d') }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach      
                            @endif                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection   