<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bergolong</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    <link rel = "icon" href = "https://chiknwy.github.io/Tekweb/porto/img/lgo.png" type = "image/x-icon">


</head>
<body class="bg-gray-900 text-blue-400"> 
    @extends('layout.indexLayout')

    <header class="px-5 sticky top-0 bg-gray-900 py-5 opacity-95 backdrop-blur-sm z-10">
        <nav class="container mx-auto flex items-center justify-between opacity-100">
            <div class="text-blue-400 items-center space-x-4 ">
                <button id="menu-toggle" class="text-blue-400 hover:text-white transition-transform transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div id="menu" class="hidden absolute left-0 mt-2 py-2 bg-gray-700 rounded-lg shadow-lg">
                    <a href="/scores" class="block px-4 py-2 text-blue-200 hover:text-white">Data Tunggal</a>
                    <a href="#" class="block px-4 py-2 text-blue-400 hover:text-blue-300">Data Bergolong</a>
                    <a href="/frekuensi" class="block px-4 py-2 text-blue-200 hover:text-white">Data Frekuensi</a>
                    <a href="/deskripsi" class="block px-4 py-2 text-blue-200 hover:text-white">Table Deskripsi Data</a>
                    <a href="/liliefors" class="block px-4 py-2 text-blue-200 hover:text-white">LilieFors</a>
                    <a href="/chitable" class="block px-4 py-2 text-blue-200 hover:text-white">Chi Table</a>
                    <a href="/import" class="block px-4 py-2 text-blue-200 hover:text-white">Import Excell</a>
                    <a href="/tableujit"  class="block px-4 py-2 text-blue-200 hover:text-white" >Uji T</a>
                    <a href="/biserial" class="block px-4 py-2 text-blue-200 hover:text-white">Biserial</a>
                </div>
            </div>
            
            <!-- Responsive Navigation Menu -->
            
            {{-- <div class="text-blue-400 items-center space-x-4 hidden sm:flex"> <!-- Hide on small screens -->
                <a href="#" class="nav-link"><span class="text-blue-300 hover:text-white">Data Tunggal</span></a>
                <a href="/bergolong" class="nav-link"><span class="text-blue-500 hover:text-white">Data Bergolong</span></a>
                <a href="/frekuensi" class="nav-link"><span class="text-blue-500 hover:text-white">Data Frekuensi</span></a>
                <a href="/deskripsi" class="nav-link"><span class="text-blue-500 hover:text-white">Table Deskripsi Data</span></a>
                <a href="/liliefors" class="nav-link"><span class="text-blue-500 hover:text-white">LilieFors</span></a>
                <a href="/chitable" class="nav-link"><span class="text-blue-500 hover:text-white">Chi Table</span></a>
                <a href="/import" class="nav-link"><span class="text-blue-500 hover:text-white">Import Excell</span></a>
            </div> --}}

            <!-- End Responsive Dropdown Menu -->
            
            <!-- Responsive Dropdown Menu (Hidden on larger screens) -->
            <div class="uppercase text-lg flex items-center space-x-2">
                <a href="https://chiknwy.github.io/Tekweb/porto/">
                    <span class="font-extrabold text-blue-400">Chiko</span><br>
                    <span class="font-extralight text-indigo-500">Satria</span>
                </a>
            </div>
            <div class="w-11 h-11 flex">
                <img src="https://chiknwy.github.io/Tekweb/porto/img/skull.gif" alt="skull">
            </div>
        </nav>
    </header>

    <h1 class="font-bold text-2xl py-8 px-8">Table Bergolong</h1>


    <div class="ml-16 ">
        <div class="container mx-auto px-12">
            
            
        </div>
        <div class="container mx-auto width-3/5 px-12 mt-4 bg-gray-900 py-6 rounded-md">
            <table id="myTable" class="table-auto pb-2 w-full bg-gray-800 shadow-lg rounded-lg border border-gray-300 text-blue-500">
                <thead>
                    <tr class="w-16 sm:w-24 md:w-24 lg:w-24 xl:w-24 border border-black px-4 py-2">
                        <th class="border border-black px-4 py-2">ID</th>
                        <th class="border border-black px-4 py-2">Nilai</th>
                        <th class="border border-black px-4 py-2">Median</th>
                        <th class="border border-black px-4 py-2">Frekuensi</th>
                        <th class="border border-black px-4 py-2">Percentage</th> <!-- New column header -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($scoreGroups as $dataSiswa)
                    <tr>
                        <td class="border border-black px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-black px-4 py-2">{{ $dataSiswa['interval'] }}</td>
                        <td class="border border-black px-4 py-2">{{ $dataSiswa['mid_value'] }}</td>
                        <td class="border border-black px-4 py-2">{{ $dataSiswa['frequency'] }}</td>
                        <td class="border border-black px-4 py-2">{{ $dataSiswa['percentage'] }}%</td>  
                    </tr>
                    @endforeach
                </tbody>
            </table>

    </div>
</body>
<script>
    const menuToggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu");

    menuToggle.addEventListener("click", function () {
        menu.classList.toggle("hidden");
        menuToggle.classList.toggle("rotate-90");

        if (menu.classList.contains("hidden")) {
            menuToggle.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            `;
        } else {
            menuToggle.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            `;
        }
    });
</script>
</html>