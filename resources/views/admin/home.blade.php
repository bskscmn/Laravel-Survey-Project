@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard</h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Giriş Yapıldı.
                </div>
            </div>
        </div>
    </div>

    </section>
    <!-- /.content -->
</div>
@endsection
