{{-- @php
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
@endphp --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    {{-- {{ $age }} --}}
    <a href="myprofile">Returner a la page MyProfil</a> <br> <br>

    <p>Votre nom: {{ $name }}</p>
    <p>Votre email: {{ $email }}</p>

    @if (!$age)
        <p>Il faut l'age</p> 
    @elseif ( $age < 18)
        <p style="color: red">Il ne s'agit pas d'un adult!</p>
    @else
        <p>L'age est {{ $age }}, vous êtes un adult!</p>      
    @endif
</body>
</html>