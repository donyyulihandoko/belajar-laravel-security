<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
</head>

<body>
    <table>
        @foreach ($todos as $todo)
            <tr>
                <td>
                    @can('update', $todo)
                        Edit
                    @else
                        No Edit
                    @endcan
                </td>
                <td>
                    @can('delete', $todo)
                        Delete
                    @else
                        No Delete
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

</body>

</html>
