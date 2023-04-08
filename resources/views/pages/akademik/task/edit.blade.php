{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Edit Tugas')

@section('content')

    <body>
        <div class="wrapper">
            {{-- call header --}}
            @include('layouts.header')
            {{-- call sidebar --}}
            @include('layouts.sidebar')
            <div class="main-panel">
                <div class="content">
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-5">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div>
                                    <h2 class="text-white pb-2 fw-bold"></h2>
                                    <h5 class="text-white op-7 mb-2"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header card-info">
                                        <div class="card-title">Form Update Tugas</div>
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="{{ route('akademik.journal.task.update', ['dailyJournal' => $dailyJournal, 'task' => $task]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group col-md-6">
                                                <label for="title">Nama Tugas</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Masukkan judul tugas" value="{{ old('name', $task->name) }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="description">Deskripsi Tugas</label>
                                                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Ini Deskrispi Tugas">{{ old('description', $task->description) }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="deadline">Deadline Tugas</label>
                                                <input type="date" class="form-control" id="deadline"
                                                    name="deadline" value="{{ old('deadline', $task->deadline) }}">
                                                @error('deadline')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="d-flex col-3 mb-4 justify-content-start">
                                        <button class="btn btn-primary btn-rounded">Update Tugas</button>
                                        <a href="{{ route('akademik.journal.task.index', ['dailyJournal' => $dailyJournal]) }}" type="button"
                                            class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">

                    <div class="copyright ml-auto">
                        {{ date('Y') }}, made with <i class="fa fa-heart heart text-danger"></i> by <a
                            href="https://weboendercommunity.github.io/web/">Weboender Community</a>
                    </div>
                </div>
            </footer>
        </div>
        </div>
    </body>

@endsection
