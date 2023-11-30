@extends('layouts.app')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Rembes Item</li>
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
                {!! Form::model($rembes_item, [
                    'route' => ['dashboard.rembes-item.update', ['rembes' => $rembes->id, 'id' => $rembes_item->id]],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) !!}



                <div class="form-group my-2">
                    {!! Form::label('nama_rembes', 'Name Rembes:') !!}
                    {!! Form::text('nama_rembes', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan name rembes',
                        'required',
                    ]) !!}
                </div>

                <div class="col-12">
                    <label class="form-label">Amount of money</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        {!! Form::text('nominal', number_format($rembes_item->nominal, 0, ',', '.'), [
                            'class' => 'form-control',
                            'placeholder' => 'Entry your amount of money',
                            'id' => 'input-harga',
                        ]) !!}
                    </div>
                </div>


                <div class="form-group my-2">
                    {!! Form::label('tanggal_rembes', 'Date:') !!}
                    {!! Form::date('tanggal_rembes', null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group my-2">
                    {!! Form::label('deskripsi', 'Description (Opsional):') !!}
                    {!! Form::textarea('deskripsi', null, ['class' => 'form-control', 'rows' => '3']) !!}
                </div>

                <div class="form-group my-2">
                    <label for="foto_bukti">Photo Evidence:</label>
                    <input type="file" class="form-control mb-3" id="foto_bukti" name="foto_bukti[]" multiple>
                    <div>
                        @if ($rembes_image_item && $rembes_image_item->foto_bukti)
                            @foreach (explode(',', $rembes_image_item->foto_bukti) as $fileName)
                                @if (in_array(pathinfo($fileName, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                    <a href="{{ asset('storage/foto_bukti/' . $fileName) }}" target="_blank">
                                        <img src="{{ asset('storage/foto_bukti/' . $fileName) }}"
                                            alt="{{ $rembes_item->id }}" class="mx-2 rounded border" width="75">
                                    </a>
                                @else
                                    <span class="badge btn-secondary p-2">
                                        <i class="far fa-file-archive"></i>
                                        {{ $fileName }}
                                    </span>
                                @endif
                            @endforeach
                        @else
                            <span class="badge btn-danger">
                                <i class="far fa-times-circle"></i>
                                No Image
                            </span>
                        @endif
                    </div>
                </div>




                <div class="form-group my-3 text-center">
                    <button type="submit" id="buttonText" class="btn btn-primary" onclick="disableButton(this);">
                        <i class="far fa-save"></i>
                        Simpan
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
