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
                      <h3 class="float-left">Anket Soruları</h3>
                      <button  class="btn btn-success float-right" data-toggle="modal" data-target="#addNewQuestion"><i class="fas fa-question-circle"></i> Soru Ekle</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>No</th>
                      <th width="50%">Soru</th>
                      <th>Soru Tipi</th>
                      <th></th>
                    </tr>
                    @foreach($survey->questions as $question)
                      <tr class="data-row baseQuestionLine">
                        <td class="thisnumber">{{ $question->question_number }}</td>
                        <td class="thissoru">{{ $question->soru }} </td>
                        <td class="thistype">{{ $question->questionType->type }}</td>    
                        <td>
                          <div class="btn-group float-right" role="group" aria-label="Buttons group">
                            
                            @if($question->questionType->id == 1 || $question->questionType->id == 2 || $question->questionType->id == 3 || $question->questionType->id == 4)
                              <button  class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewChoice" onclick="return setQuestionId({{ $question->id}});">Seçenek Ekle</button>
                            @elseif($question->questionType->id == 5 )
                              <button  class="btn btn-success btn-sm" data-toggle="modal" data-target="#createScale" onclick="return setQuestionIdScale({{ $question->id}});">Soru Ekle </button>
                            @endif

                            <button id="{{ $question->id }}"  data-qtype_id="{{ $question->questionType->id }}" class="btn btn-info btn-sm edit-item" data-toggle="modal" data-target="#edit-modal-question"><i class="fa fa-edit"></i>edit</button>

                            <a class="btn btn-danger btn-sm">
                              <form action="{{ route('admin.questiondestroy', $question->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit" onclick="return myFunction();"><i class="fa fa-trash"></i></button>
                              </form>
                            </a>

                          </div>
                        </td>                   
                      </tr>                     
                      @if($question->questionType->id != 6)

                        @if($question->questionType->id == 5)
                          <tr class="table-sm baseQuestionLine">
                            <td></td>
                            <td class="thischoice table-secondary" colspan="2" id="scale-{{$question->id}}"> {{ $question->scaleType->type }} </td>
                            <td class="table-secondary">
                            </td> 
                          </tr>
                          @foreach($question->scaleQuestions as $scaleQuestion)
                            <tr class="data-row table-sm trScaleQ" >
                              <td></td>
                              <td class="thischoice table-secondary" colspan="2">{{ $scaleQuestion->soru }}</td>
                              <td class="table-secondary">
                                <div class="btn-group float-right" role="group" aria-label="Buttons group">

                                  <button id="{{ $scaleQuestion->id }}" data-item-id="{{ $scaleQuestion->id }}" class="btn btn-info btn-sm edit-scaleQuestion" data-toggle="modal" data-target="#edit-modal-scaleQuestion"><i class="fa fa-edit"></i></button>
                                  <a class="btn btn-danger btn-sm">
                                    <form action="{{ route('admin.scalequestiondestroy', $scaleQuestion->id)}}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger btn-sm" type="submit" onclick="return myFunction();"><i class="fa fa-trash"></i></button>
                                    </form>
                                  </a>
                                </div>
                              </td> 
                            </tr>
                          @endforeach
  
                        @else

                          @foreach($question->choices as $choice)
                            <tr class="data-row table-sm" >
                              <td></td>
                              <td class="thischoice table-secondary" colspan="2">{{ $choice->choice }}</td>
                              <td class="table-secondary">
                                <div class="btn-group float-right" role="group" aria-label="Buttons group">

                                  <button id="{{ $choice->id }}" data-item-id="{{ $choice->id }}" class="btn btn-info btn-sm edit-choice" data-toggle="modal" data-target="#edit-modal-choice"><i class="fa fa-edit"></i></button>
                                  <a class="btn btn-danger btn-sm">
                                    <form action="{{ route('admin.choicedestroy', $choice->id)}}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger btn-sm" type="submit" onclick="return myFunction();"><i class="fa fa-trash"></i></button>
                                    </form>
                                  </a>
                                </div>
                              </td> 
                            </tr>
                          @endforeach

                          @if($question->questionType->id == 3 || $question->questionType->id == 4)
                            <tr class="table-sm baseQuestionLine">
                              <td></td>
                              <td class="thischoice table-secondary" colspan="2">Diğer</td>
                              <td class="table-secondary">
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
      
      <!-- Modal Add New Question-->
        <div class="modal fade" id="addNewQuestion" tabindex="-1" role="dialog" aria-labelledby="addNewQuestionLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewQuestionLabel">Soru Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              <div class="modal-body">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.questionstore', $survey->id ) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="questionNumber" class="col-md-2 col-form-label text-md-right">{{ __('No') }}</label>

                                <div class="col-md-2">
                                    <input id="questionNumber" type="text" class="form-control{{ $errors->has('questionNumber') ? ' is-invalid' : '' }}" name="questionNumber" value="{{ old('questionNumber') }}" required autofocus>

                                    @if ($errors->has('questionNumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('questionNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="soru" class="col-md-2 col-form-label text-md-right">{{ __('Soru') }}</label>

                                <div class="col-md-10">
                                    <input id="soru" type="text" class="form-control{{ $errors->has('soru') ? ' is-invalid' : '' }}" name="soru" value="{{ old('soru') }}" required autofocus>

                                    @if ($errors->has('soru'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('soru') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="questionType" class="col-md-2 col-form-label text-md-right">{{ __('Soru tipi') }}</label>

                                <div class="col-md-10">
                                  <select id="questionType" name="questionType" class="form-control{{ $errors->has('questionType') ? ' is-invalid' : '' }}" required>
                                    <option value="" selected disabled>--Seçiniz--</option>
                                    @foreach($questionTypes as $questionType)
                                      <option value="{{ $questionType->id }}">{{ $questionType->type }}</option>
                                    @endforeach
                                  </select>
                                    
                                    @if ($errors->has('questionType'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('questionType') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div id="scaleSelectbox" class="form-group row">
                                {{ __('Derecelendirme ölçütü') }}
                                <div class="col-md-12">
                                    @foreach($scaleTypes as $scaleType)
                                      <div class="radio">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="scaleType" id="s{{ $scaleType->id }}" value="{{ $scaleType->id }}">
                                          <label class="form-check-label" for="d2">{{ $scaleType->type }}
                                          </label>
                                        </div>
                                      </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Kaydet') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- Modal Edit Question-->
        <div class="modal fade" id="edit-modal-question" tabindex="-1" role="dialog" aria-labelledby="edit-modal-question-label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-question-label">Soru Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
                <div class="modal-body" id="attachment-body-content">
                  <div class="card">

                      <div class="card-body">
                          <form id="edit-form-question" method="POST" action="{{ route('admin.questionedit', $survey->id) }}">
                              @csrf
                              <input type="hidden" id="modal-input-id" name="id" value="">

                              <div class="form-group row">
                                  <label for="modal-input-questionNumber" class="col-md-2 col-form-label text-md-right">{{ __('No') }}</label>

                                  <div class="col-md-2">
                                      <input id="modal-input-questionNumber" type="text" class="form-control{{ $errors->has('question_number') ? ' is-invalid' : '' }}" name="question_number" value="{{ old('question_number') }}" required autofocus>

                                      @if ($errors->has('question_number'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('question_number') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                               <div class="form-group row">
                                  <label for="modal-input-soru" class="col-md-2 col-form-label text-md-right">{{ __('Soru') }}</label>

                                  <div class="col-md-10">
                                      <input id="modal-input-soru" type="text" class="form-control{{ $errors->has('soru') ? ' is-invalid' : '' }}" name="soru" value="{{ old('soru') }}" required autofocus>

                                      @if ($errors->has('soru'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('soru') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="modal-input-type" class="col-md-2 col-form-label text-md-right">{{ __('Soru tipi') }}</label>

                                  <div class="col-md-10">
                                    <select id="modal-input-type" name="question_type_id" class="form-control{{ $errors->has('question_type_id') ? ' is-invalid' : '' }}" required>
                                      <option value="" disabled>--Seçiniz--</option>
                                      @foreach($questionTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                                      @endforeach
                                    </select>
                                      
                                      @if ($errors->has('question_type_id'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('question_type_id') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>  

                              <div class="form-group row" id="scaleSelectboxedit">
                                  <label for="modal-input-scaleType" class="col-md-2 col-form-label text-md-right">{{ __('Derece') }}</label>

                                  <div class="col-md-10">
                                    <select id="modal-input-scaleType" name="scale_type" class="form-control{{ $errors->has('scale_type') ? ' is-invalid' : '' }}" >
                                      <option value="" disabled>--Seçiniz--</option>
                                      @foreach($scaleTypes as $scaleType)
                                        <option value="{{ $scaleType->id }}">{{ $scaleType->type }}</option>
                                      @endforeach
                                    </select>
                                      
                                      @if ($errors->has('scale_type_id'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('scale_type_id') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>  

                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Kaydet') }}
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
                
              </form>
            </div>
          </div>
        </div>

      <!-- Modal Add New Choice-->
        <div class="modal fade" id="addNewChoice" tabindex="-1" role="dialog" aria-labelledby="addNewChoiceLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewChoiceLabel">Seçenek Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              <div class="modal-body">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.choicestore', $survey->id ) }}">
                            @csrf
                            <input type="hidden" id="modal-input-questionid" name="question_id" value="">
                            

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <input id="choice" type="text" class="form-control{{ $errors->has('choice') ? ' is-invalid' : '' }}" name="choice" value="{{ old('choice') }}" placeholder="Seçenek" required autofocus>

                                    @if ($errors->has('choice'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('choice') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Kaydet') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- Modal Edit Choice-->
        <div class="modal fade" id="edit-modal-choice" tabindex="-1" role="dialog" aria-labelledby="edit-modal-choice-label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-choice-label">Seçenek Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
                <div class="modal-body" id="attachment-body-content">
                  <div class="card">

                      <div class="card-body">
                          <form id="edit-form-choice" method="POST" action="{{ route('admin.choiceedit', $survey->id) }}">
                              @csrf
                              <input type="hidden" id="modal-input-choiceid" name="id" value="">

                               <div class="form-group row">
                                  <div class="col-md-12">
                                      <input id="modal-input-choice" type="text" class="form-control{{ $errors->has('choice') ? ' is-invalid' : '' }}" name="choice" value="{{ old('choice') }}" placeholder="Seçenek" required autofocus>

                                      @if ($errors->has('choice'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('choice') }}</strong>
                                        </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Kaydet') }}
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
                
              </form>
            </div>
          </div>
        </div>

      <!-- Modal Add Scale Question-->
        <div class="modal fade" id="createScale" tabindex="-1" role="dialog" aria-labelledby="createScaleLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="createScaleLabel">Soru Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              <div class="modal-body">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.createscalequestion', $survey->id ) }}">
                            @csrf
                            <input type="hidden" id="modal-input-questionid-scale" name="question_id" value="">
                            <div class="form-group row">
                                <label for="questionNumber" class="col-md-2 col-form-label text-md-right">{{ __('No') }}</label>

                                <div class="col-md-2">
                                    <input id="questionNumber" type="text" class="form-control{{ $errors->has('questionNumber') ? ' is-invalid' : '' }}" name="questionNumber" value="{{ old('questionNumber') }}" required autofocus>

                                    @if ($errors->has('questionNumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('questionNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="soru" class="col-md-2 col-form-label text-md-right">{{ __('Soru') }}</label>

                                <div class="col-md-10">
                                    <input id="soru" type="text" class="form-control{{ $errors->has('soru') ? ' is-invalid' : '' }}" name="soru" value="{{ old('soru') }}" required autofocus>

                                    @if ($errors->has('soru'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('soru') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Kaydet') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
                
            </div>
          </div>
        </div>  

    </section>
    <!-- /.content -->
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {

  /**
   * for New Question Modal -> Scale options show and hide
   */
  
  $('#addNewQuestion').on('shown.bs.modal', function () {
    $('#scaleSelectbox').hide();

    //function when select is changing. 
    $("#questionType").on('change', function() {
        if ($("#questionType").val() == 5 ) { //Derecelendirme
           $("#scaleSelectbox").show();
        } else  {
          var checkedSelectTypeElement = document.querySelector('input[name="scaleType"]:checked');
          if(checkedSelectTypeElement != null){
            document.querySelector('input[name="scaleType"]:checked').checked = false; 
          }
          $("#scaleSelectbox").hide();
        }
    });
  });

  
  /**
   * for Question Edit Modal -> Scale options show and hide
   */
  // on modal edit question
  $(document).on('click', ".edit-item", function() {

    var id = this.id; 
    var row = $(this).closest(".data-row");
    var number = row.children(".thisnumber").text();
    var soru = row.children(".thissoru").text();
    var thistype = row.children(".thistype").text().trim();
    var thisScaleType = $('#scale-'+id).text().trim();
    var questionTypeId = $(this).data('qtype_id'); 
    

    var selectObj = $("#modal-input-type");
    var selectObj2 = $("#modal-input-scaleType");    

    //Set form values for edit

    $("#modal-input-id").val(id);
    $("#modal-input-questionNumber").val(number);
    $("#modal-input-soru").val(soru);

    for (var i = 0; i < $("#modal-input-type option").length; i++) {
          
        if (selectObj.find('option').eq(i).text() === thistype) {
            selectObj.find('option').eq(i).prop('selected', true)
        }
    }

    for (var j = 0; j < $("#modal-input-scaleType option").length; j++) {
          
        if (selectObj2.find('option').eq(j).text() === thisScaleType) {
            selectObj2.find('option').eq(j).prop('selected', true)
        }
    }

    if(questionTypeId == 5 ){ //Scale Question
      $('#scaleSelectboxedit').show();
    }else{
      $('#scaleSelectboxedit').hide();
    }

    // on question type change -> show hide scale type

    selectObj.on('change', function() {

        if ($("#modal-input-type").val() == 5 ) { //Scale Question
           $("#scaleSelectboxedit").show();
        } else  {
          $('#modal-input-scaleType').prop('selectedIndex', 0);
          $("#scaleSelectboxedit").hide();
        }
     
    });
    

    /* Restrictions of question type edit
     * If question has choices or scale questions selectbos will be disabled.
     */
    
    if(questionTypeId == 1 || questionTypeId == 2) { 

      var nextTR = $(this).closest('tr').next('tr');

      if(nextTR.length != 0 && !nextTR.hasClass('baseQuestionLine')) { 
        $('#modal-input-type').prop('disabled', 'disabled');
      }else{
        $('#modal-input-type').prop('disabled', false);
      }

    }else if(questionTypeId == 3 || questionTypeId == 4) { 

      var nextTR = $(this).closest('tr').next('tr');

      if(!nextTR.hasClass('baseQuestionLine')) {
        $('#modal-input-type').prop('disabled', 'disabled');
      }else{
        $('#modal-input-type').prop('disabled', false);
      }
      
    }else if(questionTypeId == 5){ 

      var next2TR = $(this).closest('tr').next('tr').next('tr');

      if(next2TR.length != 0 && !next2TR.hasClass('baseQuestionLine')){
        $('#modal-input-type').prop('disabled', 'disabled');
      }else{
        $('#modal-input-type').prop('disabled', false);
      }
    
    }else if(questionTypeId == 6){ 

      $('#modal-input-type').prop('disabled', false);

    }
    
  });


  // on modal edit choice
  $(document).on('click', ".edit-choice", function() {

    var id = this.id; 
    var row = $(this).closest(".data-row");
    var choice = row.children(".thischoice").text();

    $("#modal-input-choiceid").val(id);
    $("#modal-input-choice").val(choice);
    
  });

  // reset form on edit-modal-question hide 
  $('#edit-modal-question').on('hide.bs.modal', function() {
    $("#edit-form-question").trigger("reset");
  });

  // reset form on edit-modal-choice hide 
  $('#edit-modal-choice').on('hide.bs.modal', function() {
    $("#edit-form-choice").trigger("reset");
  });
 
});

  //Delete confirm alert
  function myFunction() {
      if(!confirm("Silmek istediğinize emin misiniz?"))
      event.preventDefault();
  }

  // Set form hidden value for Add New Choice
  function setQuestionId($questionid) {
      $("#modal-input-questionid").val($questionid);
  }

  // Set form hidden value for Add Scale Question
  function setQuestionIdScale($questionid) {
      $("#modal-input-questionid-scale").val($questionid);
  }

</script>

@endsection