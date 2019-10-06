@extends('layouts.qa')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <h3 class="text-primary">{{$user_name}}さんの情報</h3>
            <ul class="bg-light nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" href="#home"  data-toggle="tab" role="tab" aria-controls="home" aria-selected="true" style="color:black">プロフィール</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="#" data-toggle="tab" href="#profile" style="color:black">質問一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab" href="#profile" style="color:black">回答一覧</a>
                </li>
            </ul>

            <!-- <h3 class="col-6 bg-success mt-5">質問・回答の成績</h3> -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card mt-5">
                        <h3>質問・回答の成績</h3>
                        <div class="row">
                            <div class="card-body col-6">
                                <h5 class="card-title"><span class="text-warning">質問の成績</span></h5>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr><td>解決済み</td><td class="pl-2">{{$count_solutions}}件</td></tr>
                                        <tr><td>解決率</td><td class="pl-2">{{$resolution_rate}}％</td></tr>
                                        <tr><td>総数</td><td class="pl-2">{{$count_questions}}件</td></tr>                            
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
            </div>
            

        </div>
    </div>
@endsection   