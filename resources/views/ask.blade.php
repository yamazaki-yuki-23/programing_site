@extends('layouts.qa')

    @section('content')
        <div class="row justify-content-center">
            <div id="accordion" class="col-8">
                <div class="card my-4">
                    @auth
                        <div id="headingReg" class="card-header">質問を投稿する</div>
                        <div id="reg" class="card-body" aria-labelledby="headingReg" data-parent="#accordion">    
                            <form method="POST" action="{{route('list') }}">
                                {{csrf_field() }}
                                <div class="form-group">
                                    <label>タイトル</label>
                                    <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' :''}}" name="title" value="{{ old('title') }}">
                                    @if(($errors->has('title')))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>言語</label>
                                    <select class="form-control {{$errors->has('language') ? 'is-invalid' :''}}" name="language" value="{{ old('language') }}">
                                        <option value="Java">Java</option>
                                        <option value="JavaScript">JavaScript</option>
                                        <option value="HTML">HTML</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Ruby">Ruby</option>
                                        <option value="Python">Python</option>
                                        <option value="Go">Go</option>
                                    </select>
                                    @if(($errors->has('language')))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('language') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>質問内容</label>
                                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" rows="10">{{ old('content') }}</textarea>
                                    @if($errors->has('content'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('content') }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="mt-5 pl-3 row">
                                    <a class="btn btn-secondary mr-2" href="{{ route('top') }}">キャンセル</a>
                                    <button type="submit" class="btn btn-primary">投稿する</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card-body p-5" >
                            <div class="text-center">
                                <p style="font-size:1.3vw;">この機能はログイン後に利用できます</p>
                                <div class="pt-1 pb-3"><a href="{{route('register')}}" class="btn btn-default border border-primary" style="border-radius:50px; width:55%; font-size:1.2vw;">新規会員登録</a></div>
                                <div class="pt-1"><a href="{{route('login')}}" class="btn btn-primary" style="border-radius:50px; width:55%; font-size:1.2vw;">ログイン</a></div>
                            </div>
                        </div>
                    @endauth
                </div>
            @endsection
        </div>
    </div>
</div>
