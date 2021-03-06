@extends('layouts.survey')

@section('content')
<form action="{{ route('surveystore', $survey->id)}}" method="post" class="col-sm-12 h-100 " name="surveyform">
	@csrf
	@if( $survey->questions->count() == 0 )
		<div class="col-sm-11 h-100">
			<a href="{{ route('welcome') }}"><button type="button" class="btn mb-5 mt-5 btn-xl btn-outline-secondary float-right">Survey Home</button></a>
			<div class="row h-100 align-items-center">
				<span class="m-auto">Survey doesn't have any question!</span>
			</div>
		</div>
	@else
		@foreach($survey->questions as $question)
		<div class="question col-sm-11 h-100" id="question-{{$question->question_number}}">
		  	<a href="{{ route('welcome') }}"><button type="button" class="btn mb-5 mt-5 btn-xl btn-outline-secondary float-right">Survey Home</button></a>
			@switch($question->question_type_id)
			    @case(1)
						
							<div class="row h-100 align-items-center">
								<div class="col-sm-10 ml-5" id="questionID-{{ $question->id }}">
					    		<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									<div class="control-group">
										@foreach($question->choices as $choice)
									    <label class="control control-radio">
									        {{ $choice->choice }}
									            <input type="radio" name="questionID-{{ $question->id }}" id="{{ $choice->id }}" value="{{ $choice->id }}"/>
									        <div class="control_indicator"></div>
									    </label>
									    @endforeach
									</div>

									<div class="btn-group btn-block" role="group" aria-label="Group">
										@if(!$loop->first)	
											<a href="#" role="button" class="previous btn btn-outline-success mt-5" ><i class="fas fa-caret-left fa-lg"></i> Back</a>
										@endif
										@if($loop->last)
											<button type="submit" class="btn btn-outline-success mt-5" >Next <i class="fas fa-caret-right fa-lg"></i></button>
										@else
											<a href="#" role="button" class="next btn btn-outline-success mt-5" >Next <i class="fas fa-caret-right fa-lg"></i></a>
										@endif
									</div>
								</div>
							</div>

        		@break

			    @case(2)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10  ml-5" id="questionID-{{ $question->id }}">

						    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>
									<div class="control-group">
										@foreach($question->choices as $choice)
								        <label class="control control-checkbox">
								            {{ $choice->choice }}
								            <input type="checkbox" name="questionID-{{ $question->id }}[]" id="{{ $choice->id }}" value="{{ $choice->id }}">
								            <div class="control_indicator"></div>
								        </label>
								        @endforeach
								    </div>
									<div class="btn-group btn-block" role="group" aria-label="Group">
										@if(!$loop->first)	
											<a href="#" role="button" class="previous btn btn-outline-success mt-5" ><i class="fas fa-caret-left fa-lg"></i> Back</a>
										@endif
										@if($loop->last)
											<button type="submit" class="btn btn-outline-success mt-5">Next <i class="fas fa-caret-right fa-lg"></i></button>
										@else
											<a href="#" role="button" class="next btn btn-outline-success mt-5">Next <i class="fas fa-caret-right fa-lg"></i></a>
										@endif
									</div>
								</div>
							</div>

			      @break

			    @case(3)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10  ml-5" id="questionID-{{ $question->id }}">

							    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									<div class="control-group">
										@foreach($question->choices as $choice)
									    <label class="control control-radio">
									        {{ $choice->choice }}
									            <input type="radio" name="questionID-{{ $question->id }}" id="{{ $choice->id }}" value="{{ $choice->id }}"/>
									        <div class="control_indicator"></div>
									    </label>
									    @endforeach
									
										<label class="control control-radio">
									    	Other
									  		<input type="radio" name="questionID-{{ $question->id }}" id="othercheck-{{ $question->id }}" value="0" onclick="if(this.checked){ document.getElementById('other-{{ $question->id }}').focus(); $('#other-{{ $question->id }}').attr('required'); }else{ $('#other-{{ $question->id }}').removeAttr('required'); }">
									  		<div class="control_indicator"></div>
									    </label>
									    <input type="text" class="form-control other" id="other-{{ $question->id }}" name="other-{{ $question->id }}" placeholder="Belirtiniz.">
									

									</div>

									<div class="btn-group btn-block" role="group" aria-label="Group">
										@if(!$loop->first)	
											<a href="#" role="button" class="previous btn btn-outline-success mt-5" ><i class="fas fa-caret-left fa-lg"></i> Back</a>
										@endif
										@if($loop->last)
											<button type="submit" class="btn btn-outline-success mt-5" >Next <i class="fas fa-caret-right fa-lg"></i></button>
										@else
											<a href="#" role="button" class="next btn btn-outline-success mt-5" >Next <i class="fas fa-caret-right fa-lg"></i></a>
										@endif
									</div>
								</div>
							</div>

			      @break

			    @case(4)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10  ml-5" id="questionID-{{ $question->id }}">

							    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

							    	<div class="control-group">
										@foreach($question->choices as $choice)
								        <label class="control control-checkbox">
								            {{ $choice->choice }}
								            <input type="checkbox" name="questionID-{{ $question->id }}[]" id="{{ $choice->id }}" value="{{ $choice->id }}">
								            <div class="control_indicator"></div>
								        </label>
								        @endforeach
										
									    <label class="control control-checkbox">
									  		Other
									  		<input type="checkbox" id="othercheck-{{ $question->id }}" name="questionID-{{ $question->id }}[]" value="0" onclick="if(this.checked){ document.getElementById('other-{{ $question->id }}').focus();  $('#other-{{ $question->id }}').attr('required'); }else{ document.getElementById('other-{{ $question->id }}').value=''; $('#other-{{ $question->id }}').removeAttr('required'); }">
									  		<div class="control_indicator"></div>
									  	</label> 
									  	<input type="text" class="form-control other" id="other-{{ $question->id }}" name="other-{{ $question->id }}" placeholder="Belirtiniz.">
									</div>

									<div class="btn-group btn-block" role="group" aria-label="Group">
										@if(!$loop->first)	
											<a href="#" role="button" class="previous btn btn-outline-success mt-5" ><i class="fas fa-caret-left fa-lg"></i> Back</a>
										@endif
										@if($loop->last)
											<button type="submit" class="btn btn-outline-success mt-5">Next <i class="fas fa-caret-right fa-lg"></i></button>
										@else
											<a href="#" role="button" class="next btn btn-outline-success mt-5">Next <i class="fas fa-caret-right fa-lg"></i></a>
										@endif
									</div>
								</div>
							</div>

			      @break

			    @case(5)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-12" id="questionID-{{ $question->id }}">

							    <h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

							    	@php($titles = explode("|", $question->scaleType->type ))
							    	@php($scale = count($titles))

										<table id="tablePreview" class="table">
										  <thead>
										    <tr>
										      <th>#</th>
										      @for($i=0; $i < $scale; $i++)
										      <th>{{ $titles[$i] }}</th>
										      @endfor
										    </tr>
										  </thead>
										  <tbody>
										  	@foreach($question->scaleQuestions as $scaleQuestion)
										    <tr>
										      	<th scope="row">{{ $scaleQuestion->soru }}</th>
										      	<div class="control-group">
											      	@for($i=0; $i < $scale; $i++)
									     			<td>
												      	<label class="control control-radio">
															<input type="radio" name="scaleQuestionID-{{ $scaleQuestion->id }}" value="{{ $i+1 }}">
															<div class="control_indicator"></div>
														</label>
												     </td>
									      			@endfor
								      			</div>
								      		</tr>
										    @endforeach
										  </tbody>
										</table>

									<div class="btn-group btn-block" role="group" aria-label="Group">
										@if(!$loop->first)	
											<a href="#" role="button" class="previous btn btn-outline-success mt-5" ><i class="fas fa-caret-left fa-lg"></i> Back</a>
										@endif
										@if($loop->last)
											<button type="submit" class="btn btn-outline-success mt-5" >Next <i class="fas fa-caret-right fa-lg"></i></button>
										@else
											<a href="#" role="button" class="next btn btn-outline-success mt-5" >Next <i class="fas fa-caret-right fa-lg"></i></a>
										@endif
									</div>
								</div>
							</div>

			      @break
					
					@case(6)

							<div class="row h-100 align-items-center">
								<div class="col-sm-12" id="questionID-{{ $question->id }}">

									<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									<div class="form-group">
								    <textarea class="form-control" name="questionID-{{ $question->id }}" rows="3"></textarea>
								  </div>

								    <div class="btn-group btn-block" role="group" aria-label="Group">
								    	@if(!$loop->first)	
											<a href="#" role="button" class="previous btn btn-outline-success mt-5" ><i class="fas fa-caret-left fa-lg"></i> Back</a>
										@endif
										@if($loop->last)
											<button type="submit" class="btn btn-outline-success mt-5" >Next <i class="fas fa-caret-right fa-lg"></i></button>
										@else
											<a href="#" role="button" class="next btn btn-outline-success mt-5" >Next <i class="fas fa-caret-right fa-lg"></i></a>
										@endif
									</div>
								</div>
							</div>

			    	@break

			    @default
			        Something went wrong!
			@endswitch
	  </div>
	@endforeach
	@endif
	
</form> 	

@endsection
@section('scripts')
<script>
	$( document ).ready(function() {
	    $('.question').hide();
	    $('.question:first').show();
	});
	
	$('.previous').on('click', function() {
			var prevQuestion = $(this).closest('.question').prev();
	    $('.question').hide();
	    prevQuestion.show(1000);
	});

	$('.next').on('click', function() {
			var nextQuestion = $(this).closest('.question').next();
	    $('.question').hide();
	    nextQuestion.show(1000);
	});

	$(".other").on("keyup", function(e){ 
		var checkid = this.id.split("-")[1]; 
	    if(this.value!=""){ 
	    	$('#othercheck-'+checkid).prop("checked", true);
	    }else{
	    	$('#othercheck-'+checkid).prop("checked", false);
	    }
	});

	
</script>
@endsection

