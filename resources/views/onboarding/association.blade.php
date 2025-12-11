@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Association profile</h1>
    <form method="POST" action="{{ route('onboarding.association.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Association name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="campus">Campus</label>
            <input id="campus" type="text" name="campus" value="{{ old('campus') }}">
            @error('campus')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Save association</button>
    </form>
</div>
@endsection
