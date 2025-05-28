<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 40px;
            background-color: #fff;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #444;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #bbb;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <h1>Listado de Usuarios</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI / NIE</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Disc.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->lastname }}</td>
                    <td>{{ $student->idcard }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->disability ? 'Si' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generado por el sistema &copy; {{ date('Y') }}
    </div>
</body>
</html>
