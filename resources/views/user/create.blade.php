@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">{{ __("User Registration") }}</div>
    <div class="card-body">
        <form-steps user-data="{{ $user }}"></form-steps>
    </div>
</div>
@endsection
