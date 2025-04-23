<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Matricule</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->matricule }}</td>
                    <td>{{ $employee->company_id }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="/">Go back to form</a> <br>
    <a href="/add_employees">Add new employee</a> <br>
</body>
</html>