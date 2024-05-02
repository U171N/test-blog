<!--sidebar wrapper -->
@php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
@endphp
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('frontend/assets/imgs/icon/icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Postingan</div>
            </a>
            <ul>
                <li> <a href="{{ route('posts.admin') }}"><i class="bx bx-right-arrow-alt"></i>Daftar Postingan</a>
                </li>
                <li> <a href="{{ route('tambah.post.admin') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Postingan</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Kelola Akun</div>
            </a>
            <ul>
                <li> <a href="{{ route('author.admin') }}"><i class="bx bx-right-arrow-alt"></i>Daftar akun</a>
                </li>
                <li> <a href="{{ route('tambah.author') }}"><i class="bx bx-right-arrow-alt"></i>Tambah akun</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
