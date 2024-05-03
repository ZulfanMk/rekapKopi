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