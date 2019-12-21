@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div id="accordion" class="col-md-8">
                <div class="card my-4">
                    <div class="card-body p-5" >
                        <div class="text-center">
                            <p>この機能はログイン後に利用できます</p>
                            <div class="pt-1 pb-3"><a href="{{route('register')}}" class="btn btn-default border border-primary" style="border-radius:50px; width:35%;font-size:1.3vw;">新規会員登録</a></div>
                            <div class="pt-1"><a href="{{route('login')}}" class="btn btn-primary" style="border-radius:50px; width:35%;">ログイン</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
