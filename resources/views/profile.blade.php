 @extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Profil</h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row justify-content-center">
        <div class="col-md-8">

              <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-success">
                  <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="/images/profile.png" alt="User Avatar">
                  </div>
                  <!-- /.widget-user-image -->
                  <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                  <h5 class="widget-user-desc">{{ Auth::user()->username }}</h5>
                </div>
                <!-- form start -->
                <form action="{{ route('profileupdate', Auth::user()->id)}}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label>Ad Soyad</label>
                      <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                    </div>

                    <div class="form-group">
                      <label>Kullanıcı Adı</label>
                      <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}">
                    </div>

                    <div class="form-group">
                      <label>E-posta</label>
                      <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                    </div>

                    <div class="form-group">
                      <label>Şifre</label>
                      <input type="password" name="password" class="form-control">
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                  </div>
                </form>
              </div>
            </div>
      </div>

    </section>
    <!-- /.content -->
</div>
@endsection
