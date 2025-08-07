@extends('layouts.pemilik')

@section('title', 'Tutup Kamar')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Tutup Kamar: {{ $kamar->nama_kamar }}</h1>
            <p class="mt-2 text-lg text-gray-700">Atur periode penutupan kamar untuk pemeliharaan atau alasan lainnya</p>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('pemilik.room_close.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kamar_id" value="{{ $kamar->kamar_id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                       <!-- Start Date -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-800 mb-1">Tanggal Mulai Tutup</label>
    <div class="relative">
        <input type="date" name="start_date" 
            class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 bg-white text-gray-800 pr-10"
            required>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
    @error('start_date')
        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
    @enderror
</div>

<!-- End Date -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-800 mb-1">Tanggal Selesai Tutup</label>
    <div class="relative">
        <input type="date" name="end_date" 
            class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 bg-white text-gray-800 pr-10"
            required>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
    @error('end_date')
        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
    @enderror
</div>

                        <!-- Reason -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-800 mb-1">Alasan Penutupan</label>
                            <input type="text" name="alasan" id="alasan" 
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 bg-white text-gray-800"
                                placeholder="Masukkan alasan penutupan kamar">
                            @error('alasan')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('pemilik.kamar.index') }}" 
                            class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            <svg class="-ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                            <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                            Tutup Kamar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection