@extends('layout.erp.app')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Scheduled Posts') }}</div>

                    <div class="card-body">
                        @if ($scheduledPosts->isEmpty())
                            <p>No scheduled posts found.</p>
                        @else
                            <ul>
                                @foreach ($scheduledPosts as $post)
                                    <li>
                                        <strong>Content:</strong> {{ $post->content }}<br>
                                        @if ($post->scheduled_at)
                                            <p>Scheduled At: {{ $post->scheduled_at->format('Y-m-d H:i:s') }}</p>
                                        @else
                                            <p>Scheduled At: N/A</p>
                                        @endif
                                        <strong>Platform:</strong> {{ $post->platform_type }}<br>
                                        <hr>
                                    </li>
                                @endforeach
                                {{ $scheduledPosts->links() }}
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
