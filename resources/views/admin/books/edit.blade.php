@extends('layouts.master')

@section('title')
Books Edit
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Books-Edit Data</h4>
          <form action="{{ url('books-update/'.$books->book_id)}}" method="POST">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Book Title:</label>
              <input type="text" name="title" class="form-control" value="{{$books->book_name}}">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Book Author:</label>
              <input type="text" name="author" class="form-control" value="{{$books->book_author}}">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Book Version:</label>
              <input type="text" name="version" class="form-control" value="{{$books->book_version}}">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Book Subject:</label>
              <input type="text" name="subject" class="form-control" value="{{$books->book_subject}}">
            </div>
        </div>
        <div class="modal-footer">
          <a href="{{url('books')}}" class="btn btn-secondary">BACK</a>
          <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection