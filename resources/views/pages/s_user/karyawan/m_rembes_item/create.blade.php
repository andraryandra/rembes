@extends('layouts.app')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reimburse</li>
                <li class="breadcrumb-item active" aria-current="page">Reimburse Item</li>
                <li class="breadcrumb-item active" aria-current="page">Create New Reimburse Item</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row my-3">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.rembes-item.index', $rembes->id) }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    @include('layouts.partials.alert-prompt.alert')

    <div class="card ">
        <div class="row m-2">
            <div class="card-body">
                <form action="{{ route('dashboard.rembes-item.store', $rembes->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group my-2">
                        <label for="nama_rembes">Item Name: <span class="text-danger">*</span></label>
                        <input value="{{ old('nama_rembes') }}" type="text" name="nama_rembes" id="nama_rembes"
                            class="form-control" placeholder="Entry your item remburse name" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Amount of money : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="nominal" id="input-harga" class="form-control"
                                placeholder="Entry your amount of money" value="{{ old('nominal') }}" required>
                        </div>
                    </div>

                    <div class="form-group my-2">
                        <label for="tanggal_rembes">Date: <span class="text-danger">*</span></label>
                        <input value="{{ old('tanggal_rembes') }}" type="date" name="tanggal_rembes" id="tanggal_rembes"
                            class="form-control" required>
                    </div>

                    <div class="form-group my-2">
                        <label for="deskripsi">Description (Optional):</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" value="{{ old('deskripsi') }}"
                            placeholder="Entry your description" rows="3"></textarea>
                    </div>

                    <div class="form-group my-2">
                        <label for="foto_bukti">Photo Evidence: <span class="text-danger">*</span></label>
                        <input type="file" name="foto_bukti[]" id="foto_bukti" class="form-control" multiple>
                    </div>

                    <div class="form-group my-3 text-center">
                        <button type="submit"id="buttonText" class="btn btn-primary" onclick="disableButton(this);">
                            <i class="far fa-save"></i>
                            Save
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#category_id option[value=""]').css('display', 'none');
                $('#status option[value=""]').css('display', 'none');
            });
        </script>

        <!-- Disable Button -->
        <script>
            function disableButton(button) {
                button.disabled = true;
                var buttonText = document.getElementById("buttonText");
                buttonText.innerText = "Publishing...";

                // Mengganti format angka sebelum submit
                var inputHarga = document.getElementById('input-harga');
                var nilaiInput = inputHarga.value.replace(/\D/g, '');
                inputHarga.value = nilaiInput;

                // Menjalankan submit form setelah 500ms
                setTimeout(function() {
                    button.form.submit();
                }, 500);
            }
        </script>

        <!-- Format Rupiah -->
        <script>
            function formatRupiah(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
                // return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
                return rupiah.split('', rupiah.length - 1).reverse().join('');
            }

            var inputHarga = document.getElementById('input-harga');
            inputHarga.addEventListener('input', function(e) {
                var nilaiInput = e.target.value.replace(/\D/g, '');
                var nilaiFormat = formatRupiah(nilaiInput);
                e.target.value = nilaiFormat;
            });

            var form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                var inputHarga = document.getElementById('input-harga');
                var nilaiInput = inputHarga.value.replace(/\D/g, '');
                inputHarga.value = nilaiInput;
            });
        </script>
    @endpush
@endsection
{{-- <div class="form-group my-2">
                    {!! Form::label('foto_bukti', 'Photo Evidence (Optional):') !!}
                    {!! Form::file('foto_bukti[]', ['class' => 'form-control-file border rounded', 'multiple' => 'multiple']) !!}
                </div> --}}
