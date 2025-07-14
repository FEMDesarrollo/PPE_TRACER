@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        @if(session('errorDetails'))
            <ul class="mb-0 mt-2">
                @foreach(session('errorDetails') as $detail)
                    <li>{{ $detail }}</li>
                @endforeach
            </ul>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif