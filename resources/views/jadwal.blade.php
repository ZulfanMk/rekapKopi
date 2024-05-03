<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pa-Pi') }}</title>
    <link rel="icon" href={{ asset('images/icon.ico') }} type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-FywFyxxFfADhY6JyoGDAvLn2vxrKfr1FUCxUpyQZG6k7eQ1Bn/c7ZsgkENm/hPdz" crossorigin="anonymous">
<!-- JS Bootstrap (butuh jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-MCFXSjsJn0IEkHJl9IeQq8Q6juiqy9gjh08m2bXHxKae3joknVidC2FbY8L4fniX" crossorigin="anonymous"></script>
<!-- jQuery (diperlukan untuk Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-gKs5RlM52DHgDli11M7ylKteJ/odg/RTTRyO/BfQf1EzJXtuJ+EmkhgFt8h2p4x1" crossorigin="anonymous"></script>


    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <header>
        @include('components.navbar')
    </header>
    <div class="flex">
        <div class="sidebar">
            @include('components.sidebar')
        </div>
            <div class="py-12 w-full h-screen">
                <div class="ms-4" style="margin-left: 100px;">   
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Informasi Jadwal
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Lihat informasi jadwal akun Anda.
                </p>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                    <x-primary-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'tambah-jadwal')">
                    Tambah Jadwal
                </x-primary-button>
                        <div class="table-responsive">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                    <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hari
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam Mulai
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam Selesai
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Keterangan
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tindakan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($jadwal as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->hari }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->tanggal }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->jam_mulai }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->jam_selesai }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->keterangan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                    <!-- Tombol Edit -->
                                            <button class="text-indigo-600 hover:text-indigo-900 btn btn primary" onclick="editJadwal({{ $item->id }})">Edit</button>
                                            <!-- Tombol Hapus -->
                                            <button class="text-red-600 hover:text-red-900" onclick="hapusJadwal({{ $item->id }})">Hapus</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        @include('components.footer')
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <section class="space-y-6">


        <!-- Tombol Tambah Jadwal -->
        

        <!-- Modal Tambah Jadwal -->
        <x-modal name="tambah-jadwal" :show="false" focusable>
            <form method="post" action="{{ route('jadwal.store') }}" class="p-6">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Tambah Jadwal
                </h2>

                <!-- Input untuk menambahkan jadwal -->
                <div class="mt-6">
                    <x-input-label for="hari" value="Hari" class="sr-only" />
                    <x-text-input id="hari" name="hari" type="text" class="mt-1 block w-full"
                        placeholder="Hari" required autofocus />
                </div> 
                <div class="mt-6">
                    <x-input-label for="tanggal" value="Tanggal" class="sr-only" />
                    <x-date-input id="tanggal" name="tanggal" class="mt-1 block w-full" required autofocus />
                </div>

                <div class="mt-6">
                    <x-input-label for="jam_mulai" value="Jam Mulai" class="sr-only" />
                    <x-time-input id="jam_mulai" name="jam_mulai" class="mt-1 block w-full" required/>
                </div>

                <div class="mt-6">
                    <x-input-label for="jam_selesai" value="Jam Selesai" class="sr-only" />
                    <x-time-input id="jam_selesai" name="jam_selesai" class="mt-1 block w-full" required/>
                </div>

                <div class="mt-6">
                    <x-input-label for="keterangan" value="Keterangan" class="sr-only" />
                    <x-text-input id="keterangan" name="keterangan" type="text" class="mt-1 block w-full"
                        placeholder="Keterangan" required />
                </div>


                <!-- Tombol Simpan dan Batal -->
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close', 'tambah-jadwal')">
                        Batal
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        Simpan
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </section>

</body>
</html>
