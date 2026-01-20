@extends('layouts.app')

@section('content')
<div class="bg-gray-50 border-b border-gray-200">
  <div class="w-[75%] mx-auto px-6 lg:px-8 py-16 lg:py-24">
    <div class="max-w-2xl text-center mx-auto">
      <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl">
        Discover <span class="text-yellow-500">Our Tasks</span>
      </h1>
      <p class="mt-4 text-lg text-gray-600">
        Explore our collaborative project tasks and stay updated on the progress.
      </p>
    </div>
  </div>
</div>

<div class="w-[75%] mx-auto px-6 lg:px-8 py-10 lg:py-14">
    <div id="tasksContainer">
        <div class="mb-5 sm:mb-10 text-center">
            <h2 class="text-2xl font-bold md:text-3xl text-gray-800">
                Featured <span class="border-b-4 border-yellow-400 pb-1">Tasks</span>
            </h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @include('partials.task-cards', ['tasks' => $tasks])
        </div>

        @if(isset($tasks) && method_exists($tasks, 'hasPages') && $tasks->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $tasks->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
