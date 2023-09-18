@extends('layout.erp.app')

@section('page')
    <style>
        textarea {
            resize: none;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 7px;
            padding: 10px;
        }

        textarea:focus {
            outline: 0;
        }

        .card-header {
            text-align: center;
            font-size: 1.5rem;
            color: #497de6;
            font-weight: bold;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Scheduled Post') }}</div>

                    <div class="card-body">
                        <form action="{{ route('scheduled_posts.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="scheduled_at">{{ __('Scheduled Date and Time') }}</label>
                                <input id="scheduled_at" type="datetime-local"
                                    class="form-control @error('scheduled_at') is-invalid @enderror" name="scheduled_at"
                                    value="{{ old('scheduled_at') }}" required>

                                @error('scheduled_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="platform">{{ __('Platform') }}</label>
                                <select id="platform" class="form-control @error('platform') is-invalid @enderror"
                                    name="platform" required>
                                    <option value="">Select Platform</option>
                                    <option value="Facebook" {{ old('platform') === 'Facebook' ? 'selected' : '' }}>Facebook
                                    </option>
                                    <option value="Twitter" {{ old('platform') === 'Twitter' ? 'selected' : '' }}>Twitter
                                    </option>
                                </select>

                                @error('platform')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create Scheduled Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
