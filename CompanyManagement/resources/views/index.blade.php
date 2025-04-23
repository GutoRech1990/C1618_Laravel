<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Employee</title>
</head>
<body>
    <h1>Add New Employee</h1>
    <form action="/add_employees" method="POST">
        @csrf
        <label for="name">First Name:</label>
        <input type="text" id="name" name="first_name" required> <br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required> <br><br>

        <label for="matricule">Matricule:</label>
        <input type="text" id="matricule" name="matricule" required> <br><br>
        <button type="submit">Submit</button> <br>
        <a href="/show_employees">Show all employees</a> <br>
    </form>
</body>
</html>