@extends('layouts.master')

@section('title')
  Books | Library
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Book Details</h5>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/save-books" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Title:</label>
            <input type="text" name="title" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Author:</label>
            <input type="text" name="author" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Version:</label>
            <input type="text" name="version" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Book Subject:</label>
            <input type="text" name="subject" class="form-control" id="recipient-name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{--DELETE MODAL--}}
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="delete_modal_form" method="POST">
        {{csrf_field()}}
        {{method_field('DELETE')}}

      <div class="modal-body" style="text-align: center;">
        <input type="text" id="delete_books_id" style="text-align: center;">
        <h5>Are you sure about deleteing the data?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes! Delete it.</button>
      </div>
      </form>
    </div>
  </div>
</div>
{{--END DELETE MODAL--}}

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Books
          <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">Add</button>
        </h4><br>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div class="col-md-6">
            <form action="/search" method="get">
              <div class="input-group">
                <input type="search" name="search" class="form-control">
                <span class="input-group-prepend">
                  <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </form>
          </div>
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
                  <a href="javascript:void(0)" class="btn btn-danger deletebtn">DELETE</a>
                </td>
              </tr>
              @endforeach
              {{$books->links()}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script>
    /*$(document).ready( function () {
      $('#datatable').DataTable();
    });*/
    $(document).ready(function(){
      $('#datatable').on('click','.deletebtn', function(){

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();

        //console.log(data);

        $('#delete_books_id').val(data[0]);

        $('#delete_modal_form').attr('action','/books-delete/'+data[0]);

        $('#deletemodalpop').modal('show');
      });
    });
  </script>
@endsection
