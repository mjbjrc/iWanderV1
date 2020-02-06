@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 card">
            <div class="row">
                {{-- <div class="card-deck"> --}}
                <div class="col-12 ml-2 mt-5 mb-2">
                    <h3 class="h3"> Popular Cities in Europe </h3>
                </div>

                @foreach($popularInEU['results'] as $popular)
                <div class="col-sm-4 mb-3">
                    <div class="card h-100">
                        <div class="col float-left">
                            @foreach($popular['photos'] as $photo)
                            <img class="h-100" style="object-fit:cover;" src="https://maps.googleapis.com/maps/api/place/photo?photoreference={{$photo['photo_reference']}}&key={{$API_key}}&maxheight=100&maxwidth=300" />
                            @endforeach
                        </div>
                        <div class="card-body float-right" style="float:right;">
                            <a href="{{ route('browse.city', $popular['formatted_address']) }}" class="card-title">{{$popular['formatted_address']}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- </div> --}}
            </div>
            <div class="row">
                <div class="col">
                    <a href="">Load More</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
