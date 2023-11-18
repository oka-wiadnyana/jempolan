<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                   
                </li>
                <!-- User Profile-->
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/') }}" aria-expanded="false">
                            <i class="icon-Home"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                  
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Apps</span>
                </li>
                @if (auth()->user()->level->level_name=='super_admin'||auth()->user()->level->level_name=='admin'||auth()->user()->level->level_name=='hukum')
                <li class="sidebar-item">
                  
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Sunglasses-Smiley"></i>
                        <span class="hide-menu">Kepaniteraan Hukum </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                       
                        <li class="sidebar-item">
                            <a href="{{ url('report/bulanan/hukum') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Bulanan </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('report/triwulan/hukum') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Triwulan </span>
                            </a>
                        </li>
                        
                    </ul>
                </li>   
                @endif
               
                @if (auth()->user()->level->level_name=='super_admin'||auth()->user()->level->level_name=='admin'||auth()->user()->level->level_name=='perdata')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Sunglasses-Smiley"></i>
                        <span class="hide-menu">Kepaniteraan Perdata </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ url('report/mingguan/perdata') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Mingguan </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('report/bulanan/perdata') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Bulanan </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('report/triwulan/perdata') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Triwulan </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('report/semester/perdata') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Semester </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('report/tahunan/perdata') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Tahunan </span>
                            </a>
                        </li>
                      
                    </ul>
                </li>
                @endif

                 
                @if (auth()->user()->level->level_name=='super_admin'||auth()->user()->level->level_name=='admin'||auth()->user()->level->level_name=='pidana')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Sunglasses-Smiley"></i>
                        <span class="hide-menu">Kepaniteraan Pidana </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ url('report/mingguan/pidana') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Mingguan </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('report/bulanan/pidana') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Bulanan </span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                @endif

                @if (auth()->user()->level->level_name=='super_admin'||auth()->user()->level->level_name=='admin'||auth()->user()->level->level_name=='ptip')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Sunglasses-Smiley"></i>
                        <span class="hide-menu">PTIP </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                       
                        <li class="sidebar-item">
                            <a href="{{ url('report/bulanan/ptip') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Bulanan </span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                @endif

                @if (auth()->user()->level->level_name=='super_admin'||auth()->user()->level->level_name=='admin'||auth()->user()->level->level_name=='kepeg_ortala')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Sunglasses-Smiley"></i>
                        <span class="hide-menu">Kepegawaian & Ortala </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                       
                        <li class="sidebar-item">
                            <a href="{{ url('report/bulanan/kepeg_ortala') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Bulanan </span>
                            </a>
                        </li>
                      
                    </ul>
                </li>
                @endif

                @if (auth()->user()->level->level_name=='super_admin'||auth()->user()->level->level_name=='admin'||auth()->user()->level->level_name=='umum_keu')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-Sunglasses-Smiley"></i>
                        <span class="hide-menu">Umum & Keuangan </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                       
                        <li class="sidebar-item">
                            <a href="{{ url('report/bulanan/umum_keu') }}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Bulanan </span>
                            </a>
                        </li>
                       
                    </ul>
                </li>
                @endif

                @if (auth()->user()->level->level_name=='super_admin')
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Ref</span>
                </li>
                <li class="sidebar-item">
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('jenis_laporan') }}" aria-expanded="false">
                            <i class="icon-Line-Chart3"></i>
                            <span class="hide-menu">Jenis Laporan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="icon-Sunglasses-Smiley"></i>
                                <span class="hide-menu">Ref. Object </span>
                            </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('ref/object_monev/mingguan') }}" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu"> Mingguan </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('ref/object_monev/bulanan') }}" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu"> Bulanan </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('ref/object_monev/triwulan') }}" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu"> Triwulan </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('ref/object_monev/semester') }}" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu"> Semester </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('ref/object_monev/tahunan') }}" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu"> Tahunan </span>
                                    </a>
                                </li>
                                
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('daftar_akun') }}" aria-expanded="false">
                            <i class="icon-User"></i>
                            <span class="hide-menu">Akun</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('daftar_pejabat') }}" aria-expanded="false">
                            <i class="icon-Line-Chart3"></i>
                            <span class="hide-menu">Pejabat</span>
                        </a>
                    </li>
                  
                </li>
                @endif

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('logout') }}" aria-expanded="false">
                        <i class="mdi mdi-directions"></i>
                        <span class="hide-menu">Log Out</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>