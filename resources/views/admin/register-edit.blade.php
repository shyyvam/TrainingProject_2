@extends('layouts.master')

@section('title')
  Registered Roles | Library
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Edit Role for Registered Users</h3>
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <form action="/role-update/{{$users->id}}" method="POST">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="username" value="{{$users->name}}" class="form-control">
                </div>
                <div class="form-group">
                  <label>Give Role</label>
                  <select name="usertype" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/users" class="btn btn-danger">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

@endsection
