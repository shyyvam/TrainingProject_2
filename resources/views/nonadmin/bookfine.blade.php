@extends('nonadminlayouts.master')

@section('title')
    Fine Book | Library
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
              <th>Book ID</th>
              <th>Name</th>
              <th>Fine</th>
            </thead>
            <tbody>
              @foreach($data as $row)
              <tr>
                <td>{{$row->book_id}}</td>
                <td>{{$row->book_name}}</td>
                <td>{{$row->fine}}</td>
                <td>
                  <form action="/return/{{$row->id}}/{{$row->book_id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger">RETURN</button>
                  </form>
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
