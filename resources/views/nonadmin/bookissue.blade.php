@extends('nonadminlayouts.master')

@section('title')
  Issue Book | Library
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Books </h4>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <th>ID</th>
              <th>Name</th>
            </thead>
            <tbody>
              @foreach($data as $row)
              <tr>
                <td>{{$row->book_id}}</td>
                <td>{{$row->book_name}}</td>
                <td>
                  <a href="/issueupdate/{{$row->book_id}}" class="btn btn-success" >Issue</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')

@endsection
