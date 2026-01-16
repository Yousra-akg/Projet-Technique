@extends('layouts.admin')

@section('content')
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-black">{{ __('tasksview.app_name') }}</h1>
            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" onclick="openModal()">
                {{ __('tasksview.add_button') }}
            </button>
        </div>

        <div class="mb-4">
            <input type="text" 
                   class="py-3 px-4 block w-full border-2 border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none text-black bg-white placeholder-gray-500 font-medium" 
                   placeholder="{{ __('tasksview.search_placeholder') }}" 
                   onkeyup="searchTasks(this.value)">
        </div>

        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg shadow overflow-hidden dark:border-gray-700 dark:shadow-gray-900">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">{{ __('tasksview.table_title') }}</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">{{ __('tasksview.table_description') }}</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">{{ __('tasksview.table_projects') }}</th>
                                </tr>
                            </thead>
                            <tbody id="tasks-table-body" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @include('tasks.table')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('tasks._modal')
@endsection