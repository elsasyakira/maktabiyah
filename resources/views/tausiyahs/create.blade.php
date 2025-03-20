@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card bg-primary py-0">
                    <h5 class="card-header text-white"><strong>Data Tausiyah</strong></h5>
                </div>
                <div class="card overflow-hidden p-4">
                    <form action="{{ route('tausiyahs.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="umat_id">Pilih Umat</label>
                                <select id="umat_id" name="umat_id" class="form-control">
                                    <option value="">-- Pilih Umat --</option>
                                    @foreach ($umats as $umat)
                                        <option value="{{ $umat->id }}" data-halaqoh="{{ $umat->holaqoh }}">{{ $umat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="halaqoh">Halaqoh</label>
                                <input type="text" id="holaqoh" name="holaqoh" class="form-control"
                                    placeholder="Halaqoh" readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('tausiyahs.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('umat_id').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let holaqoh = selectedOption.getAttribute('data-halaqoh');
            document.getElementById('holaqoh').value = holaqoh || '';
        });
    </script>
@endsection
