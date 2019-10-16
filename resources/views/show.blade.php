@extends('layouts.qa')

@section('content')
    <div class="container mt-4">
        <section>
            <div class="card mb-3 ">
                <div class="bg-light border border-light">
                    <h1 class="mb-3 ml-3">
                        {{$post->title}}
                    </h1>
                    <div class="ml-3 mb-1">
                        <h6 class="card-subtitle text-left text-muted"><span class="badge badge-primary">{{$post->language}}</span></h6>
                    </div>
                    <h6 class="card-subtitle text-right text-muted mr-4">{{$post->poster_name}}さん 
                        <span class="pl-1">
                            投稿:{{$post->created_at->format('Y.m.d') }}
                        </span>
                    </h6>
                    <div class="border-top p-3 mb-1">
                        <p>{!! nl2br(e($post->content)) !!}</P>
                        <div class="row ml-1">
                            @if($user_id == null)
                                <div class="pr-1">
                                    <button type="button" class="btn btn-danger" disabled="disabled">{{$post->state}}</button>
                                </div>
                                <a class="btn btn-primary" href="{{route('warn')}}" role="button">高評価{{$post->total_goods}}</a>
                            @else
                                <div class="pr-1">
                                    @if($user_id == $post->user_id)
                                        <solve
                                            :post-id = "{{json_encode($post->id)}}"
                                            :default-State="{{json_encode($defaultState)}}"
                                        ></solve>
                                    @else
                                        <button type="button" class="btn btn-danger" disabled="disabled">{{$post->state}}</button>
                                    @endif
                                </div>
                                <evaluate
                                    :post-id = "{{json_encode($post->id)}}"
                                    :user-id="{{json_encode($user_id)}}"
                                    :default-Evaluated="{{json_encode($defaultEvaluated)}}"
                                    :default-Count="{{json_encode($defaultGoodCount)}}"
                                ></evaluate>
                            @endif
                        </div>
                    </div> 
                </div>    

                @auth
                    <div class="text-center mr-5  my-5">
                        <form method="POST" action="{{route('answer')}}">
                            @csrf
                            <a name="link"></a>
                            <div class="form-group">
                                <h3 class="text-left ml-5">あなたの回答</h3>
                                <div class="px-5">
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <textarea class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer" rows="10"　placeholder="回答を入力してください">{{ old('answer') }}</textarea>
                                    @if ($errors->has('answer'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('answer') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="回答する"/>
                            </div>
                        </form>
                    </div>

                    
                    @if($count_answers === 0)
                        <div class="text-center alert alert-info mt-3" role="alert"　style="margin-left:4%; margin-right:8.5%;">まだ回答がついていません</div>
                    @else
                        <?php $like_index = 0; ?>
                        <?php $answer_index = 0; ?>
                        <?php $count = count($answers); ?>
                        @for($answer_number=0; $answer_number<$count_answers; $answer_number++)
                            @if(count($answers[$answer_index]) === 1)
                                <div class="text-center mr-5">
                                    <p class="text-left ml-5  border-top mr-5 pt-3">{{$answers[$answer_index][0]->content}}</p>
                                    <div class="text-right mr-4 mb-3 text-muted"　style="font-size:0.9rem;">
                                        <span>{{$answers[$answer_index][0]->answer_name}}さん</span>
                                        <span class="pl-1 mr-3">投稿：{{$answers[$answer_index][0]->created_at}}</span><br>
                                    </div>
                                    <div class="text-left mx-5  border-bottom pb-3">
                                        <like
                                            :answer-id="{{json_encode($answers[$answer_index][0]->id)}}"
                                            :user-id="{{json_encode($user_id)}}"
                                            :default-Liked="{{json_encode($defaultLiked[$like_index])}}"
                                            :default-Count="{{json_encode($defaultLikeCount[$like_index])}}"
                                        ></like>
                                    </div>
                                </div>
                                <?php $answer_index++; $like_index++; ?>
                            @else
                                <?php $other_answer_number = count($answers[$answer_index]) ?>  
                                <div class="text-center mr-5">
                                    <p class="text-left ml-5  border-top mr-5 pt-3">{{$answers[$answer_index][0]->content}}</p>
                                    <div class="text-right mr-4 mb-3 text-muted"　style="font-size:0.9rem;">
                                        <span>{{$answers[$answer_index][0]->answer_name}}さん</span>
                                        <span class="pl-1 mr-3">投稿：{{$answers[$answer_index][0]->created_at}}</span><br>
                                    </div>
                                    <div class="text-left mx-5  border-bottom pb-3">
                                        <like
                                            :answer-id="{{json_encode($answers[$answer_index][0]->id)}}"
                                            :user-id="{{json_encode($user_id)}}"
                                            :default-Liked="{{json_encode($defaultLiked[$like_index])}}"
                                            :default-Count="{{json_encode($defaultLikeCount[$like_index])}}"
                                        ></like>
                                    </div>
                                    <?php $like_index++; ?>
                                </div>

                                <div class="panel-group ml-4 mr-5 mb-5">
                                    <div class="panel panel-default">
                                        <div class="panel-heading col-6">
                                            <p class="panel-title">
                                                <a class="pl-2" data-toggle="collapse" href="#collapse{{$answer_index}}">その他の返信(<?php echo $other_answer_number-1 ;?>件)を表示</a>
                                            </p>
                                        </div>
                                        <div id="collapse{{$answer_index}}" class="panel-collapse collapse pl-4 pr-5 mb-2 col-11">
                                            <ul class="list-group">
                                                @for($tmp=1; $tmp<$other_answer_number; $tmp++)
                                                    <li class="list-group-item">{{$answers[$answer_index][$tmp]->content}}
                                                        <p class="text-right">投稿:{{$answers[$answer_index][$tmp]->created_at}}</p>
                                                        <like
                                                            :answer-id="{{json_encode($answers[$answer_index][$tmp]->id)}}"
                                                            :user-id="{{json_encode($user_id)}}"
                                                            :default-Liked="{{json_encode($defaultLiked[$like_index])}}"
                                                            :default-Count="{{json_encode($defaultLikeCount[$like_index])}}"
                                                        ></like>
                                                        <?php $like_index++; ?>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $answer_index++; ?>
                            @endif
                        @endfor
                        <div class="text-center mr-5 mt-5">
                            <a href="#link">
                                <input type="button" class="btn btn-warning btn-lg" value="この質問に回答する" />                    
                            </a>
                        </div>
                    @endif

                @else
                    @if($count_answers === 0)
                        <div class="text-center alert alert-info my-5 mx-5" role="alert">まだ回答がついていません</div>
                    @else
                        <?php $like_index = 0; ?>
                        <?php $answer_index = 0; ?>
                        <?php $count = count($answers); ?>
                        @for($answer_number=0; $answer_number<$count_answers; $answer_number++) 
                            @if(count($answers[$answer_index]) === 1)
                                <div class="text-center mr-5 my-5">
                                    <p class="text-left ml-5  border-top mr-5 pt-3">{{$answers[$answer_index][0]->content}}</p>
                                    <div class="text-right mr-4 mb-3 text-muted"　style="font-size:0.9rem;">
                                        <span>{{$answers[$answer_index][0]->answer_name}}さん</span>
                                        <span class="pl-1 mr-3">投稿：{{$answers[$answer_index][0]->created_at}}</span><br>
                                    </div>
                                    <div class="text-left mx-5  border-bottom pb-3">
                                        <a class="btn btn-primary" href="{{route('warn')}}" role="button">いいね{{$defaultLikeCount[$like_index]}}</a>
                                    </div>
                                </div>
                                <?php $answer_index++; $like_index++; ?>
                            @else
                                <?php $other_answer_number = count($answers[$answer_index]) ?>  
                                <div class="text-center mr-5 mt-5">
                                    <p class="text-left ml-5  border-top mr-5 pt-3">{{$answers[$answer_index][0]->content}}</p>
                                    <div class="text-right mr-4 mb-3 text-muted"　style="font-size:0.9rem;">
                                        <span>{{$answers[$answer_index][0]->answer_name}}さん</span>
                                        <span class="pl-1 mr-3">投稿：{{$answers[$answer_index][0]->created_at}}</span><br>
                                    </div>
                                    <div class="text-left mx-5  border-bottom pb-3">
                                        <a class="btn btn-primary" href="{{route('warn')}}" role="button">いいね{{$defaultLikeCount[$like_index]}}</a>
                                    </div>
                                </div>
                                <?php $like_index++; ?>

                                <div class="panel-group ml-4 mr-5 mb-5">
                                    <div class="panel panel-default">
                                        <div class="panel-heading col-6">
                                            <p class="panel-title">
                                                <a class="pl-2" data-toggle="collapse" href="#collapse{{$answer_index}}">その他の返信(<?php echo $other_answer_number-1 ;?>件)を表示</a>
                                            </p>
                                        </div>
                                        <div id="collapse{{$answer_index}}" class="panel-collapse collapse pl-4 pr-5 mb-2 col-11">
                                            <ul class="list-group">
                                                @for($tmp=1; $tmp<$other_answer_number; $tmp++)
                                                    <li class="list-group-item">{{$answers[$answer_index][$tmp]->content}}
                                                        <p class="text-right">投稿:{{$answers[$answer_index][$tmp]->created_at}}</p>
                                                        <a class="btn btn-primary" href="{{route('warn')}}" role="button">いいね{{$defaultLikeCount[$like_index]}}</a>
                                                    </li>
                                                    <?php $like_index++; ?>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $answer_index++; ?>
                            @endif
                        @endfor
                    @endif
                    <div class="text-center">
                        <a href="{{route('warn')}}">
                            <input type="button" class="btn btn-warning btn-lg" value="この質問に回答する">                    
                        </a>
                    </div>
                @endauth
            </div>
        </section>
    </div>
@endsection   