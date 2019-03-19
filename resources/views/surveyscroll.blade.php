@extends('layouts.survey')

@section('content')
<form action="{{ route('surveystore', $survey->id)}}" method="post" class="col-sm-12 h-100 ">
	@csrf
	<input type="hidden" name="anketid" value="{{$survey->id}}">
	@foreach($survey->questions as $question)
		<div class="question col-sm-11 h-100" id="question-{{$question->question_number}}">
		  	
			@switch($question->question_type_id)
			    @case(1)
						
							<div class="row h-100 align-items-center">
								<div class="col-sm-10 ml-5 ">
					    		<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									@foreach($question->choices as $choice)
								    	<div class="form-check">
										  <input class="form-check-input" type="radio" name="{{ $question->id }}" id="{{ $choice->id }}" value="{{ $choice->id }}">
										  <label class="form-check-label" for="{{ $choice->id }}">
										    {{ $choice->choice }}
										  </label>
										</div>
									@endforeach

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>

        		@break

			    @case(2)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10 ml-5 ">

						    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									@foreach($question->choices as $choice)
								    	<div class="form-check">
										  <input class="form-check-input" type="checkbox" name="{{ $question->id }}" id="{{ $choice->id }}" value="{{ $choice->id }}">
										  <label class="form-check-label" for="{{ $choice->id }}">
										    {{ $choice->choice }}
										  </label>
										</div>
									@endforeach

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>

			      @break

			    @case(3)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10 ml-5 ">

							    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									@foreach($question->choices as $choice)
								    	<div class="form-check">
										  <input class="form-check-input" type="radio" name="{{ $question->id }}" id="{{ $choice->id }}" value="{{ $choice->id }}">
										  <label class="form-check-label" for="{{ $choice->id }}">
										    {{ $choice->choice }}
										  </label>
										</div>
									@endforeach
									
									<div class="form-check">
									  <input class="form-check-input" type="radio" name="{{ $question->id }}" id="{{ $choice->id }}" value="0"
									  onclick="if(this.checked){ document.getElementById('other-{{ $question->id }}').focus();}">
									  <label class="form-check-label" for="{{ $choice->id }}">
									    Diğer <input type="text" class="form-control other" id="other-{{ $question->id }}" name="other-{{ $question->id }}" placeholder="Belirtiniz.">
									  </label>
									</div>

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>

			      @break

			    @case(4)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10 ml-5 ">

							    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									@foreach($question->choices as $choice)
								    	<div class="form-check">
										  <input class="form-check-input" type="checkbox" name="{{ $question->id }}" id="{{ $choice->id }}" value="{{ $choice->id }}">
										  <label class="form-check-label" for="{{ $choice->id }}">
										    {{ $choice->choice }}
										  </label>
										</div>
									@endforeach

									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="othercheck-{{ $question->id }}" name="{{ $question->id }}" value="0"  
									  onclick="if(this.checked){ document.getElementById('other-{{ $question->id }}').focus();}">
									  <label class="form-check-label" for="{{ $choice->id }}">
									    Diğer
									  </label> 
									  <input type="text" class="form-control other" id="other-{{ $question->id }}" name="other-{{ $question->id }}" placeholder="Belirtiniz.">
									</div>

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>

			      @break

			    @case(5)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-12">

							    <h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

							    	@php($titles = explode("|", $question->scaleType->type ))

							    	@switch($question->scaleType->id)
			    						@case(1)

												<table id="tablePreview" class="table">
												  <thead>
												    <tr>
												      <th>#</th>
												      <th>{{ $titles[0] }}</th>
												      <th>{{ $titles[1] }}</th>
												    </tr>
												  </thead>
												  <tbody>
												  	@foreach($question->scaleQuestions as $scaleQuestion)
												    <tr>
												      <th scope="row">{{ $scaleQuestion->soru }}</th>
												      <td></td>
												      <td></td>
												    </tr>
												    @endforeach
												  </tbody>
												</table>

			    							@break

			    						@case(2)

			    							<table id="tablePreview" class="table">
												  <thead>
												    <tr>
												      <th>#</th>
												      <th>{{ $titles[0] }}</th>
												      <th>{{ $titles[1] }}</th>
												      <th>{{ $titles[2] }}</th>
												    </tr>
												  </thead>
												  <tbody>
												    @foreach($question->scaleQuestions as $scaleQuestion)
												    <tr>
												      <th scope="row">{{ $scaleQuestion->soru }}</th>
												      <td></td>
												      <td></td>
												    </tr>
												    @endforeach
												  </tbody>
												</table>

			    							@break

			    						@case(3)

			    							<table id="tablePreview" class="table">
												  <thead>
												    <tr>
												      <th>#</th>
												      <th>{{ $titles[0] }}</th>
												      <th>{{ $titles[1] }}</th>
												      <th>{{ $titles[2] }}</th>
												      <th>{{ $titles[3] }}</th>
												      <th>{{ $titles[4] }}</th>
												    </tr>
												  </thead>
												  <tbody>
												    @foreach($question->scaleQuestions as $scaleQuestion)
												    <tr>
												      <th scope="row">{{ $scaleQuestion->soru }}</th>
												      <td></td>
												      <td></td>
												    </tr>
												    @endforeach
												  </tbody>
												</table>

			    							@break

			    						@case(4)

			    							<table id="tablePreview" class="table">
												  <thead>
												    <tr>
												      <th>#</th>
												      <th>First Name</th>
												      <th>Last Name</th>
												      <th>Username</th>
												      <th>Visits</th>
												      <th>Age</th>
												    </tr>
												  </thead>
												  <tbody>
												    @foreach($question->scaleQuestions as $scaleQuestion)
												    <tr>
												      <th scope="row">{{ $scaleQuestion->soru }}</th>
												      <td></td>
												      <td></td>
												    </tr>
												    @endforeach
												  </tbody>
												</table>

			    							@break

			    						@case(5)

												<table id="tablePreview" class="table">
												  <thead>
												    <tr>
												      <th>#</th>
												      <th>First Name</th>
												      <th>Last Name</th>
												      <th>Username</th>
												      <th>Visits</th>
												      <th>Age</th>
												      <th>Country</th>
												      <th>First Name</th>
												      <th>Last Name</th>
												      <th>Username</th>
												      <th>Visits</th>
												    </tr>
												  </thead>

												  <tbody>
												    @foreach($question->scaleQuestions as $scaleQuestion)
												    <tr>
												      <th scope="row">{{ $scaleQuestion->soru }}</th>
												      <td></td>
												      <td></td>
												    </tr>
												    @endforeach
												  </tbody>
												</table>

			    							@break

			    						@default
								        Something went wrong!
										@endswitch
									
									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>
						

			      @break

			    @default
			        Something went wrong!
			@endswitch
	  </div>
	@endforeach
	


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
	$(".other").on("keyup", function(e){ 
		var checkid = this.id.split("-")[1];
	    if(this.value!=""){ console.log($('#othercheck-'+checkid));
	    	$('#othercheck-'+checkid).prop("checked", true);
	    }else{
	    	$('#othercheck-'+checkid).prop("checked", false);
	    }
	});
</script>
@endsection

