@extends('layouts.master')

@section('title')
  Dashboard | Library
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <th>Student Name</th>
              <th>Book Name</th>
              <th>Version</th>
              <th>Availability</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </thead>
            <tbody>
              <tr>
                <td>Dakota</td>
                <td>Dakota</td>
                <td>Dakota</td>
                <td>Dakota</td>
                <td>
                  <a href="#" class="btn btn-success">APPROVE</a>
                </td>
                <td>
                  <a href="#" class="btn btn-danger">REJECT</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/demo/demo.js"></script>
@endsection

@section('footer')
<div class=" container-fluid ">
  <nav>
    <ul>
      <li>
        <a href="https://www.creative-tim.com">
          Library
        </a>
      </li>
      <li>
        <a href="http://presentation.creative-tim.com">
          About Us
        </a>
      </li>
      <li>
        <a href="http://blog.creative-tim.com">
          Blog
        </a>
      </li>
    </ul>
  </nav>
</div>
@endsection
