<header class="bg-gray-900 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
        <a href="{{ url('/') }}">JobSPHERE</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
        <a href="{{ url('/jobs') }}" class="text-white hover:underline py-2">All jobs</a>
        <a href="{{ url('/jobs/create') }}"
            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded hover:shadow-md transition duration-300">
            <i class="fa fa-edit"></i> Create a job
        </a>
        </nav>
        <button id="btnMenu" class="text-white md:hidden flex items-center">
        <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <div
        id="mobile-menu"
        class="hidden md:hidden bg-gray-900 text-white mt-5 pb-4 space-y-2">
        <a href="{{ url('/jobs') }}" class="block px-4 py-2 hover:bg-gray-700">All jobs</a>
        <a
        href="{{ url('/jobs/create') }}"
        class="block px-4 py-2 bg-green-500 hover:bg-green-600 text-white">
        <i class="fa fa-edit"></i> Create a job
        </a>
    </div>
</header>