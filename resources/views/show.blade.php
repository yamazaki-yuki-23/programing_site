@extends('layouts.qa')

@section('content')
    <div class="container mt-4">
        <section>
            <div class="card mb-3 ">
                <div class="bg-light border border-light">
                    <h1 class="mb-3 ml-sm-3">
                        {{$post->title}}
                    </h1>

                    <div class="ml-sm-3">
                        投稿：{{$post->created_at}}
                    </div>

                    <div class="col-3 mb-1">
                        <a class="btn btn-primary btn-sm" href="{{route('logout')}}" role="button">
                            {{$post->language}}
                        </a>
                    </div>
                    <div class="border-top p-3 mb-1">
                        <p>{{$post->content}}</p>
                        <div class="row col-3">
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
                    <!--回答入力-->
                    <div class="col-10 mt-4 mb-5">
                        <form method="POST" action="{{route('answer')}}">
                            @csrf
                            <a name="link"></a>
                            <div class="form-group">
                                <h3 class="ml-sm-3 ">あなたの回答</h3>
                                <div class="px-sm-4 ">
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <textarea class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer" rows="10"　placeholder="回答を入力してください">{{ old('answer') }}</textarea>
                                    @if ($errors->has('answer'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('answer') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <input type="submit" class="btn btn-primary btn-lg" value="回答する"/>
                            </div>
                        </form>
                    </div>

                    
                    @if(count($answers) === 0)
                        <div class="text-center alert alert-info mt-3" role="alert">まだ回答がついていません</div>
                    @else
                        <?php $i = 0; ?>
                        <?php $x = 0; ?>
                        <?php $count = count($answers); ?>
                        @for($y=0; $y<$count; $y++)
                            @if(count($answers[$x]) === 1)
                                <div class="text-right mb-3">
                                    <span class="p-3">投稿：{{$answers[$x][0]->created_at}}</span>
                                    <span>{{$answers[$x][0]->answer_name}}さん</span><br>
                                </div>
                                <div class="ml-sm-3 border-bottom">
                                    <p>{{$answers[$x][0]->content}}</p>
                                    <like
                                        :answer-id="{{json_encode($answers[$x][0]->id)}}"
                                        :user-id="{{json_encode($answers[$x][0]->user_id)}}"
                                        :default-Liked="{{json_encode($defaultLiked[$i])}}"
                                        :default-Count="{{json_encode($defaultCount[$i])}}"
                                    ></like>
                                    <?php $i++; ?>
                                </div>
                                <?php $x++; ?>
                            @else
                                <?php $var = count($answers[$x]) ?>  
                                <div class="text-right mb-3">
                                    <span class="p-3">投稿：{{$answers[$x][0]->created_at}}</span>
                                    <span>{{$answers[$x][0]->answer_name}}さん</span><br>
                                </div>
                                <div class="ml-sm-3 border-bottom">
                                    <p>{{$answers[$x][0]->content}}</p>
                                    <like
                                        :answer-id="{{json_encode($answers[$x][0]->id)}}"
                                        :user-id="{{json_encode($answers[$x][0]->user_id)}}"
                                        :default-Liked="{{json_encode($defaultLiked[$i])}}"
                                        :default-Count="{{json_encode($defaultCount[$i])}}"
                                    ></like>
                                    <?php $i++; ?>
                                </div>

                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading col-3">
                                            <p class="panel-title">
                                                <a data-toggle="collapse" href="#collapse{{$x}}">その他の返信（<?php echo $var-1 ;?>件）を表示</a>
                                            </p>
                                        </div>
                                        <div id="collapse{{$x}}" class="panel-collapse collapse">
                                            <ul class="list-group">
                                                @for($h=1; $h<$var; $h++)
                                                    <li class="list-group-item">{{$answers[$x][$h]->content}}
                                                        <like
                                                            :answer-id="{{json_encode($answers[$x][$h]->id)}}"
                                                            :user-id="{{json_encode($answers[$x][$h]->user_id)}}"
                                                            :default-Liked="{{json_encode($defaultLiked[$i])}}"
                                                            :default-Count="{{json_encode($defaultCount[$i])}}"
                                                        ></like>
                                                        <?php $i++; ?>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $x++; ?>
                            @endif
                        @endfor
                    @endif




                
                    <div class="text-center">
                        <a href="#link">
                            <input type="button" class="btn btn-warning btn-lg" value="この質問に回答する" />                    
                        </a>
                    </div>

                @else

                    @if(count($answers) === 0)
                            <div class="text-center alert alert-info mt-3" role="alert">まだ回答がついていません</div>
                        @else
                            <?php $i = 0; ?>
                            <?php $x = 0; ?>
                            <?php $count = count($answers); ?>
                            @for($y=0; $y<$count; $y++)
                                @if(count($answers[$x]) === 1)
                                    <div class="text-right mb-3">
                                        <span class="p-3">投稿：{{$answers[$x][0]->created_at}}</span>
                                        <span>{{$answers[$x][0]->answer_name}}さん</span><br>
                                    </div>
                                    <div class="ml-sm-3 border-bottom">
                                        <p>{{$answers[$x][0]->content}}</p>
                                        <a class="btn btn-primary" href="{{route('warn')}}" role="button">いいね{{$defaultCount[$i]}}</a>
                                    </div>
                                    <?php $x++; ?>
                                @else
                                    <?php $var = count($answers[$x]) ?>  
                                    <div class="text-right mb-3">
                                        <span class="p-3">投稿：{{$answers[$x][0]->created_at}}</span>
                                        <span>{{$answers[$x][0]->answer_name}}さん</span><br>
                                    </div>
                                    <div class="ml-sm-3 border-bottom">
                                        <p>{{$answers[$x][0]->content}}</p>
                                        <a class="btn btn-primary" href="{{route('warn')}}" role="button">いいね{{$defaultCount[$i]}}</a>
                                    </div>

                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading col-3">
                                                <p class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse{{$x}}">その他の返信を表示</a>
                                                </p>
                                            </div>
                                            <div id="collapse{{$x}}" class="panel-collapse collapse">
                                                <ul class="list-group">
                                                    @for($i=1; $i<$var; $i++)
                                                        <li class="list-group-item">{{$answers[$x][$i]->content}}
                                                            <a class="btn btn-primary" href="{{route('warn')}}" role="button">いいね{{$defaultCount[$i]}}</a>
                                                        </li>
                                                    @endfor
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $x++; ?>
                                @endif
                            @endfor
                        @endif

                        <div class="text-center mt-3">
                            <a href="{{route('warn')}}">
                                <input type="button" class="btn btn-warning btn-lg" value="この質問に回答する" />                    
                            </a>
                        </div>
                @endauth




            </div>
        </section>
    </div>
@endsection   