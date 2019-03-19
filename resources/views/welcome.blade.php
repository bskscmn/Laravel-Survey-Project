 @extends('layouts.survey')

@section('content')
     <div class="col-sm-12 my-auto">
        <div class="row justify-content-center mb-5">
            <a href="{{ route('surveyscroll', 1) }}"><button type="button" class="btn mb-5 btn-circle btn-xl btn-outline-danger"><p>Anketi Başlat</p><i class="fas fa-play fa-lg"></i></button></a>
        </div>
    </div>
@endsection