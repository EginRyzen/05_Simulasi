@extends('front')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Timeline</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Timeline</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline time label -->
                        <!-- timeline item -->
                        @foreach ($galery as $item)
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i>
                                        {{ $item->created_at->diffForHumans() }}</span>
                                    <a href="{{ asset('img/' . $item->foto) }}" data-toggle="lightbox"
                                        data-title="{{ $item->foto }}" data-gallery="gallery">
                                        <img src="{{ asset('img/' . $item->foto) }}" alt="" height="500"
                                            class="d-block m-auto py-5">
                                    </a>

                                    <div class="timeline-body">
                                        <h3>{{ $item->judul }}</h3>
                                        {{ $item->deskripsi }}
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modal-update{{ $item->id }}">Edit</a>
                                        <a href="{{ url('timeline/' . $item->id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin Untuk Di Hapus??')">Delete</a>
                                    </div>
                                    {{-- Modal Update --}}
                                    <div class="modal fade" id="modal-update{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ url('timeline/' . $item->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" name="judul"
                                                                value="{{ $item->judul }}" maxlength="100"
                                                                placeholder="Judul" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea rows="5" type="text" name="deskripsi" class="form-control">{{ $item->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="file" id="inputUpdate{{ $item->id }}"
                                                                name="foto">
                                                        </div>
                                                        <div class="form-group">
                                                            @if ($item->foto)
                                                                <img src="{{ asset('img/' . $item->foto) }}"
                                                                    id="previewUpdate{{ $item->id }}"
                                                                    style="width: 100%; max-width:150px; height:200px"
                                                                    alt="">
                                                            @else
                                                                <img id="previewUpdate{{ $item->id }}"
                                                                    style="width: 100%; max-width:150px; height:200px"
                                                                    alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- END timeline item -->
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.timeline -->

    </section>
    <!-- /.content -->
@endsection
