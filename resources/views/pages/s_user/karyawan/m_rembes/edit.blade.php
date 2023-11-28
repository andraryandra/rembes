@extends('layouts.app')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Rembes</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row my-3">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.rembes.index') }}">
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
                {!! Form::model($rembes, [
                    'route' => ['dashboard.rembes.update', $rembes->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="form-group my-2">
                    {!! Form::label('nama', 'Nama:') !!}
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Entry your name', 'required']) !!}
                </div>
                <div class="col-12">
                    <label class="form-label">Amount of money</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        <input type="text" name="nominal" id="input-harga" class="form-control"
                            placeholder="Entry your amount of money"
                            value="{{ number_format($rembes->nominal, 0, ',', '.') }}">
                    </div>
                </div>

                <div class="form-group my-2">
                    {!! Form::label('tanggal', 'Date:') !!}
                    {!! Form::date('tanggal', $rembes->tanggal, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group my-2">
                    {!! Form::label('status', 'Status:') !!}
                    {!! Form::select(
                        'status',
                        ['PENDING' => 'PENDING', 'APPROVED' => 'APPROVED', 'REJECTED' => 'REJECTED'],
                        $rembes->status,
                        ['class' => 'form-select', 'required'],
                    ) !!}
                </div>

                <div class="form-group my-2">
                    {!! Form::label('deskripsi', 'Description (Optional):') !!}
                    {!! Form::textarea('deskripsi', $rembes->deskripsi, ['class' => 'form-control', 'rows' => '3']) !!}
                </div>

                <div class="form-group my-2">
                    {!! Form::label('foto_bukti', 'Photo Evidence (Optional):') !!}
                    {!! Form::file('foto_bukti[]', ['class' => 'form-control-file border rounded', 'multiple' => 'multiple']) !!}
                </div>


                <div class="form-group my-3 text-center">
                    <button type="submit" id="buttonText" class="btn btn-primary" onclick="disableButton(this);">
                        <i class="far fa-save"></i>
                        Save
                    </button>
                </div>
                {!! Form::close() !!}
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
