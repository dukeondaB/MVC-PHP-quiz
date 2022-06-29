@extends('layouts.client.main')
@section('content')

<form action="" method="get">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tìm kiếm</label>
                <input type="text" name="keyword" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Sắp xếp theo thứ tự</label>
                <select name="order" class="form-control">
                    <option value="1">Tăng dần</option>
                    <option value="2">Giảm dần</option>
                </select>
            </div>
        </div>
    </div>
</form>
<div class="row">
    @foreach($dsMonhoc as $sub)
    <div class="col-3 mt-3" >
        <div class="card" style="width: 100%;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$sub->name}}</h5>
                <p class="card-text">
                    Số quizs: {{count($sub->quizs)}}
                </p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection