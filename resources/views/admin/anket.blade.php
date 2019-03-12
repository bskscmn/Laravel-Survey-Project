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
                      <button  class="btn btn-success" data-toggle="modal" data-target="#addNewModal"><i class="fas fa-question-circle"></i> Soru Ekle</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <p>ID: {{ $anket->id }}</p>
                <p>Anket: {{ $anket->name }}</p>  
                <div><p>AnketSoruları: </p>  
                  @foreach($anket->questions as $question)
                  {{ $question->soru }}  <br/> 
                  @endforeach
                </div>
              </div>
              <!-- /.card-body -->
              
            </div>
        </div>
      </div>
      
      <!-- Modal Add New -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewModalLabel">Soru Ekle</h5>
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
                                  <label for="questionType" class="col-md-4 col-form-label text-md-right">{{ __('Soru tipi') }}</label>

                                  <div class="col-md-6">
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

  $(document).on('click', ".edit-item", function() {

    var id = this.id; 
    var row = $(this).closest(".data-row");
    var name = row.children(".thisname").text();

    $("#modal-input-id").val(id);
    $("#modal-input-name").val(name);

  });

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $("#edit-form").trigger("reset");
  });
 
})
  function myFunction() {
      if(!confirm("Silmek istediğinize emin misiniz?"))
      event.preventDefault();
  }
</script>

@endsection