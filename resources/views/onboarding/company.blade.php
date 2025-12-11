@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Company profile</h1>
    <form method="POST" action="{{ route('onboarding.company.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Company name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input id="website" type="text" name="website" value="{{ old('website') }}">
            @error('website')
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

        <button type="submit">Save company</button>
    </form>
</div>
@endsection
