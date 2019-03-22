@extends('layouts.survey')

@section('content')
<form action="{{ route('surveystore', $survey->id)}}" method="post" class="col-sm-12 h-100 " name="surveyform">
	@csrf
	@foreach($survey->questions as $question)
		<div class="question col-sm-11 h-100" id="question-{{$question->question_number}}">
		  	
			@switch($question->question_type_id)
			    @case(1)
						
							<div class="row h-100 align-items-center">
								<div class="col-sm-10 ml-5" id="questionID-{{ $question->id }}">
					    		<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									@foreach($question->choices as $choice)
								    	<div class="form-check">
											  <input class="form-check-input" type="radio" name="questionID-{{ $question->id }}" id="{{ $choice->id }}" value="{{ $choice->id }}">
											  <label class="form-check-label" for="{{ $choice->id }}">
											    {{ $choice->choice }}
											  </label>
											</div>
									@endforeach

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" id="buttonID-{{ $question->id }}"  class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>

        		@break

			    @case(2)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10  ml-5" id="questionID-{{ $question->id }}">

						    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									@foreach($question->choices as $choice)
							    	<div class="form-check">
										  <input class="form-check-input" type="checkbox" name="questionID-{{ $question->id }}[]" id="{{ $choice->id }}" value="{{ $choice->id }}">
										  <label class="form-check-label" for="{{ $choice->id }}">
										    {{ $choice->choice }}
										  </label>
										</div>
									@endforeach

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5">Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" id="buttonID-{{ $question->id }}" class="btn btn-outline-success btn-block mt-5">Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>

			      @break

			    @case(3)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10  ml-5" id="questionID-{{ $question->id }}">

							    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									@foreach($question->choices as $choice)
								    <div class="form-check">
										  <input class="form-check-input" type="radio" name="questionID-{{ $question->id }}" id="{{ $choice->id }}" value="{{ $choice->id }}" onclick="if(this.checked){ document.getElementById('other-{{ $question->id }}').value='';}">
										  <label class="form-check-label" for="{{ $choice->id }}">
										    {{ $choice->choice }}
										  </label>
										</div>
									@endforeach
									
									<div class="form-check">
									  <input class="form-check-input" type="radio" name="questionID-{{ $question->id }}" id="othercheck-{{ $question->id }}" value="0"
									  onclick="if(this.checked){ document.getElementById('other-{{ $question->id }}').focus(); $('#other-{{ $question->id }}').attr('required'); }else{ $('#other-{{ $question->id }}').removeAttr('required'); }">
									  <label class="form-check-label" for="other-{{ $question->id }}">
									    Diğer <input type="text" class="form-control other" id="other-{{ $question->id }}" name="other-{{ $question->id }}" placeholder="Belirtiniz.">
									  </label>
									</div>

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" id="buttonID-{{ $question->id }}" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>

			      @break

			    @case(4)
			    	
							<div class="row h-100 align-items-center">
								<div class="col-sm-10  ml-5" id="questionID-{{ $question->id }}">

							    	<h2>{{ $question->question_number }}. {{ $question->soru }}</h2>

									@foreach($question->choices as $choice)
								    <div class="form-check">
										  <input class="form-check-input" type="checkbox" name="questionID-{{ $question->id }}[]" id="{{ $choice->id }}" value="{{ $choice->id }}">
										  <label class="form-check-label" for="{{ $choice->id }}">
										    {{ $choice->choice }}
										  </label>
										</div>
									@endforeach

									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="othercheck-{{ $question->id }}" name="questionID-{{ $question->id }}[]" value="0"  
									  onclick="if(this.checked){ document.getElementById('other-{{ $question->id }}').focus();  $('#other-{{ $question->id }}').attr('required'); }else{ document.getElementById('other-{{ $question->id }}').value=''; $('#other-{{ $question->id }}').removeAttr('required'); }">
									  <label class="form-check-label" for="other-{{ $question->id }}">
									    Diğer
									  </label> 
									  <input type="text" class="form-control other" id="other-{{ $question->id }}" name="other-{{ $question->id }}" placeholder="Belirtiniz.">
									</div>

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5">Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" id="buttonID-{{ $question->id }}" class="btn btn-outline-success btn-block mt-5">Devam <i class="fas fa-play"></i></a>
									@endif
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
										      @for($i=0; $i < $scale; $i++)
								     				<td>
											      	<div class="form-check">
															  <input class="form-check-input" type="radio" name="scaleQuestionID-{{ $scaleQuestion->id }}" value="{{ $i+1 }}/{{ $scale }}">
															</div>
											      </td>
								      		@endfor
										    @endforeach
										  </tbody>
										</table>

									@if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" id="buttonID-{{ $question->id }}" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
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

								  @if($loop->last)
										<button type="submit" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></button>
									@else
										<a href="#" role="button" id="buttonID-{{ $question->id }}" class="btn btn-outline-success btn-block mt-5" >Devam <i class="fas fa-play"></i></a>
									@endif
								</div>
							</div>

			    	@break

			    @default
			        Something went wrong!
			@endswitch
	  </div>
	@endforeach
	
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
	    if(this.value!=""){ 
	    	$('#othercheck-'+checkid).prop("checked", true);
	    }else{
	    	$('#othercheck-'+checkid).prop("checked", false);
	    }
	});

	
</script>
@endsection

