@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ @$answers[0]->survey->name }}</h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm">
                    <div class="col-lg-12">
                      <h3 class="float-left">Survey Results</h3>
                      <a href="{{ route('analytics.analytics', $survey->id) }}" class="btn btn-outline-secondary float-right"><i class="fas fa-angle-left"></i> Back</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>{{ @$answers[0]->question->question }}</th>
                    </tr>
                    @foreach($answers as $answer)
                      <tr class="data-row">
                        <td>{{ $answer->input_value }}</td>
                      </tr>   
                    @endforeach
                  </tbody>
                </table>
                {{ $answers->render() }}
              </div>
              <!-- /.card-body -->
              
            </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
</div>
@endsection