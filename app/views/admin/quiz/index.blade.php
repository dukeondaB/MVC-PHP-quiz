@extends('layouts.client.main')
@section('content')

    <div class="container-fluid">
        <div class="mt-3">
            <table class="table table-hover table-bordered" border="1" style="border-collapse: collapse">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Tên môn học</th>
                        <th>Tên quiz</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Trạng thái</th>
                        <th>Thời gian làm bài</th>
                        <th>Đảo câu</th>
                        <th>
                            <a href="{{BASE_URL . 'quiz/add'}}" class="btn btn-success">Tạo mới</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjectQuizs as $sq)
                    <tr>
                        <td>{{$sq->id}}</td>
                        <td>
                            @php
                                $parentQuiz = $sq->subject
                            @endphp
                                @if ($parentQuiz != null)
                                    
                                {{$parentQuiz->name}}
                                @endif
                        </td>
                        <td scope="row">{{$sq->name}}</td>
                        <td>{{ $sq->start_time}}</td>
                        <td>{{ $sq->end_time}}</td>
                        <td>{{ $sq->status == 1 ? "Active" : "Inactive"}}</td>
                        <td>{{ $sq->duration_minutes}}</td>
                        <td>{{ $sq->is_shuffle == 1 ? "Có" : "Không"}}</td>
                        <td>
                            <a href="{{ BASE_URL . 'quiz/cap-nhat/' . $sq->id}}" class="btn btn-primary">Sửa</a>
                            &nbsp;
                            <a href="{{ BASE_URL . 'quiz/xoa/' . $sq->id}}" class="btn btn-danger">Xóa</a>
                            &nbsp;
                            <a class="btn btn-secondary" href="{{ BASE_URL . 'quiz/addQuestion/' . $sq->id}}">Xem chi tiết</a>
                            &nbsp;
                            <a class="btn btn-secondary" href="{{ BASE_URL . 'quiz/lam_quiz/' . $sq->id}}">Làm quiz</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

        
@endsection
    

