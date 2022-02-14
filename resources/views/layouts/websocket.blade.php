@if (Auth::check() && $subscribe)

<web-socket :subscribe="{{ $subscribe }}" :user="{{ Auth::user() }}"></web-socket>
@endif
