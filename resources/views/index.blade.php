@extends('layouts.app')

@section('metas')
<title>{{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col text-center text-white">
            <h2>Most Popular in Citizen</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($vars['most_popular_citizen'] as $item)
                        <div class="col text-center">
                            <img src="{{ $item->image_path ?? '#' }}" height="130" alt="{{ $item->name }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
