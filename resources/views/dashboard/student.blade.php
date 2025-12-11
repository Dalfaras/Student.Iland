@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Welcome to Student Iland, {{ auth()->user()->name }}! (Student dashboard)</h1>
    <p>Your profile is ready. Explore students, groups, and more soon.</p>
</div>
@endsection
