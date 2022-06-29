@extends('layouts.client.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <table class="table table-hover table-bordered" border="1" style="border-collapse: collapse">
                <thead class="">
                    <tr>
                        <th>#</th>
                        
                        <th>Answer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        
                        <td >
                            {{ $item->content }}
                        </td>
                        <td >
                            <a href="">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
            
        
    </div>
@endsection


