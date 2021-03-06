@extends('layouts.master')

@section('content')

<div class="card-body">
  <div class="table-responsive">
    <table id="datatable" class="table table-stripped">
      <thead class=" text-primary">
        <th>Id</th>
        <th>Book Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Issue Date</th>
        <th>Return Date</th>
        <th>Fine</th>
      </thead>
      <tbody>
        @foreach($data as $row)
        <tr>
          <td>{{$row->id}}</td>
          <td>{{$row->book_name}}</td>
          <td>{{$row->email}}</td>
          <td>{{$row->phone_number}}</td>
          <?php $row->issue_date=date('d-m-Y',$row->issue_date); ?>
          <td>{{$row->issue_date}}</td>
          <?php $row->returndate=date('d-m-Y',$row->return_date); ?>
          <td>{{$row->returndate}}</td>
          <td>{{$row->fine}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

@endsection
