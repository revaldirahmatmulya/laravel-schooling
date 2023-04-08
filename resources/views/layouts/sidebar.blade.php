<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('master') ? 'active' : '' }}">
                    <a href="{{ route('master.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (Auth::user()->position_id == 1)
                    <li class="nav-section ">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">MASTER</h4>
                    </li>
                    <li class="nav-item {{ request()->is('master/user/*') && !request()->is('master/user/school-profile') ? 'active sub-menu' : '' }}"
                        aria-expanded="{{ request()->is('master/user/*') ? 'true' : 'false' }}">
                        <a data-toggle="collapse" href="#admin">
                            <i class="fas fa-solid fa-user"></i>
                            <p>Master User</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->is('master/user/*') && !request()->is('master/user/school-profile') ? 'show' : '' }}"
                            id="admin">
                            <ul class="nav nav-collapse">
                                <li
                                    class="{{ request()->is('master/user/admin') || request()->is('master/user/admin/*') ? 'active' : '' }}">
                                    <a href="{{ route('master.users.admin.index') }}">
                                        <span class="sub-item">Semua User</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('master/user/staff') || request()->is('master/user/staff/*') ? 'active' : '' }}">
                                    <a href="{{ route('master.users.staff.index') }}">
                                        <span class="sub-item">Staff</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('master/user/guru') || request()->is('master/user/guru/*') ? 'active' : '' }}">
                                    <a href="{{ route('master.users.teacher.index') }}">
                                        <span class="sub-item">Guru</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('master/user/siswa') || request()->is('master/user/siswa/*') ? 'active' : '' }}">
                                    <a href="{{ route('master.users.student.index') }}">
                                        <span class="sub-item">Siswa</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('master/user/ortu') || request()->is('master/user/ortu/*') ? 'active' : '' }}">
                                    <a href="{{ route('master.users.parents.index') }}">
                                        <span class="sub-item">Orang Tua</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('master/user/alumni') || request()->is('master/user/alumni/*') ? 'active' : '' }}">
                                    <a href="{{ route('master.users.alumni.index') }}">
                                        <span class="sub-item">Alumni</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->is('master/user/school-profile') ? 'active' : '' }}">
                        <a href="{{ route('master.school.profile.index') }}">
                            <i class="fas fa-solid fa-school"></i>
                            <p>Profil Sekolah</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('master.news.*') ? 'active sub-menu' : '' }}">
                        <a class="" data-toggle="collapse" href="#news"
                            aria-expanded="{{ request()->routeIs('master.news.*') ? 'true' : 'false' }}">
                            <i class="fas fa-newspaper"></i>
                            <p>Berita</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('master.news.*') ? 'show' : '' }}" id="news">
                            <ul class="nav nav-collapse">
                                <li
                                    class="{{ request()->routeIs('master.news.*') && !request()->routeIs('master.news.category.*') ? 'active' : '' }}">
                                    <a href="{{ route('master.news.index') }}">
                                        <span class="sub-item">Berita</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('master.news.category.*') ? 'active' : '' }}">
                                    <a href="{{ route('master.news.category.index') }}">
                                        <span class="sub-item">Kategori Berita</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (in_array(Auth::user()->position_id, [1, 2, 3, 4, 6]))
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">AKADEMIK</h4>
                    </li>
                @endif


                @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 2)
                    <li class="nav-item {{ request()->is('akademik/user/admin*') ? 'active sub-menu' : '' }}"
                        aria-expanded="{{ request()->is('akademik/user/*') ? 'true' : 'false' }}">
                        <a data-toggle="collapse" href="#akademik-admin">
                            <i class="fas fa-solid fa-user"></i>
                            <p>Manajemen User</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->is('akademik/user/admin/*') || request()->is('akademik/user/admin') ? 'show' : '' }}"
                            id="akademik-admin">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->is('akademik/user/admin') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.users.admin.index') }}">
                                        <span class="sub-item">Semua User</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('akademik/user/admin/guru') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.users.teacher.index') }}">
                                        <span class="sub-item">Guru</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('akademik/user/admin/siswa') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.users.student.index') }}">
                                        <span class="sub-item">Siswa</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('akademik/user/admin/ortu') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.users.parents.index') }}">
                                        <span class="sub-item">Orang Tua</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('akademik/user/admin/alumni') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.users.alumni.index') }}">
                                        <span class="sub-item">Alumni</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li
                        class="nav-item {{ request()->is('akademik/tahun-ajaran*') ||                        
                        request()->is('akademik/jurusan*') ||                        
                        request()->is('akademik/kelas*') ||                        
                        request()->is('akademik/mapel/kategori*') ||                        
                        request()->is('akademik/mapel*')                        
                            ? 'active'
                            : '' }}">
                        <a data-toggle="collapse" href="#data-master">
                            <i class=" fas fa-solid fa-database"></i>
                            <p>Master Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->is('akademik/tahun-ajaran*') ||
                        request()->is('akademik/jurusan*') ||
                        request()->is('akademik/kelas*') ||
                        request()->is('akademik/mapel/kategori*') ||
                        request()->is('akademik/mapel*')
                            ? 'show'
                            : '' }}"
                            id="data-master">
                            <ul class="nav nav-collapse">
                                <li
                                    class="{{ request()->is('akademik/tahun-ajaran') || request()->is('akademik/tahun-ajaran/*') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.school.year.index') }}">
                                        <span class="sub-item">Tahuh Ajaran</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('akademik/jurusan') || request()->is('akademik/jurusan/*') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.major.index') }}">
                                        <span class="sub-item">Jurusan</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('akademik/kelas') || request()->is('akademik/kelas/*') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.classes.index') }}">
                                        <span class="sub-item">Kelas</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('akademik/mapel/kategori') || request()->is('akademik/mapel/kategori/*') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.mapel.category.index') }}">
                                        <span class="sub-item">Ketegori MaPel</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('akademik/mapel') || request()->is('akademik/mapel/add') || request()->is('akademik/mapel/edit/*') ? 'active' : '' }}">
                                    <a href="{{ route('akademik.mapel.index') }}">
                                        <span class="sub-item">Mata Pelajaran</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->is('akademik/setting/kelas') ? 'active' : '' }}">
                        <a href="{{ route('akademik.setting.class.class') }}">
                            <i class="fas fa-wrench"></i>
                            <p>Pengaturan Kelas</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('akademik/pindah-kelas') ? 'active' : '' }}">
                        <a href="{{ route('akademik.pindah.class.class') }}">
                            <i class="fas fa-users"></i>
                            <p>Pindah/Kenaikan Kelas</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->position_id == 3)
                    <li class="nav-item {{ request()->is('akademik/jurnal*') ? 'active' : '' }}">
                        <a href="{{ route('akademik.journal.index') }}">
                            <i class="fas fa-table"></i>
                            <p>Jurnal Harian</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('akademik/laporan/presensi*') ? 'active' : '' }}">
                        <a href="{{ route('akademik.report.attendance.index') }}">
                            <i class="fas fa-solid fa-file"></i>
                            <p>Rekap Presensi Kelas</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->position_id == 4)
                    <li class="nav-item {{ request()->is('akademik/monitor/siswa/todo*') ? 'active' : '' }}">
                        <a href="{{ route('akademik.monitor.student.todo.index') }}">
                            <i class="fas fa-th-list"></i>
                            <p>Todo List Tugas</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('akademik/monitor/siswa/presensi*') ? 'active' : '' }}">
                        <a href="{{ route('akademik.monitor.student.attendance.index') }}">
                            <i class="fas fa-solid fa-file"></i>
                            <p>Rekap Presensi</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('akademik/monitor/siswa/nilai*') ? 'active' : '' }}">
                        <a href="{{ route('akademik.monitor.student.score.index') }}">
                            <i class="fas fa-check"></i>
                            <p>Nilai Tugas Sebelumnya</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('akademik/monitor/siswa/jadwal*') ? 'active' : '' }}">
                        <a href="{{ route('akademik.monitor.student.schedule.index') }}">
                            <i class="fas fa-table"></i>
                            <p>Jadwal Pelajaran</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->position_id == 6)
                    <li class="nav-item {{ request()->is('akademik/monitor*') ? 'active' : '' }}">
                        <a href="{{ route('akademik.monitor.parents.index') }}">
                            <i class="fas fa-eye"></i>
                            <p>Monitoring Dampingan</p>
                        </a>
                        <div class="collapse" id="akademik-admin">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('akademik.monitor.parents.index') }}">
                                        <p>List Dampingan</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 11)
                    <li class="nav-section ">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">UKS</h4>
                    </li>
                    <li class="nav-item {{ request()->is('uks/obat') ? 'active' : '' }}">
                        <a href="{{ route('uks.obat.index') }}">
                            <i class="fas fa-pills"></i>
                            <p>Obat</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('uks/petugas') ? 'active' : '' }}">
                        <a href="{{ route('uks.petugas.index') }}">
                            <i class="fas fa-user-md"></i>
                            <p>Petugas</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('uks/pasien') ? 'active' : '' }}">
                        <a href="{{ route('uks.pasien.index') }}">
                            <i class="fas fa-solid fa-user"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 7)
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">SARPRAS</h4>
                    </li>
                    <li
                        class="nav-item {{ request()->is('sarpras/ruang*') ||
                        request()->is('sarpras/barang/kategori*') ||
                        request()->is('sarpras/supplier*')
                            ? 'active'
                            : '' }}">
                        <a data-toggle="collapse" href="#sarpras-master">
                            <i class="fas fa-solid fa-database"></i>
                            <p>Master Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->is('sarpras/ruang*') ||
                        request()->is('sarpras/barang/kategori*') ||
                        request()->is('sarpras/supplier*')
                            ? 'show'
                            : '' }}"
                            id="sarpras-master">
                            <ul class="nav nav-collapse">
                                <li
                                    class="{{ request()->is('sarpras/ruang') || request()->is('sarpras/ruang/*') ? 'active' : '' }}">
                                    <a href="{{ route('sarpras.ruang.index') }}">
                                        <span class="sub-item">Ruang</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('sarpras/barang/kategori') || request()->is('sarpras/barang/kategori/*') ? 'active' : '' }}">
                                    <a href="{{ route('sarpras.item.category.index') }}">
                                        <span class="sub-item">Kategori Barang</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ request()->is('sarpras/supplier') || request()->is('sarpras/supplier/*') ? 'active' : '' }}">
                                    <a href="{{ route('sarpras.supplier.index') }}">
                                        <span class="sub-item">Supplier</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->is('sarpras/barang') ? 'active' : '' }}">
                        <a href="{{ route('sarpras.item.index') }}">
                            <i class="fas fa-arrow-down"></i>
                            <p>Daftarkan Barang</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('sarpras/barang/keluar') ? 'active' : '' }}">
                        <a href="{{ route('sarpras.item.out.index') }}">
                            <i class="fas fa-arrow-up"></i>
                            <p>Barang Keluar</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('sarpras/pengadaan') ? 'active' : '' }}">
                        <a href="{{ route('sarpras.procurement.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Pengadaan</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 8)
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <h4 class="text-section">KEUANGAN (Pengadaan)</h4>
                    </li>
                    <li class="nav-item {{ request()->is('keuangan/pengajuan') ? 'active' : '' }}">
                        <a href="{{ route('finance.procurement.index') }}">
                            <i class="fas fa-table"></i>
                            <p>Pengadaan</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 10)
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">BUKU TAMU</h4>
                    </li>
                    <li class="nav-item {{ request()->is('tamu') ? 'active' : '' }}">
                        <a href="{{ route('tamu.index') }}">
                            <i class="fas fa-solid fa-book"></i>
                            <p>Buku Tamu</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('tamu/laporan') ? 'active' : '' }}">
                        <a href="{{ route('tamu.laporan.index') }}">
                            <i class="fas fa-solid fa-file"></i>
                            <p>Laporan Buku Tamu</p>
                        </a>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">ARSIP</h4>
                    </li>
                    <li class="nav-item {{ request()->is('arsip/surat*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#surat-master">
                            <i class="fas fa-solid fa-book"></i>
                            <p>Data Surat</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->is('arsip/surat*') ? 'show' : '' }}" id="surat-master">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->is('arsip/surat/kategori*') ? 'active' : '' }}">
                                    <a href="{{ route('arsip.surat.category.index') }}">
                                        <span class="sub-item">Kategori</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('arsip/surat/keluar*') ? 'active' : '' }}">
                                    <a href="{{ route('arsip.surat.out.index') }}">
                                        <span class="sub-item">Surat Keluar</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('arsip/surat/masuk*') ? 'active' : '' }}">
                                    <a href="{{ route('arsip.surat.in.index') }}">
                                        <span class="sub-item">Surat Masuk</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->is('arsip/laporan*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#laporan-surat-master">
                            <i class="fas fa-solid fa-file"></i>
                            <p>Laporan Surat</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->is('arsip/laporan*') ? 'show' : '' }}"
                            id="laporan-surat-master">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->is('arsip/laporan/masuk*') ? 'active' : '' }}">
                                    <a href="{{ route('arsip.report.in.index') }}">
                                        <span class="sub-item">Surat Masuk</span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('arsip/laporan/keluar*') ? 'active' : '' }}">
                                    <a href="{{ route('arsip.report.out.index') }}">
                                        <span class="sub-item">Surat Keluar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (Auth::user()->position_id == 1 || Auth::user()->position_id == 9)
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">PERPUSTAKAAN</h4>
                    </li>
                    <li class="nav-item  {{ request()->is('perpustakaan/buku*') ? 'active' : '' }}">
                        <a href="{{ route('perpustakaan.book.index') }}">
                            <i class="fas fa-solid fa-book"></i>
                            <p>Data Buku</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('perpustakaan/peminjam*') ? 'active' : '' }}">
                        <a href="{{ route('perpustakaan.rental.index') }}">
                            <i class="fas fa-arrow-up"></i>
                            <p>Data Peminjam</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('perpustakaan/kategori*') ? 'active' : '' }}">
                        <a href="{{ route('perpustakaan.category.index') }}">
                            <i class="fas fa-th-list"></i>
                            <p>Kategori Buku</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('perpustakaan/penulis*') ? 'active' : '' }}">
                        <a href="{{ route('perpustakaan.author.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Data Penulis</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
