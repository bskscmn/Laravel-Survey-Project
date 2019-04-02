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
              <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm">
                      <button class="btn btn-success" data-toggle="modal" data-target="#addNewModal"><i class="fas fa-user-plus"></i> Add New</button>
                  </div>
                </div>
              </div>
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
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.survey', $survey->id)}}" role="button"><i class="fas fa-eye"></i></a>
                            <button id="{{ $survey->id }}" data-item-id="{{ $survey->id }}" class="btn btn-info btn-sm edit-item" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-edit"></i></button>
                            <form action="{{ route('admin.surveydestroy', $survey->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit" onclick="return myFunction();"><i class="fa fa-trash"></i></button>
                            </form>
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
      <!-- Modal Add New -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewModalLabel">New Survey</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
                <div class="modal-body">
                  <div class="card">

                      <div class="card-body">
                          <form method="POST" action="{{ route('admin.surveystore') }}">
                              @csrf

                              <div class="form-group row">
                                  <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Survey') }}</label>

                                  <div class="col-md-8">
                                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Save') }}
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

      <!-- Modal Edit -->
        <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Survey Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
                <div class="modal-body" id="attachment-body-content">
                  <div class="card">

                      <div class="card-body">
                          <form id="edit-form" method="POST" action="{{ route('admin.surveyedit') }}">
                              @csrf
                              <input type="hidden" id="modal-input-id" name="id" value="">

                              <div class="form-group row">
                                  <label for="modal-input-name" class="col-md-2 col-form-label text-md-right">{{ __('Survey') }}</label>

                                  <div class="col-md-8">
                                      <input id="modal-input-name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Save') }}
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
      if(!confirm("Are you sure?"))
      event.preventDefault();
  }
</script>

@endsection