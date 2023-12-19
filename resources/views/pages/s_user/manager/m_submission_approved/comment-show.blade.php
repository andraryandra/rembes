@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- BREADCRUMB -->
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Submission Approved Details</li>
                </ol>
            </nav>
        </div>
        <!-- /BREADCRUMB -->

        @include('layouts.partials.alert-prompt.alert')

        <div class="row justify-content-center my-2">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

                <!-- CARD FOR DL -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Data Reimburse</h5>

                    </div>
                    <div class="card-body">

                        <!-- Table with borders -->
                        <table class="table" style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="border: 1px solid #dee2e6;">Reimburse ID:</th>
                                    <td style="border: 1px solid #dee2e6;">#{{ $rembes->id }}</td>
                                </tr>
                                <tr>
                                    <th style="border: 1px solid #dee2e6;">Reimburse Name:</th>
                                    <td style="border: 1px solid #dee2e6;">{{ $rembes->name }}</td>
                                </tr>

                                <tr>
                                    <th style="border: 1px solid #dee2e6;">Reimburse Date:</th>
                                    <td style="border: 1px solid #dee2e6;">
                                        @php
                                            $tanggal = \Carbon\Carbon::parse($rembes->tanggal_ticket)->locale('id_ID');
                                        @endphp
                                        {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="border: 1px solid #dee2e6;">Reimburse Category:</th>
                                    <td style="border: 1px solid #dee2e6;">{{ $rembes->categoryTahun->nama_category_tahun }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="border: 1px solid #dee2e6;">Reimburse Status:</th>
                                    <td style="border: 1px solid #dee2e6;">
                                        @if ($rembes->status == 'PENDING')
                                            <span class="badge badge-warning">{{ $rembes->status }}</span>
                                        @elseif($rembes->status == 'APPROVED')
                                            <span class="badge badge-info">{{ $rembes->status }}</span>
                                        @elseif($rembes->status == 'REJECTED')
                                            <span class="badge badge-danger">{{ $rembes->status }}</span>
                                        @elseif($rembes->status == 'SUCCESS')
                                            <span class="badge badge-success">{{ $rembes->status }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $rembes->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </thead>
                        </table>
                        <!-- /Table with borders -->
                    </div>
                </div>

                <!-- /CARD FOR DL -->

                <!-- CARD FOR TABLE -->
                <div class="card">
                    <div class="card-header fw-bold">
                        <h5>Details List Rembes</h5>
                    </div>
                    <!-- TABLE -->
                    <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Reimburse Item</th>
                                <th>Nominal</th>
                                <th>Date Reimburse</th>
                                <th>Photo Evidence</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($rembes_item as $data_rembes_item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data_rembes_item->nama_rembes }}</td>
                                    <td>Rp. {{ number_format($data_rembes_item->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $tanggal = \Carbon\Carbon::parse($data_rembes_item->tanggal_rembes)->locale('id_ID');
                                        @endphp
                                        {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                    </td>
                                    <td>
                                        @foreach ($rembes_item as $item)
                                            @if ($item->foto_bukti)
                                                @foreach (explode(',', $item->foto_bukti) as $file)
                                                    @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                        <a href="{{ asset('storage/foto_bukti/' . $file) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/foto_bukti/' . $file) }}"
                                                                alt="{{ $item->id }}" class="mx-2 rounded border"
                                                                width="110">
                                                        </a>
                                                    @else
                                                        <span class="badge btn-info text-center">
                                                            <a href="#" download="{{ $file }}"
                                                                class="text-white">
                                                                <i class="far fa-file-archive d-block"></i>
                                                                {{ $file }}
                                                            </a>
                                                        </span>
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="badge btn-danger">
                                                    <i class="far fa-times-circle"></i>
                                                    No Image
                                                </span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ Str::limit($item->deskripsi, 50, '...') ?? 'No Description' }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /TABLE -->
                </div>
                <!-- /CARD FOR TABLE -->

                {{-- <div class="card my-3">
                    <div class="card-header fw-bold">
                        <h5>Photo Evidence</h5>
                    </div>
                    <div class="p-3">
                        @foreach ($rembes_item as $item)
                            @if ($item->foto_bukti)
                                @foreach (explode(',', $item->foto_bukti) as $file)
                                    @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                        <a href="{{ asset('storage/foto_bukti/' . $file) }}" target="_blank">
                                            <img src="{{ asset('storage/foto_bukti/' . $file) }}"
                                                alt="{{ $item->id }}" class="mx-2 rounded border" width="200">
                                        </a>
                                    @else
                                        <span class="badge btn-info text-center">
                                            <a href="#" download="{{ $file }}" class="text-white">
                                                <i class="far fa-file-archive d-block" style="font-size: 30px;"></i>
                                                {{ $file }}
                                            </a>
                                        </span>
                                    @endif
                                @endforeach
                            @else
                                <span class="badge btn-danger">
                                    <i class="far fa-times-circle"></i>
                                    No Image
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div> --}}


                <div class="card  my-3">

                    <h2 class="mb-5  mx-3 my-3">Comments <span class="comment-count">({{ $comment->count() }})</span></h2>

                    <div class="post-comments  mx-3 my-3">

                        @forelse ($comment as $comments)
                            <div class="media mb-5 pb-5 primary-comment">
                                <div class="avatar me-4">
                                    <img alt="avatar" src="{{ asset('assets/src/assets/img/profile-2.jpeg') }}"
                                        class="rounded-circle" />
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading mb-1">{{ $comments->user->name }}</h5>
                                    <div class="meta-info mb-0">
                                        @php
                                            $tanggal = \Carbon\Carbon::parse($comments->created_at)->locale('id_ID');
                                            $lastDate = \Carbon\Carbon::parse($comments->created_at);
                                            $formattedDate = $lastDate->diffForHumans();
                                        @endphp
                                        {{ $tanggal->isoFormat('dddd, D MMMM YYYY, HH:mm:ss') ?? 'No Date' }} -
                                        {{ $formattedDate ?? 'No Date' }}
                                    </div>
                                    <p class="media-text mt-2 mb-0 description">
                                        {{ $comments->comment }}
                                    </p>

                                    <!-- <button class="btn btn-success btn-reply">Reply</button> -->
                                    @auth
                                        @if (Auth::user()->id == $comments->user_id)
                                            <button class="btn btn-success btn-icon btn-reply btn-rounded"
                                                data-bs-toggle="modal" data-bs-target="#editComment{{ $comments->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    @endauth

                                    <!-- Modal -->
                                    <div class="modal fade" id="editComment{{ $comments->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editCommentLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCommentLabel">Edit Comment </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x">
                                                            <line x1="18" y1="6" x2="6"
                                                                y2="18"></line>
                                                            <line x1="6" y1="6" x2="18"
                                                                y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <form
                                                    action="{{ route('dashboard.submission.commentUpdate', ['id' => $comments->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <div class="mb-3 container">
                                                                <label class="form-label">Write Comment</label>
                                                                <textarea class="form-control" name="comment" cols="30" rows="10" placeholder="Write your text">{{ $comments->comment }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Tambahkan input tersembunyi untuk comment_id -->
                                                    <input type="hidden" name="comment_id" value="{{ $comments->id }}">

                                                    <div class="text-center my-3">
                                                        <button type="submit" class="btn btn-success" title="Save">
                                                            <i class="fas fa-plus"></i> Edit Comment
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        @empty

                            <div class="text-center">
                                <h4>
                                    <i> No Comment</i>
                                </h4>
                            </div>
                        @endforelse

                        <div class="post-pagination mt-4 d-flex justify-content-center">
                            {{ $comment->links() }}
                        </div>

                    </div>
                    <div class="post-form  mx-3 my-3">

                        <div class="section add-comment">
                            <div class="info">
                                <h6 class="">Add Comment</h6>
                                <p>Add your <span class="text-success">comment</span> to this post.</p>
                                <form action="{{ route('dashboard.submission.commentStore', $rembes->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Write Comment</label>
                                                <textarea class="form-control" name="comment" id="editor" cols="30" rows="10"
                                                    placeholder="Write your text"></textarea>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center my-3">
                                        <button type="submit" class="btn btn-success" title="Save">
                                            <i class="fas fa-plus"></i> Add Comment
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>
                <!-- /COMMENTS SECTION -->

            </div>
        </div>
    </div>


    <style>
        .description {
            white-space: pre-line;
        }
    </style>
    @push('script')
    @endpush
@endsection
