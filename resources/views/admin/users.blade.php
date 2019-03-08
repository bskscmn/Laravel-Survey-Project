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
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          @foreach($user->roles as $urole)
                          {{ $urole->name }} 
                          @endforeach
                        </td>      
                        <td>{{ $user->act }}</td>
                        <td>
                        </td>                   
                      </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>
        </div>
      </div>
      <!-- Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
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
                                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Yetki') }}</label>

                                  <div class="col-md-6">
                                    <select id="role" name="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" required>
                                      <option value="" selected disabled>--Seçiniz--</option>
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
                                          {{ __('Register') }}
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
