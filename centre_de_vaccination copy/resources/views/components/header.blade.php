<div>
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-5">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                    <h1
                        class="text-2xl font-bold tracking-tight group-hover:text-blue-200 transition-colors duration-200">
                        Centre de Vaccination</h1>
                    <i
                        class="fa-solid fa-syringe text-2xl group-hover:text-blue-200 hidden sm:inline transform group-hover:rotate-12 transition-all duration-200"></i>
                </a>
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li>
                            <a href="{{ route('patients.index') }}"
                                class="text-white hover:text-blue-200 transition-colors duration-200 font-medium flex items-center space-x-2">
                                <i class="fa-solid fa-users"></i>
                                <span>Patients</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('vaccins.index') }}"
                                class="text-white hover:text-blue-200 transition-colors duration-200 font-medium flex items-center space-x-2">
                                <i class="fa-solid fa-shield-virus"></i>
                                <span>Vaccins</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- Mobile menu button -->
                <button class="md:hidden text-white hover:text-blue-200 transition-colors duration-200">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        <!-- Mobile menu (hidden by default) -->
        <div class="md:hidden hidden bg-blue-700">
            <div class="container mx-auto px-4 py-3">
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('patients.index') }}"
                            class="text-white hover:text-blue-200 transition-colors duration-200 font-medium flex items-center space-x-2">
                            <i class="fa-solid fa-users"></i>
                            <span>Patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vaccins.index') }}"
                            class="text-white hover:text-blue-200 transition-colors duration-200 font-medium flex items-center space-x-2">
                            <i class="fa-solid fa-shield-virus"></i>
                            <span>Vaccins</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</div>
