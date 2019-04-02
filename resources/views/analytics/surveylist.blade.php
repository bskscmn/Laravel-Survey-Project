@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Surveys</h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th></th>
                    </tr>
                    @foreach($surveys as $survey)
                      <tr class="data-row">
                        <td class="thisid">{{ $survey->id }}</td>
                        <td class="thisname">{{ $survey->name }}</td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Buttons group">
                            <a class="btn btn-primary btn-sm" href="{{ route('analytics.analytics', $survey->id)}}" role="button"><i class="fas fa-eye"></i></a>
                          </div>
                        </td>                   
                      </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
@endsection