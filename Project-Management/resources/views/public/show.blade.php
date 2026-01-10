@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Back Button -->
    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-yellow-600 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        Back to Tasks
    </a>

    <!-- Main Card -->
    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        
        <!-- Image Header -->
        <div class="w-full h-80 bg-slate-100 relative group">
             @if($task->image)
                <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
            @else
                <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                    <svg class="w-20 h-20 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
            @endif

            <!-- Title Overlay (Bottom Left) -->
            <div class="absolute bottom-0 left-0 p-8 w-full">
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($task->projects as $project)
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-400 text-slate-900 shadow-sm border border-yellow-300">
                            {{ $project->title }}
                        </span>
                    @endforeach
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight drop-shadow-md">{{ $task->title }}</h1>
            </div>
        </div>

        <!-- Content Body -->
        <div class="p-8 md:p-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Left: Description -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3">About this Task</h2>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-lg">
                            {{ $task->description }}
                        </div>
                    </div>
                </div>

                <!-- Right: Meta Info -->
                <div class="lg:col-span-1">
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 space-y-6">
                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Created Date</span>
                            <span class="text-base font-semibold text-slate-800">{{ $task->created_at->format('F d, Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Task ID</span>
                            <span class="text-base font-family-mono text-slate-600 bg-white px-2 py-1 rounded border border-slate-200 text-sm">#{{ $task->id }}</span>
                        </div>
                         <!-- Example of extra metadata placeholder -->
                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Status</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="bg-slate-50 px-8 py-6 border-t border-slate-100 flex items-center justify-between">
            <span class="text-sm text-slate-400">Last updated {{ $task->updated_at->diffForHumans() }}</span>
            <div class="flex gap-3">
                 <!-- Could add specific CTA here if needed -->
            </div>
        </div>
    </div>
</div>
@endsection
