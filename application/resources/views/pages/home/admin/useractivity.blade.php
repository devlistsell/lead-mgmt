@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')
        <!--Page Title & Bread Crumbs -->
    </div>

    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive list-table-wrapper">
            <!--user activity table-->
            <table class="table m-t-0 m-b-0 table-hover no-wrap contact-list">
                <tr>
                    <th>User</th>
                    <th>Activity</th>
                    <th>Ip Address</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                </tr>
                @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->first_name }} {{ $activity->last_name}}</td>
                        <td>{{ $activity->subject }}</td>
                        <td>{{ $activity->ip }}</td>
                        <td>{{ $activity->login_at }}</td>
                        <td>{{ $activity->logout_at }}</td>
                    </tr>
                @endforeach
            </table>
            <!--user activity table-->
        </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection