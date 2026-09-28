<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Work Site</title>
    <style>
        body { font-family: sans-serif; background: #f5f5f5; padding: 40px; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: #333; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; color: #555; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .success { color: #28a745; background: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
        .error { color: #dc3545; font-size: 14px; margin-top: 5px; }
        .back-link { display: inline-block; margin-top: 20px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add a New Work Site</h1>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('site.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Site Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="e.g. Downtown Office" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Full Address</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="e.g. 1600 Amphitheatre Parkway, Mountain View, CA" required>
                @error('address')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Add Work Site</button>
        </form>

        <a href="{{ route('map.index') }}" class="back-link">← View Map</a>
    </div>
</body>
</html>