@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ $survey->name }}</h1>
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
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>#</th>
                      <th width="50%">Question</th>
                      <th>Total</th>
                    </tr>
                    @foreach($survey->questions as $question)
                      <tr class="data-row">
                        <td>{{ $question->question_number }}</td>
                        <td>
                          @if($question->questionType->id == 6)
                            <a href="{{ route('analytics.opens', [$survey->id, $question->id]) }}">{{ $question->question }}</a>
                          @else 
                            {{ $question->question }}
                          @endif
                        </td>
                        <td></td>                      
                      </tr>                     
                      @if($question->questionType->id != 6)

                        @if($question->questionType->id == 5)

                            @php($e=explode('|', $question->scaleType->type))
                           
                          <tr class="table-sm" >
                            <td></td>
                            <td class="table-secondary"></td>
                            <td class="table-secondary row" style="margin-right:0px !important"> 
                              @foreach($e as $key => $value)
                              <div class="col"> {{  $value }}</div>
                              @endforeach
                            </td> 
                          </tr>
                          @foreach($question->scaleQuestions as $scaleQuestion)
                             
                            <tr class="data-row table-sm">
                              <td></td>
                              <td class="table-secondary">{{ $scaleQuestion->question }}</td>
                              <td class="table-secondary row" style="margin-right:0px !important">
                                  @foreach($e as  $key => $val)
                                   <div class="col">{{  $scaleQuestion->scaleAnswers->where("scale_question_id", $scaleQuestion->id)->where("answer", $key+1)->count() }}</div>
                                  @endforeach
                              </td> 
                            </tr>
                          @endforeach
  
                        @else

                          @foreach($question->choices as $choice)
                            <tr class="data-row table-sm">
                              <td></td>
                              <td class="table-secondary">{{ $choice->choice }}</td>
                              <td class="table-secondary">{{ $choice->answers->count() }}
                              </td> 
                            </tr>
                          @endforeach

                          @if($question->questionType->id == 3 || $question->questionType->id == 4)
                            <tr class="table-sm">
                              <td></td>
                              <td class="table-secondary"><a href="{{ route('analytics.others', [$survey->id, $question->id]) }}">Diğer</a></td>
                              <td class="table-secondary">{{ $question->answers->where("choice_id", NULL)->count() }}
                              </td> 
                            </tr>
                          @endif
                        @endif
                          
                      @endif

                      
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