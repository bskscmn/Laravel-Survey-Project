@extends('layouts.survey')

@section('content')
<form action="{{ route('surveysubmit')}}" method="post" class="col-sm-12 h-100 ">
	@csrf
	<div class="question col-sm-10 h-100 " id="1">
	  <div class="row h-100 align-items-center">
	  	<div class="col-sm-10 ml-5 ">
	    <h2>Title of the question 1</h2>

	    	<div class="form-check">
			  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
			  <label class="form-check-label" for="exampleRadios1">
			    Default radio
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
			  <label class="form-check-label" for="exampleRadios2">
			    Second default radio
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
			  <label class="form-check-label" for="exampleRadios3">
			    Disabled radio
			  </label>
			</div>	 
			<a href="#" role="button" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
		</div>    
	  </div>
	</div>

	<div class="question col-sm-10 h-100 " id="2">
	  <div class="row h-100 align-items-center">
	  	<div class="col-sm-10 ml-5 ">
	    <h2>Title of the question 2</h2>

	    	<div class="form-check">
			  <input class="form-check-input" type="radio" name="Radios" id="exampleRadios4" value="option1">
			  <label class="form-check-label" for="exampleRadios4">
			    Default radio
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="Radios" id="exampleRadios5" value="option2">
			  <label class="form-check-label" for="exampleRadios5">
			    Second default radio
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="Radios" id="exampleRadios6" value="option3" disabled>
			  <label class="form-check-label" for="exampleRadios6">
			    Disabled radio
			  </label>
			</div>
			<a href="#" role="button" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
		</div>    
	  </div>
	</div>

	<div class="question col-sm-10 h-100 " id="3">
	  <div class="row h-100 align-items-center">
	  	<div class="col-sm-10 ml-5 ">
	    <h2>Title of the question 3</h2>

	    	<div class="form-group">
	        <label for="formGroupExampleInput">Example label</label>
	        <input type="text" class="form-control" id="formGroupExampleInput" name="formGroupExampleInput" placeholder="Example input">
	      </div>
	      <div class="form-group">
	        <label for="formGroupExampleInput2">Another label</label>
	        <input type="text" class="form-control" id="formGroupExampleInput2" name="formGroupExampleInput2" placeholder="Another input">
	      </div> 
			<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
		</div>    
	  </div>
	</div> 
</form> 	

@endsection
@section('scripts')
<script>
	$( document ).ready(function() {
	    $('.question').hide();
	    $('.question:first').show();

	});
	$('.btn').on('click', function() {
	    var nextQuestion = $(this).closest('.question').next();
	    $('.question').hide();
	    nextQuestion.show(1000);
	});

</script>
@endsection

