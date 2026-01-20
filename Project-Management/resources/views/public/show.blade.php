@extends('layouts.app')

@section('content')
<div class="w-[75%] mx-auto px-6 lg:px-8 pt-6 lg:pt-10 pb-12">
  <div class="max-w-4xl">
    <!-- Back Button -->
    <div class="mb-6">
      <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:text-yellow-500 focus:outline-none focus:text-yellow-500 font-medium" href="{{ route('home') }}">
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        Back to list
      </a>
    </div>

    <!-- Content -->
    <div class="space-y-5 md:space-y-8">
      <div class="space-y-3">
        <h2 class="text-2xl font-bold md:text-3xl">{{ $task->title }}</h2>

        <div class="flex flex-wrap gap-2">
            @foreach($task->projects as $project)
                <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                    {{ $project->title }}
                </span>
            @endforeach
        </div>
      </div>

      <figure>
        @if($task->image)
            <img class="w-full object-cover rounded-xl" src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}">
        @else
            <div class="w-full h-80 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400">
                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        @endif
      </figure>

      <div class="space-y-3">
        <h3 class="text-xl font-semibold">Description</h3>
        <p class="text-lg text-gray-800">
          {{ $task->description }}
        </p>
      </div>

      <!-- Info Grid -->
      <div class="grid grid-cols-2 gap-4 border-t border-gray-200 pt-6">
        <div>
          <h4 class="text-sm font-semibold uppercase text-gray-500">Assigned To</h4>
          <p class="mt-1 text-gray-800 font-medium">{{ $task->user->name ?? 'Unassigned' }}</p>
        </div>
        <div>
          <h4 class="text-sm font-semibold uppercase text-gray-500">Created At</h4>
          <p class="mt-1 text-gray-800 font-medium">{{ $task->created_at->format('M d, Y') }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
