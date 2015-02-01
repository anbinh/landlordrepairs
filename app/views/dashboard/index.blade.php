@extends('admin')


@section('content')

<div class="span8 well">
	<h4>Hello {{ ucwords(Auth::user()->first_name) }}</h4>
</div>


@stop