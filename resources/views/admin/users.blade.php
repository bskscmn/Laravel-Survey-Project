 @extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Kullanıcılar</h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm">
                      <button  class="btn btn-success" data-toggle="modal" data-target="#addNewModal"><i class="fas fa-user-plus"></i> Ekle</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>ID</th>
                      <th>Ad</th>
                      <th>Kullanıcı adı</th>
                      <th>E-mail</th>
                      <th>Rol</th>
                      <th>Aktif</th>
                      <th></th>
                    </tr>
                    @foreach($users as $user)
                      <tr class="data-row">
                        <td class="thisid">{{ $user->id }}</td>
                        <td class="thisname">{{ $user->name }}</td>
                        <td class="thisusername">{{ $user->username }}</td>
                        <td class="thisemail">{{ $user->email }}</td>
                        <td class="thisrole">
                          @foreach($user->roles as $urole){{ $urole->name }} @endforeach
                        </td>      
                        <td class="thisact">{{ $user->active }}</td>
                        <td>
                          <button id="{{ $user->id }}" data-item-id="{{ $user->id }}" class="btn btn-info btn-sm edit-item" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-edit"></i></button>
                          <form action="{{ route('admin.userdestroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return myFunction();"><i class="fa fa-trash"></i></button>
                          </form>
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
      <!-- Modal Add New User-->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewModalLabel">Kullanıcı Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
                <div class="modal-body">
                  <div class="card">

                      <div class="card-body">
                          <form method="POST" action="{{ route('admin.newuser') }}">
                              @csrf

                              <div class="form-group row">
                                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Ad') }}</label>

                                  <div class="col-md-6">
                                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                  <div class="col-md-6">
                                      <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                      @if ($errors->has('username'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('username') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                      @if ($errors->has('email'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Yetki') }}</label>

                                  <div class="col-md-6">
                                    <select id="role" name="role[]" class="selectpicker form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" multiple required>
                                      <option value="" selected disabled>-- Çoklu Seçim için Ctrl+ --</option>
                                      @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                      @endforeach
                                    </select>
                                      
                                      @if ($errors->has('role'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('role') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                       

                              <div class="form-group row">
                                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                  <div class="col-md-6">
                                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                      @if ($errors->has('password'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                  <div class="col-md-6">
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                  </div>
                              </div>

                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Ekle') }}
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

      <!-- Modal Edit User-->
        <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Kullanıcı Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
                <div class="modal-body" id="attachment-body-content">
                  <div class="card">

                      <div class="card-body">
                          <form id="edit-form" method="POST" action="{{ route('admin.edituser') }}">
                              @csrf
                              <input type="hidden" id="modal-input-id" name="id" value="">

                              <div class="form-group row">
                                  <label for="modal-input-name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                  <div class="col-md-6">
                                      <input id="modal-input-name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="modal-input-username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                  <div class="col-md-6">
                                      <input id="modal-input-username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                      @if ($errors->has('username'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('username') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="modal-input-email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                  <div class="col-md-6">
                                      <input id="modal-input-email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                      @if ($errors->has('email'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="modal-input-role" class="col-md-4 col-form-label text-md-right">{{ __('Yetki') }}</label>

                                  <div class="col-md-6">
                                    <select id="modal-input-role" name="role[]" class="selectpicker form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" multiple required>
                                      <option value="" disabled>-- Çoklu Seçim için Ctrl+ --</option>
                                      @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                      @endforeach
                                    </select>
                                      
                                      @if ($errors->has('role'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('role') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="modal-input-active" class="col-md-4 col-form-label text-md-right">{{ __('Aktif') }}</label>

                                  <div class="col-md-6">
                                      <input id="modal-input-active" type="text" class="form-control{{ $errors->has('active') ? ' is-invalid' : '' }}" name="active" value="{{ old('active') }}" required autofocus>

                                      @if ($errors->has('active'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('active') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                       

                              <div class="form-group row">
                                  <label for="modal-input-password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                  <div class="col-md-6">
                                      <input id="modal-input-password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" sometimes>

                                      @if ($errors->has('password'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="modal-input-password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                  <div class="col-md-6">
                                    <input id="modal-input-password-confirm" type="password" class="form-control" name="password_confirmation" sometimes>
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
    var username = row.children(".thisusername").text();
    var thisemail = row.children(".thisemail").text();
    var thisact = row.children(".thisact").text();
    var thisroletext = row.children(".thisrole").text().trim();
    var thisroles = [];
    thisroles = thisroletext.split(' ');

    $("#modal-input-id").val(id);
    $("#modal-input-name").val(name);
    $("#modal-input-username").val(username);
    $("#modal-input-email").val(thisemail);
    $("#modal-input-active").val(thisact);
    console.log(thisroles);

    var selectObj = $("#modal-input-role");

    for (var i = 0; i < $("#modal-input-role option").length; i++) {
      thisroles.forEach(function(thisrole) {
        if (selectObj.find('option').eq(i).text() === thisrole) {
            selectObj.find('option').eq(i).prop('selected', true)
            return;
        }
      });
    }

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