
  {{-- Main Sidebar Container --}}
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Brand Logo --}}
    <a href="/" class="brand-link">
      <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MTI</span>
    </a>

    {{-- Sidebar --}}
    <div class="sidebar">
      {{-- Sidebar user (optional) --}}
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">User Admin</a>
        </div>
      </div> --}}

      {{-- Sidebar Menu --}}
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column"  data-widget="treeview" role="menu" data-accordion="false">
    
            <li class="nav-item has-treeview">
                <a href="/dashboard" class="nav-link @yield('dashboard') ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            @role('owner|admin|lord|finance|accounting|manager')

            {{-- Pemasaran --}}
            <li class="nav-item has-treeview @yield('pemasaran-open')">
                <a href="#" class="nav-link @yield('pemasaran-active')">
                    <i class="nav-icon fa fa-file"></i>
                    <p>
                        Pemasaran
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('kontrak.index')}}" class="nav-link @yield('kontrak-active')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Kontrak</p>
                        </a>
                    </li>
                </ul>
            </li>

            @role('owner|lord')
            {{-- Operasional --}}
            <li class="nav-item has-treeview @yield('menu-op')">
                <a href="#" class="nav-link @yield('op')">
                    <i class="nav-icon fa fa-truck"></i>
                    <p>
                        Operasional
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    
                    <li class="nav-item has-treeview">
                        <a href="{{route('persetujuanbudget.index')}}" class="nav-link @yield('po')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Persetujuan Budget</p>
                        </a>
                    </li>

                </ul>
            </li>
            @endrole

            {{-- Keuangan --}}
            <li class="nav-item has-treeview @yield('menu-keuangan')">
                <a href="#" class="nav-link @yield('keuangan')">
                    <i class="nav-icon fa fa-balance-scale" ></i>
                    <p>
                        Keuangan
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                        <a href="{{route('keuangan.cabang')}}" class="nav-link @yield('keuangan-cabang')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Keuangan Cabang</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('suratjalan.index')}}" class="nav-link @yield('reconcile')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Surat Jalan</p>
                        </a>
                    </li>

                    @role('owner|lord|finance|accounting|manager')
                    <li class="nav-item">
                        <a href="{{route('invoice.index')}}" class="nav-link @yield('invoice')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Invoice</p>
                        </a>
                    </li>
                    @endrole

                    <li class="nav-item @yield('menu-payment')">
                        <a href="#" class="nav-link @yield('payment')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Payment<i class="right fas fa-angle-left"></i></p>
                        </a>
                        
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('payment.belum.index')}}" class="nav-link @yield('belumlunas')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Belum Lunas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('payment.lunas.index')}}" class="nav-link @yield('lunas')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lunas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            @role('owner|lord|accounting|manager')
            {{-- Akuntansi --}}
            <li class="nav-item has-treeview @yield('akuntansi-menu')">
                <a href="#" class="nav-link @yield('akuntansi-active')">
                    <i class="nav-icon fas fa-dollar-sign"></i>
                    <p>
                        Akuntansi
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                
                <ul class="nav nav-treeview">

                    <li class="nav-item @yield('siklus-menu')">
                        <a href="#" class="nav-link @yield('siklus-active')">
                            <i class="fas fa-calculator nav-icon"></i>
                            <p>
                                Siklus
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('kode-akun.index')}}" class="nav-link @yield('kode-akun')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kode Akun</p>
                                </a>
                            </li>
        
                            <li class="nav-item">
                                <a href="{{route('posting.index')}}" class="nav-link @yield('posting')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jurnal</p>
                                </a>
                            </li>
        
                            {{-- <li class="nav-item">
                                <a href="/akuntansi/laporan" class="nav-link @yield('laporan')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Akuntansi</p>
                                </a>
                            </li> --}}

                        </ul>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="./index.html" class="nav-link">
                            <i class="fas fa-clock nav-icon"></i>
                            <p>
                                Kegiatan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="/invoice" class="nav-link @yield('reconcile')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Buka Kantor</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/invoice" class="nav-link @yield('reconcile')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tutup Kantor</p>
                                </a>
                            </li>
        
                        </ul>

                    </li> --}}

                </ul>
            </li>
            @endrole

            {{-- Others --}}
            <li class="nav-item has-treeview @yield('other-open')">
                <a href="#" class="nav-link @yield('other-active')">
                  <i class="nav-icon fa fa-archive"></i>
                  <p>
                    Others
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                    @role('lord|owner|manager')
                    <li class="nav-item">
                        <a href="{{route('payroll-periode.index')}}" class="nav-link @yield('payroll')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Payroll</p>
                        </a>
                    </li>
                    @endrole

                    <li class="nav-item">
                        <a href="{{route('leasing.index')}}" class="nav-link @yield('leasing')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Leasing</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('purchasing.index')}}" class="nav-link @yield('purchasing')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Purchasing</p>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- Laporan --}}
            <li class="nav-item has-treeview @yield('laporan-open')">
                <a href="#" class="nav-link @yield('laporan-active')">
                  <i class="nav-icon fa fa-archive"></i>
                  <p>
                    Laporan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('laporan.sj.index')}}" class="nav-link @yield('laporan-sj')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan SJ Belum diterima</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('laporan.sj1.index')}}" class="nav-link @yield('laporan-sj1')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan Surat Jalan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('laporan.omset.index')}}" class="nav-link @yield('laporan-omset')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan Omset</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('laporan.ar.index')}}" class="nav-link @yield('laporan-ar')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan AR</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('laporan.ap.index')}}" class="nav-link @yield('laporan-ap')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan AP</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('laporan.gp.index')}}" class="nav-link @yield('laporan-gp')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan GP Kontrak</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('laporan.gpa.index')}}" class="nav-link @yield('laporan-gpa')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan GP Armada</p>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- Master --}}
            <li class="nav-item has-treeview @yield('master-open')">
                <a href="#" class="nav-link @yield('master-active')">
                  <i class="nav-icon fa fa-database"></i>
                  <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('driver.index')}}" class="nav-link @yield('driver-active')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Driver</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('kendaraan.index')}}" class="nav-link @yield('kendaraan-active')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Kendaraan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('jeniskendaraan.index')}}" class="nav-link @yield('jeniskendaraan-active')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Jenis Kendaraan</p>
                        </a>
                    </li>

                    @role('owner|lord|manager')
                    <li class="nav-item">
                        <a href="{{route('karyawan.index')}}" class="nav-link @yield('karyawan-active')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Karyawan</p>
                        </a>
                    </li>
                    @endrole

                    <li class="nav-item">
                        <a href="{{route('region.index')}}" class="nav-link @yield('region-active')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Region</p>
                        </a>
                    </li>

                    @role('owner|lord|manager')
                    <li class="nav-item">
                        <a href="{{route('jabatan.index')}}" class="nav-link @yield('jabatan-active')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Jabatan</p>
                        </a>
                    </li>
                    @endrole

                    <li class="nav-item">
                        <a href="{{route('partner.index')}}" class="nav-link @yield('partner-active')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Partner</p>
                        </a>
                    </li>

                </ul>
            </li>
            @endrole

            @role('user')
            
            {{-- Operasional --}}
            <li class="nav-item has-treeview @yield('menu-op')">
                <a href="#" class="nav-link @yield('op')">
                  <i class="nav-icon fa fa-truck"></i>
                    <p>
                        Operasional
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item has-treeview">
                    <a href="{{route('po.index')}}" class="nav-link @yield('po')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengajuan Budget</p>
                    </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{route('sj.index')}}" class="nav-link @yield('sj')">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Surat Jalan</p>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('pengeluaran.index')}}" class="nav-link @yield('pengeluaran')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengeluaran</p>
                    </a>
                  </li>

                </ul>
            </li>
            
            @endrole

            {{-- Pengaturan --}}
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-cog"></i>
                    <p>
                        Pengaturan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/klien" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Profil</p>
                        </a>
                    </li>
                    @role('lord')
                    <li class="nav-item">
                        <a href="/klien" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/kontrak" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Role</p>
                        </a>
                    </li>
                    @endrole
                </ul>
            </li>

            <li class="nav-item">
                <a href="/logout" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Sign Out
                    </p>
                </a>
            </li>

        </ul>
      </nav>
      {{-- /.sidebar-menu --}}
    </div>
    {{-- /.sidebar --}}
  </aside>
