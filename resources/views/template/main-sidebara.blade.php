<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <li class="active treeview">
          <a href="#'>
            <i class="fa fa-folder"></i> <span>Data Diri Pasien</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(auth()->guard('dokter')->check())
              <li><a href="{{url('/lihat_obat/'.$dtpasien->nomorRM)}}"><i class="fa fa-medkit"></i>Obat Pasien</a></li>
              
            @elseif(auth()->guard('perawat')->check())
              <li><a href="{{ action ('Perawat\AAP_Controller@lihatasesmen',$dtpasien->nmrRM)}}"><i class="fa fa-files-o"></i>Asesmen Awal</a></li>
              <li><a href="{{url('daftarper/'.$dtpasien->nmrRM)}}"><i class="fa fa-files-o"></i>Daftar Masalah</a></li>
            @endif
           </ul>
        </li>

        </ul>
 
    </section>
    <!-- /.sidebar -->
  </aside>