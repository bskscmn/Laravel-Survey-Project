 @extends('layouts.survey')

@section('content')
    <div class="col-sm-12 my-auto">
        <div class="row justify-content-center mb-5">
        	<div class="row bg-faded">
		        <div class="col-6 mx-auto text-center">
		            <img src="/images/tesekkur.png" alt="" class="img-fluid"> 
		            <a href="{{ route('survey', $anket->id) }}"><button type="button" class="btn mb-5 mt-5 btn-xl btn-outline-secondary">Anketi yeniden başlat</button></a>
		        </div>
		    </div>           
        </div>
    </div>
@endsection