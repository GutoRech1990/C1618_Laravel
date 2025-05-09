<x-layout>
    <x-slot name="title">{{ $job->title }}</x-slot>
    <x-slot name="header">
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $job->title }}</h1>
                    <div class="flex space-x-4">
                        <a href="/jobs/{{ $job->id }}/edit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">
                            Edit Job
                        </a>
                        <form action="/jobs/{{ $job->id }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this job listing?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300">
                                Delete Job
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="space-y-6">
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-building text-gray-400 w-5 mr-2"></i>
                    <span class="font-medium">{{ $job->company }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt text-gray-400 w-5 mr-2"></i>
                    <span>{{ $job->location }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="far fa-user text-gray-400 w-5 mr-2"></i>
                    <span>Posted by: {{ $job->employer->name }}</span>
                </div>
                <div class="pt-4 border-t border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Job
                        Description</h2>
                    <div class="prose max-w-none text-gray-600">
                        {{ $job->description }}
                    </div>
                </div>
                @if ($job->tags->count() > 0)
                    <div class="pt-4 border-t border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Tags</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($job->tags as $tag)
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="pt-4 border-t border-gray-200 text-sm text-gray-500">
                    <p>Posted: {{ $job->created_at->diffForHumans() }}</p>
                    <p>Last updated: {{ $job->updated_at->diffForHumans() }}</p>
                </div>
                <div>
                    <a href="/jobs/{{ $job->id }}/edit"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-300">
                        <i class="fa fa-edit"></i>Edit </a>
                </div>
                <div>
                    <form action="/jobs/{{ $job->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job listing?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
