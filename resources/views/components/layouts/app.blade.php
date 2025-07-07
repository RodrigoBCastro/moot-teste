<!-- resources/views/components/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Busca de Produtos' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">
<main class="container mx-auto py-8">
    {{ $slot }}
</main>

@livewireScripts
</body>
</html>
