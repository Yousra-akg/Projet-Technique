@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Dashboard</h2>
            
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-slate-600">You are logged in!</p>
            
            <div class="mt-6">
                <a href="{{ route('admin.index') }}" class="inline-flex items-center px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-semibold rounded-lg transition shadow-sm hover:shadow-md">
                    Go to Admin Panel
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
