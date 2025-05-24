<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Centre de Vaccination' }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- Lien pour utiliser Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Lien para usar Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    {{-- Lien pour alerts personalises --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="min-h-full">
        <x-header />

        <main class="py-10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <footer class="bg-white shadow-inner mt-auto">
            <div class="container mx-auto px-4 py-6 text-center text-gray-600">
                <p>&copy; {{ date('Y') }} Centre de Vaccination. Tous droits réservés.</p>
            </div>
        </footer>
    </div>

    <!-- Mobile menu script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.md\\:hidden.text-white');
            const mobileMenu = document.querySelector('.md\\:hidden.hidden.bg-blue-700');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>

</html>
