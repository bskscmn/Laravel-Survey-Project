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
              
              <!-- /.card-header -->
              <div class="card-body">
                <p>ID: {{ $anket->id }}</p>
                <p>Anket: {{ $anket->name }}</p>     
              </div>
              <!-- /.card-body -->
              
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