@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">{{ __("User Registration") }}</div>
    <div class="card-body">
        <create-steps></create-steps>
    </div>
</div>
@endsection
