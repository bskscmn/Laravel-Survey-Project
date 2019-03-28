 @extends('layouts.survey')

@section('content')
     <div class="col-sm-12 my-auto">
        <div class="row justify-content-center mb-5">
 			@foreach($surveys as $survey)
			<div class="col-sm-12 col-md-6">
  				<div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                            {{ $survey->name }}
                        </h4>
                        <div class="media">
                            <div class="media-left">
                                <img src="/images/surveyico.png" alt="Material Dashboard Pro" class="media-object" style="width: 100px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                            </div>
                            <div class="media-body" style="margin-left: 5px">
                                <div class="clearfix text-center">
                                	<p style="margin-top: 15px">{{ date('d-m-Y', strtotime( $survey->created_at)) }}</p>
                                    <p class="pull-right">
                                        <a href="{{ route('survey', $survey->id) }}" class="btn btn-success btn-sm ad-click-event">
                                            Anketi Başlat <i class="fas fa-play "></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection