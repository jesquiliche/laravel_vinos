<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tipos</title>
</head>
<body>
    <h1>Listado de Tipos</h1>
    
    @if($tipos->isEmpty())
        <p>No hay tipos disponibles.</p>
    @else
        <ul>
            @foreach($tipos as $tipo)
                <li>
                    <strong>Nombre:</strong> {{ $tipo->nombre }} <br>
                    <strong>Descripción:</strong> {{ $tipo->descripcion }}
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
