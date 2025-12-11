@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Complete your student profile</h1>
    <form method="POST" action="{{ route('onboarding.student.store') }}">
        @csrf
        <div class="form-group">
            <label for="study_level">Study level</label>
            <input id="study_level" type="text" name="study_level" value="{{ old('study_level') }}" required>
            @error('study_level')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="situation">Situation</label>
            <select id="situation" name="situation" required>
                <option value="">Select a situation</option>
                @foreach(['classic', 'cned', 'alternance', 'reprise', 'entrepreneur', 'other'] as $option)
                    <option value="{{ $option }}" @selected(old('situation') === $option)>{{ ucfirst($option) }}</option>
                @endforeach
            </select>
            @error('situation')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="study_field">Study field</label>
            <input id="study_field" type="text" name="study_field" value="{{ old('study_field') }}" required>
            @error('study_field')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input id="year" type="text" name="year" value="{{ old('year') }}" required>
            @error('year')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input id="city" type="text" name="city" value="{{ old('city') }}">
            @error('city')
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
            <label for="bio">Bio</label>
            <textarea id="bio" name="bio">{{ old('bio') }}</textarea>
            @error('bio')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="interests">Interests</label>
            <select id="interests" name="interests[]" multiple size="6">
                @foreach($interests as $interest)
                    <option value="{{ $interest->id }}" @selected(collect(old('interests', []))->contains($interest->id))>
                        {{ $interest->name }}
                    </option>
                @endforeach
            </select>
            @error('interests')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('interests.*')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label><input type="checkbox" name="visibility_students_only" value="1" {{ old('visibility_students_only', true) ? 'checked' : '' }}> Visible to students only</label>
        </div>

        <div class="form-group">
            <label><input type="checkbox" name="hide_from_public_groups" value="1" {{ old('hide_from_public_groups') ? 'checked' : '' }}> Hide from public groups</label>
        </div>

        <div class="form-group">
            <label><input type="checkbox" name="hide_from_recommendations" value="1" {{ old('hide_from_recommendations') ? 'checked' : '' }}> Hide from recommendations</label>
        </div>

        <button type="submit">Save profile</button>
    </form>
</div>
@endsection
