<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Smart Debugger Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">Smart Debugger - Error Dashboard</h1>

        <table class="min-w-full bg-white rounded shadow overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left">Error Message</th>
                    <th class="py-2 px-4 text-left">File</th>
                    <th class="py-2 px-4 text-left">Line</th>
                    <th class="py-2 px-4 text-left">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($errors as $error)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $error->error_message }}</td>
                    <td class="py-2 px-4">
                        @if ($error->file)
                            <a href="vscode://file/{{ base_path() }}/{{ $error->file }}:{{ $error->line }}" class="text-blue-600 underline" target="_blank">
                                {{ $error->file }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $error->line ?? 'N/A' }}</td>
                    <td class="py-2 px-4">{{ $error->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $errors->links() }}
        </div>
    </div>

    <script>
        @if(session('error_message'))
            Swal.fire({
                icon: 'error',
                title: 'Error Occurred',
                text: "{{ session('error_message') }}"
            });
        @endif
    </script>

</body>
</html>
