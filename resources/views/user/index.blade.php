<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 flex items-center h-screen">

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8">Homepage</h1>

        <div class="overflow-x-auto mx-auto w-full md:w-3/4 lg:w-3/4">
            <table class="table-auto w-full md:w-3/4 lg:w-3/4 border-2 border-black bg-white mx-auto">
                <thead>
                    <tr class="w-16 sm:w-24 md:w-24 lg:w-24 xl:w-24 border border-black px-4 py-2">
                        <th class="border border-black px-4 py-2">ID</th>
                        <th class="border border-black px-4 py-2">Score 1</th>
                        <th class="border border-black px-4 py-2">Score 2</th>
                        <th class="border border-black px-4 py-2">Score 3</th>
                        <th class="border border-black px-4 py-2">Score 4</th>
                        <th class="border border-black px-4 py-2">Score 5</th>
                        <th class="border border-black px-4 py-2">Score 6</th>
                        <th class="border border-black px-4 py-2">Score 7</th>
                        <th class="border border-black px-4 py-2">Score 8</th>
                        <th class="border border-black px-4 py-2">Score 9</th>
                        <th class="border border-black px-4 py-2">Score 10</th>
                        <th class="border border-black px-4 py-2">Average</th>
                        <th class="border border-black px-4 py-2">Minimum</th>
                        <th class="border border-black px-4 py-2">Maximum</th>
                        <th class="border border-black px-4 py-2">Action</th>              
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($mahasiswa as $mahasiswa)
                        <tr class="w-16 sm:w-24 md:w-24 lg:w-24 xl:w-24 border border-black px-4 py-2">
                            <td class="border border-black px-4 py-2">{{ $counter }}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor1}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor2}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor3}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor4}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor5}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor6}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor7}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor8}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor9}}</td>
                            <td class="border border-black px-4 py-2">{{$mahasiswa->skor10}}</td>
                            <td class="border border-black px-4 py-2">{{ ($mahasiswa->skor1 + $mahasiswa->skor2 + $mahasiswa->skor3 + $mahasiswa->skor4 + $mahasiswa->skor5 + $mahasiswa->skor6 + $mahasiswa->skor7 + $mahasiswa->skor8 + $mahasiswa->skor9 + $mahasiswa->skor10) / 10 }}</td>
                            <td class="border border-black px-4 py-2">{{ min($mahasiswa->skor1, $mahasiswa->skor2, $mahasiswa->skor3, $mahasiswa->skor4, $mahasiswa->skor5, $mahasiswa->skor6, $mahasiswa->skor7, $mahasiswa->skor8, $mahasiswa->skor9, $mahasiswa->skor10) }}</td>
                            <td class="border border-black px-4 py-2">{{ max($mahasiswa->skor1, $mahasiswa->skor2, $mahasiswa->skor3, $mahasiswa->skor4, $mahasiswa->skor5, $mahasiswa->skor6, $mahasiswa->skor7, $mahasiswa->skor8, $mahasiswa->skor9, $mahasiswa->skor10) }}</td>
                            <td class="border border-black px-4 py-2">
                                <a href="update/{{$mahasiswa->id}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-1 rounded">Update</a>
                                <form action="/user/delete/{{ $mahasiswa->id }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <br>
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $counter++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-8 inline-block">Create</a>
    </div>

</body>
</html>
