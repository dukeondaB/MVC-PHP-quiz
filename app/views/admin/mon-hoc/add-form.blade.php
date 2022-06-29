@extends('layouts.client.main')
@section('content')
    
<div class="container">
    <form class="form-control-feedback" action="" method="post">
        <div class="row-cols-3 mb-3">
            <label for="">Tên danh mục</label>
            <input class="form-control" type="text" name="name">
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Lưu</button>
        </div>
    </form>
</div>
@endsection
