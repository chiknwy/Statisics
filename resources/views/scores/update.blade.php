<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Score</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    <link rel = "icon" href = "https://chiknwy.github.io/Tekweb/porto/img/lgo.png" type = "image/x-icon">

</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen px-80">

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8 text-blue-800">Update Score</h1>

        <form action="{{ route('scores.update', $scores->id) }}" method="POST" class="w-full max-w-lg">
            @csrf
            @method('post')
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="score">
                        Score
                    </label>
                    <input  class="appearance-none block w-full bg-gray-800 text-blue-500 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-gray-800" id="score" name="score" type="number" placeholder="Score 1" value="{{ $scores->score }}" required>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">Update</button>
                </div>
            </div>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</body>
</html>
