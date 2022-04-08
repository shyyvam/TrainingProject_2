@extends('layouts.master')

@section('content')

<div class="card-body">
  <div class="table-responsive">
    <table id="datatable" class="table table-stripped">
      <thead class=" text-primary">
        <th>Id</th>
        <th>Book Name</th>
        <th>Book Author</th>
        <th>Book Version</th>
        <th>Book Subject</th>
        <th>EDIT</th>
        <th>DELETE</th>
      </thead>
      <tbody>
        @foreach($books as $data)
        <tr>
          <td>{{$data->book_id}}</td>
          <td>{{$data->book_name}}</td>
          <td>{{$data->book_author}}</td>
          <td>{{$data->book_version}}</td>
          <td>{{$data->book_subject}}</td>
          <td>
            <a href="{{url('booksedit/'.$data->book_id)}}" class="btn btn-success">EDIT</a>
          </td>
          <td>
            <form action="{{url('books-delete/'.$data->book_id)}}" method="POST">
              {{csrf_field()}}
              {{method_field('DELETE')}}
              <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
          </td>
        </tr>
        @endforeach
        {{$books->links()}}
      </tbody>
    </table>
  </div>
</div>

@endsection
