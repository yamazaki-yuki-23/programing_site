@extends('layouts.qa')

    @section('content')
        <div class="row justify-content-center">
            <div id="accordion" class="col-md-8">
                <div class="card my-4">
                    <div id="headingReg" class="card-header">質問に回答する</div>
                    <div id="reg" class="card-body" aria-labelledby="headingReg" data-parent="#accordion">
                        <div>回答するには、ログインしてください。</div>
                        <div class="pt-1"><a href="{{route('login')}}" class="btn btn-primary">ログイン</a></div>
                        <div class="pt-1"><a href="{{route('register')}}">ログインがまだの方はこちらから</a></div>
                    </div>
                </div>
            @endsection
        </div>
    </div>
</div>
