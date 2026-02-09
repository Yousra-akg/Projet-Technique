@extends('layouts.app')

@section('content')
<div class="w-[75%] mx-auto px-6 lg:px-8 py-10" x-data="adminTaskManager">
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.4 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <!-- Header -->
                    <div class="px-7 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Tasks Management</h2>
                        </div>

                        <div class="inline-flex gap-x-2">
                            <div class="relative">
                                <input type="text" x-model="search" @input.debounce.500ms="refreshTable()" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-yellow-500 focus:ring-yellow-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Search tasks...">
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                    <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                </div>
                            </div>

                            <select x-model="projectId" @change="refreshTable()" class="py-2 px-3 block border-gray-200 shadow-sm rounded-lg text-sm focus:border-yellow-500 focus:ring-yellow-500">
                                <option value="">All Projects</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>

                            <button type="button" @click="openAddModal" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                Add Task
                            </button>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table Container -->
                    <div id="adminTableContainer" @click="if($event.target.tagName === 'A' && $event.target.closest('.pagination')) { $event.preventDefault(); handlePagination($event.target.href); }">
                        @include('admin.table')
                    </div>
                    <!-- End Table Container -->
                </div>
            </div>
        </div>
    </div>
    @include('admin.modal')
</div>
@endsection
