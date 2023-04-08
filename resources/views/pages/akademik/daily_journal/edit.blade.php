{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Edit Jurnal')

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
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header card-info">
                                        <div class="card-title">Form Edit Jurnal Harian</div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('akademik.journal.update',['dailyJournal' => $journal]) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="title">Judul Jurnal</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        aria-describedby="title" placeholder="Judul"
                                                        value="{{ old('title', $journal->title) }}">
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="description">Deskripsi Jurnal</label>
                                                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Ini Deskrispi Jurnal">{{ old('description', $journal->description) }}</textarea>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="class">Kelas</label>
                                                    <select class="form-control" name="class" id="class"
                                                        style="width: 100%">
                                                        <option value="">- PILIH -</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}"
                                                                {{ old('class', $journal->class_id) == $class->id ? 'selected' : '' }}>
                                                                {{ strtoupper($class->code) }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('class')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="subject">Mata Pelajaran</label>
                                                    <select class="form-control" name="subject" id="subject"
                                                        style="width: 100%">
                                                        <option value="">- PILIH -</option>
                                                        @foreach ($subjects as $subject)
                                                            <option value="{{ $subject->id }}"
                                                                {{ old('subject',$journal->subject_id) == $subject->id ? 'selected' : '' }}>
                                                                {{ strtoupper($subject->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subject')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="subject">Tanggal</label>
                                                    <input type="date" class="form-control" id="journal_date"
                                                        name="journal_date" value="{{ old('journal_date', $journal->date) }}">
                                                    @error('journal_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-2 float-right">
                                                <a type="button" href="{{ route('akademik.journal.index') }}"
                                                    class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                                <button type="submit" class="btn btn-primary btn-rounded ml-2">Update
                                                    Jurnal Harian</button>
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

@section('js')
@endsection
