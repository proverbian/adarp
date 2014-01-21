@extends('admin.master')
@section('content')


<div class="container">
	<div class="row">
          <div class="col-lg-12">
            <h1>Reports <small>Statistics Overview</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Reports</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables and charts, so make sure you check out the necessary documentation links provided.
            </div>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">{{ @number_format(Users::getActiveUsers()) }}</p>
                    <p class="announcement-text">Total Users Registered</p>
                  </div>
                </div>
              </div>
              <a href="{{ URL::to('admin/users') }}">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Manage Users
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-check fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">{{ Usermeta::where('key_id','highschool')->count() }}</p>
                    <p class="announcement-text">High School</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                     View
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-tasks fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">{{ Usermeta::where('key_id','elementary')->count() }}</p>
                    <p class="announcement-text">Elementary</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                     View
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
      </div>

           <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Nationality Statistics</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th>Nationality <i class="fa fa-sort"></i></th>
                        <th>Count <i class="fa fa-sort"></i></th>
    
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (Usermeta::getVal('nationality') as $val)
                      <tr>
                        <td>{{ $val->value }}</td>
                        <td><a href="#">{{ $val->cnt }}</a></td>
                      </tr>
                     @endforeach 
                    </tbody>
                  </table>
                </div>
                     <div class="text-right">
                       <a href="#">View All <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
            </div>
          </div>

           <!-- nat -->
           <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> High School Statistics TOP 10</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th>School <i class="fa fa-sort"></i></th>
                        <th>Count <i class="fa fa-sort"></i></th>
    
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (Usermeta::getVal('highschool') as $val)
                      <tr>
                        <td>{{ $val->value }}</td>
                        <td><a href="#">{{ $val->cnt }}</a></td>
                      </tr>
                     @endforeach 
                    </tbody>
                  </table>
                </div>
                     <div class="text-right">
                       <a href="#">View All <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
              </div>
            </div>
          </div>


            <!-- nat -->
           <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Elementary Statistics TOP 10 </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th>School <i class="fa fa-sort"></i></th>
                        <th>Count <i class="fa fa-sort"></i></th>
    
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (Usermeta::getVal('elementary') as $val)
                      <tr>
                        <td>{{ $val->value }}</td>
                        <td><a href="#">{{ $val->cnt }}</a></td>
                      </tr>
                     @endforeach 
                    </tbody>
                  </table>
                </div>
                    <div class="text-right">
                  <a href="#">View All <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
      

        </div><!-- /.nat -->




</div>

@stop