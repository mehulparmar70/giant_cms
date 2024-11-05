<!-- resources/views/theme-selection.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Select Theme</title>
</head>
<body>
    <h1>Select a Theme</h1>
    <ul>
        @foreach ($themes as $theme)
            <li>
                {{ $theme->name }}
                @if (!$theme->is_active)
                    <form action="{{ route('theme.activate', $theme->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Activate</button>
                    </form>
                @else
                    <span>(Active)</span>
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
