@extends('layouts.client.main') @section('content')
<div class="container">
    <table class="table">
        <thead>
            <th class="col-2">Mã môn</th>
            <th>Tên môn</th>
            <th>Số quiz</th>
            <th class="col-3">
                <a class="btn btn-success" href=" {{BASE_URL . 'mon-hoc/tao-moi'}}">Tạo mới</a>
            </th>
        </thead>
        <tbody>
            @foreach ($subjects as $sub)
            <tr>
                <td>{{$sub->id}}</td>
                <td>
                   {{ $sub->name }}
                </td>
                <td>
                   {{ count($sub->Quizs) }}
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ BASE_URL . 'mon-hoc/cap-nhat/' . $sub->id }}">Sửa</a>
                    &nbsp;
                    <a class="btn btn-danger" href="{{ BASE_URL . 'mon-hoc/xoa/' . $sub->id }}">Xóa</a>
                    &nbsp;
                    <a class="btn btn-secondary" href="{{ BASE_URL . 'quiz/' . $sub->id }}">Xem chi tiết</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection @section('page-script')
<script>
</script>
@endsection