{{-- call header and footer --}}
@extends('layouts.main')
@section('title', 'Edit Nilai')

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
                                        <div class="card-title">Form Update Nilai</div>
                                        <div class="card-subtitle mt-1">Nilai tugas {{$task->name}} dari {{$score->student->user->name}} </div>
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="{{ route('akademik.journal.task.score.update', ['dailyJournal' => $dailyJournal, 'task' => $task, 'score' => $score]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group col-md-6">
                                                <label for="title">Nilai Tugas</label>
                                                <input type="number" class="form-control" id="value" name="value"
                                                    placeholder="Masukkan nilai tugas" value="{{ old('value', $score->value) }}">
                                                @error('value')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                                           
                                    </div>
                                    <div class="d-flex col-3 mb-4 justify-content-start">
                                        <button class="btn btn-primary btn-rounded">Update Nilai</button>
                                        <a href="{{ route('akademik.journal.task.score.index', ['dailyJournal' => $dailyJournal, 'task' => $task]) }}" type="button"
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
