 @extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ $anket->name }}</h1>
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
                      <h3 class="float-left">AnketSoruları</h3>
                      <button  class="btn btn-success float-right" data-toggle="modal" data-target="#addNewQuestion"><i class="fas fa-question-circle"></i> Soru Ekle</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover">
                  <tbody>
                    @foreach($anket->questions as $question)
                      <tr class="data-row">
                        <td class="thisnumber">{{ $question->question_number }}</td>
                        <td class="thissoru">{{ $question->soru }}</td>
                        <td class="thistype">{{ $question->question_type->type }}</td>    
                        <td>
                          <div class="btn-group float-right" role="group" aria-label="Buttons group">
                            @if($question->question_type->id == 1)
                            <button  class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewChoice" onclick="return setQuestionId({{ $question->id}});">Seçenek Ekle
                            @endif
                            <button id="{{ $question->id }}" data-item-id="{{ $question->id }}" class="btn btn-info btn-sm edit-item" data-toggle="modal" data-target="#edit-modal-question"><i class="fa fa-edit"></i></button>

                            <form action="{{ route('admin.questiondestroy', $question->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit" onclick="return myFunction();"><i class="fa fa-trash"></i></button>
                            </form>
                          </div>
                        </td>                   
                      </tr>                     
                      @if($question->question_type->id == 1)

                          @foreach($question->choices as $choice)
                            <tr class="data-row table-sm" >
                              <td></td>
                              <td class="thischoice table-secondary" colspan="2">{{ $choice->choice }}</td>
                              <td class="table-secondary">
                                <div class="btn-group float-right" role="group" aria-label="Buttons group">

                                  <button id="{{ $choice->id }}" data-item-id="{{ $choice->id }}" class="btn btn-info btn-sm edit-choice" data-toggle="modal" data-target="#edit-modal-choice"><i class="fa fa-edit"></i></button>

                                  <form action="{{ route('admin.choicedestroy', $choice->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return myFunction();"><i class="fa fa-trash"></i></button>
                                  </form>
                                </div>
                              </td> 
                            </tr>
                          @endforeach

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
                          <form method="POST" action="{{ route('admin.questionstore', $anket->id ) }}">
                              @csrf
                              <div class="form-group row">
                                  <label for="questionNumber" class="col-md-2 col-form-label text-md-right">{{ __('Soru No') }}</label>

                                  <div class="col-md-8">
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

                                  <div class="col-md-8">
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

                                  <div class="col-md-8">
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
      <!-- Modal Edit Question-->
        <div class="modal fade" id="edit-modal-question" tabindex="-1" role="dialog" aria-labelledby="edit-modal-question-label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
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
                          <form id="edit-form-question" method="POST" action="{{ route('admin.questionedit', $anket->id) }}">
                              @csrf
                              <input type="hidden" id="modal-input-id" name="id" value="">

                              <div class="form-group row">
                                  <label for="modal-input-questionNumber" class="col-md-4 col-form-label text-md-right">{{ __('soru no') }}</label>

                                  <div class="col-md-6">
                                      <input id="modal-input-questionNumber" type="text" class="form-control{{ $errors->has('question_number') ? ' is-invalid' : '' }}" name="question_number" value="{{ old('question_number') }}" required autofocus>

                                      @if ($errors->has('question_number'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('question_number') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                               <div class="form-group row">
                                  <label for="modal-input-soru" class="col-md-4 col-form-label text-md-right">{{ __('Soru') }}</label>

                                  <div class="col-md-6">
                                      <input id="modal-input-soru" type="text" class="form-control{{ $errors->has('soru') ? ' is-invalid' : '' }}" name="soru" value="{{ old('soru') }}" required autofocus>

                                      @if ($errors->has('soru'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('soru') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="modal-input-type" class="col-md-4 col-form-label text-md-right">{{ __('Soru tipi') }}</label>

                                  <div class="col-md-6">
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
                          <form method="POST" action="{{ route('admin.choicestore', $anket->id ) }}">
                              @csrf
                              <input type="hidden" id="modal-input-questionid" name="question_id" value="">
                              

                              <div class="form-group row">

                                  <div class="col-md-8">
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
                
              </form>
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
                          <form id="edit-form-choice" method="POST" action="{{ route('admin.choiceedit', $anket->id) }}">
                              @csrf
                              <input type="hidden" id="modal-input-choiceid" name="id" value="">

                               <div class="form-group row">
                                  <label for="modal-input-choice" class="col-md-4 col-form-label text-md-right">{{ __('Seçenek') }}</label>

                                  <div class="col-md-6">
                                      <input id="modal-input-choice" type="text" class="form-control{{ $errors->has('choice') ? ' is-invalid' : '' }}" name="choice" value="{{ old('choice') }}" required autofocus>

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

    </section>
    <!-- /.content -->
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
  /**
   * for showing edit item popup
   */
  // on modal edit question
  $(document).on('click', ".edit-item", function() {

    var id = this.id; 
    var row = $(this).closest(".data-row");
    var number = row.children(".thisnumber").text();
    var soru = row.children(".thissoru").text();
    var thistype = row.children(".thistype").text().trim();

    $("#modal-input-id").val(id);
    $("#modal-input-questionNumber").val(number);
    $("#modal-input-soru").val(soru);

    var selectObj = $("#modal-input-type");

    for (var i = 0; i < $("#modal-input-type option").length; i++) {
          
        if (selectObj.find('option').eq(i).text() === thistype) {
            selectObj.find('option').eq(i).prop('selected', true)
            return;
        }
    }
    
  });

  // on modal hide
  $('#edit-modal-question').on('hide.bs.modal', function() {
    $("#edit-form-question").trigger("reset");
  });

  // on modal edit choice
  $(document).on('click', ".edit-choice", function() {

    var id = this.id; 
    var row = $(this).closest(".data-row");
    var choice = row.children(".thischoice").text();

    $("#modal-input-choiceid").val(id);
    $("#modal-input-choice").val(choice);
    
  });

  // on modal hide
  $('#edit-modal-choice').on('hide.bs.modal', function() {
    $("#edit-form-choice").trigger("reset");
  });
 
});

  function myFunction() {
      if(!confirm("Silmek istediğinize emin misiniz?"))
      event.preventDefault();
  }
  function setQuestionId($questionid) {
      $("#modal-input-questionid").val($questionid);
  }
</script>

@endsection