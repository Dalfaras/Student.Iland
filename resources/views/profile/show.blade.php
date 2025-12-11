@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Your profile</h1>
    <p><strong>Name:</strong> {{ $user->name }} {{ $user->last_name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    @if($user->date_of_birth)
        <p><strong>Date of birth:</strong> {{ $user->date_of_birth->format('Y-m-d') }}</p>
    @endif
</div>
@endsection
