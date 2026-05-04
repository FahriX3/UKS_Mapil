@extends('layouts.app')
@section('title', 'Catat Kunjungan')
@section('subtitle', 'Formulir pencatatan kunjungan UKS')

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <form method="POST" action="{{ route('treatments.store') }}" id="treatmentForm">
            @csrf
            <div class="space-y-5">
                {{-- Student Selection --}}
                <div>
                    <label for="student_id" class="mb-1.5 block text-sm font-medium text-slate-700">Siswa</label>
                    <select id="student_id" name="student_id" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                        <option value="">Pilih Siswa</option>
                        @foreach($students as $s)
                            <option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>{{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas->nama }})</option>
                        @endforeach
                    </select>
                    @error('student_id') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Visit Date --}}
                <div>
                    <label for="tanggal_kunjungan" class="mb-1.5 block text-sm font-medium text-slate-700">Tanggal Kunjungan</label>
                    <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', date('Y-m-d')) }}" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                    @error('tanggal_kunjungan') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Keluhan --}}
                <div>
                    <label for="keluhan" class="mb-1.5 block text-sm font-medium text-slate-700">Keluhan</label>
                    <textarea id="keluhan" name="keluhan" rows="3" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10" placeholder="Deskripsikan keluhan siswa...">{{ old('keluhan') }}</textarea>
                    @error('keluhan') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Diagnosa --}}
                <div>
                    <label for="diagnosa" class="mb-1.5 block text-sm font-medium text-slate-700">Diagnosa Awal</label>
                    <textarea id="diagnosa" name="diagnosa" rows="2" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10" placeholder="Diagnosa awal petugas...">{{ old('diagnosa') }}</textarea>
                    @error('diagnosa') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Medicine Selection --}}
                <div>
                    <div class="mb-3 flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">Obat yang Diberikan</label>
                        <button type="button" onclick="addMedicineRow()" class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-600 transition-colors hover:bg-emerald-100 ring-1 ring-emerald-200/50">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                            Tambah Obat
                        </button>
                    </div>

                    <div id="medicine-rows" class="space-y-3">
                        {{-- Medicine row template will be added here --}}
                    </div>
                    <p class="mt-2 text-xs text-slate-400">Kosongkan jika tidak ada obat yang diberikan</p>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('treatments.index') }}" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">Batal</a>
                <button type="submit" class="flex-1 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all hover:from-emerald-600 hover:to-teal-600 active:scale-[0.98]">Simpan Kunjungan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const medicines = @json($medicines);
    let rowIndex = 0;

    function addMedicineRow() {
        const container = document.getElementById('medicine-rows');
        const row = document.createElement('div');
        row.className = 'flex gap-3 items-start p-3 rounded-xl bg-slate-50 ring-1 ring-slate-200';
        row.id = `med-row-${rowIndex}`;

        let options = '<option value="">Pilih Obat</option>';
        medicines.forEach(m => {
            options += `<option value="${m.id}">${m.nama_obat} (stok: ${m.stok} ${m.satuan})</option>`;
        });

        row.innerHTML = `
            <div class="flex-1">
                <select name="medicines[${rowIndex}][id]" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                    ${options}
                </select>
            </div>
            <div class="w-24">
                <input type="number" name="medicines[${rowIndex}][jumlah]" min="1" value="1" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10" placeholder="Jml">
            </div>
            <button type="button" onclick="removeMedicineRow(${rowIndex})" class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-red-50 hover:text-red-500">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12"></path></svg>
            </button>
        `;

        container.appendChild(row);
        rowIndex++;
    }

    function removeMedicineRow(index) {
        const row = document.getElementById(`med-row-${index}`);
        if (row) row.remove();
    }
</script>
@endpush
@endsection
