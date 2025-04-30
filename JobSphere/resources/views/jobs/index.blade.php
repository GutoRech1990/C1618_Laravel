<x-layout>
    <x-slot name="title">Available jobs</x-slot>
    <x-slot name="header">
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-2">
                    <h1 class=" text-3xl font-bold text-gray-900">Available jobs</h1>
                    <p class="mt-2 text-sm text-gray-600">Find your dream job from our latest opportunities</p>
                    <p class="mt-2 text-sm text-gray-600">
                            {{ $availableJobs->count() }} jobs available
                    </p>
                </div> 
            </div>   
        </div>
    </x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid sm:grid-cols-1 lg:grid-cols-3 gap-6">
        @forelse($availableJobs as $job)
            <div class="bg-white rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300 border border-gray-100">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $job->title }}</h2>
                        <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-50 rounded">New</span>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-building text-gray-400 w-5 mr-2"></i>
                            <span class="font-medium">{{ $job->company }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt text-gray-400 w-5 mr-2"></i>
                            <span>{{ $job->location }}</span>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600 mb-6">
                        <p class="line-clamp-3">{{ $job->description }}</p>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <div class="flex items-center">
                                <i class="far fa-user text-gray-400 mr-2"></i>
                                <span>{{ $job->employer->name }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-clock text-gray-400 mr-2"></i>
                                <span>{{ $job->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12 bg-white rounded-lg border border-gray-100">
                    <i class="fas fa-briefcase text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500 text-lg">No jobs found</p>
                    <p class="text-gray-400 text-sm mt-1">Check back later for new opportunities</p>
                </div>
            </div>
        @endforelse
    </div>
</x-layout>
