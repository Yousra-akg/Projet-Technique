@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <!-- Hero Section -->
    <div class="text-center space-y-4 py-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight">
            Our <span class="text-yellow-500">Project</span> Directive
        </h1>
        <p class="text-lg text-slate-500 max-w-2xl mx-auto">
            Explore the latest tasks and updates from our project management board. Transparency and efficiency in every step.
        </p>
    </div>

    <!-- Task Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($tasks as $task)
            <div class="group bg-white rounded-3xl p-4 shadow-sm hover:shadow-xl hover:shadow-yellow-400/10 border border-slate-100 transition-all duration-300 hover:-translate-y-1">
                <!-- Image Wrapper -->
                <div class="aspect-video w-full rounded-2xl overflow-hidden bg-slate-100 relative mb-4">
                    @if($task->image)
                        <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    @endif
                    <!-- Project Badge -->
                    <div class="absolute top-3 left-3 flex gap-2">
                         @foreach($task->projects as $project)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-white/90 backdrop-blur text-slate-800 shadow-sm">
                                {{ $project->title }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Content -->
                <div class="px-2">
                    <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-1 group-hover:text-yellow-600 transition-colors">{{ $task->title }}</h3>
                    <p class="text-slate-500 text-sm mb-6 line-clamp-2 h-10">{{ $task->description }}</p>
                    
                    <a href="{{ route('public.tasks.show', $task->id) }}" class="inline-flex w-full items-center justify-center gap-2 px-4 py-3 bg-slate-50 hover:bg-yellow-400 text-slate-700 hover:text-slate-900 font-bold rounded-xl transition-all duration-200">
                        View Details
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                </div>
                <h3 class="text-lg font-medium text-slate-900">No tasks published yet</h3>
                <p class="text-slate-500">Check back later for updates.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
