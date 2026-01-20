@foreach($tasks as $task)
<div class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl">
  <div class="h-52 flex flex-col justify-center items-center bg-blue-600 rounded-t-xl overflow-hidden">
    @if($task->image)
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out" src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}">
    @else
        <div class="flex items-center justify-center w-full h-full bg-gray-100 text-gray-400">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
    @endif
  </div>
  <div class="p-4 md:p-6">
    <div class="flex flex-wrap gap-2 mb-3">
        @foreach($task->projects as $project)
            <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                {{ $project->title }}
            </span>
        @endforeach
    </div>
    <h3 class="text-xl font-semibold text-gray-800 group-hover:text-yellow-600">
      {{ $task->title }}
    </h3>
    <p class="mt-3 text-gray-500 line-clamp-2">
      {{ $task->description }}
    </p>
  </div>
  <div class="mt-auto flex border-t border-gray-200 divide-x divide-gray-200">
    <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-es-xl bg-white text-gray-800 shadow-sm hover:bg-yellow-50 hover:text-yellow-600 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('public.tasks.show', $task->id) }}">
      View details
    </a>
  </div>
</div>
@endforeach
