<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Job Board</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="mx-auto mt-10 max-w-2xl bg-gradient-to-r from-blue-100 to-cyan-100 text-slate-700">
  <nav class="mb-6 flex justify-between text-lg font-medium">
    <ul class="flex space-x-2">
      <li><a href="/">Home</a></li>
    </ul>
    <ul class="flex space-x-2">
      @auth
        <li>
          <a href="{{ route('my-job-applications.index') }}" class="rounded-md border border-slate-300 bg-white px-2.5 py-1.5 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-100">
            {{ auth()->user()->name ?? 'Anonymous' }}: Applications
          </a>
        </li>
        <li>
          <a href="{{ route('my-jobs.index') }}">My Jobs</a>
        </li>
        <li>
          <form action="{{ route('auth.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Logout</button>
          </form>
        </li>
      @else
        <li>
          <a href="{{ route('auth.create') }}">Sign in</a>
        </li>
      @endauth
    </ul>
  </nav>

  @if (session()->has('success'))
    <div class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75" role="alert">
      <p class="font-bold">Success!</p>
      <p>{{ session('success') }}</p>
    </div>
  @endif
  @if (session()->has('error'))
    <div class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75" role="alert">
      <p class="font-bold">Error!</p>
      <p>{{ session('error') }}</p>
    </div>
  @endif

  {{ $slot }}
</body>
</html>