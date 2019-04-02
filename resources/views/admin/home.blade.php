@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard</h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Surveys</h3>
                    @foreach($surveys as $survey)
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fas fa-poll"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">{{ $survey->name }}</span>
                              <span class="info-box-text">{{ date('d-m-Y', strtotime($survey->created_at)) }} </span>
                              <span class="info-box-number"><small>#</small>{{ $survey->answers->groupBy('user_id')->count() }} <small>participant.</small></span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    </section>
    <!-- /.content -->
</div>
@endsection
