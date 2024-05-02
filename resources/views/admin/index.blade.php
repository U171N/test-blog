@extends('admin.admin_dashboard')
@section('admin')
    @php
        use Illuminate\Support\Facades\Route;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Session;
    @endphp
    <!--start page wrapper -->
    <div class="page-content">
        <div class="row-cols-xl-8 d-flex">
            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{count($postingan)  }}</h5>
                            <div class="ms-auto">
                                <i class="bx bx-cart fs-3 text-white"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Postingan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mr-3">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $totalAuthor }}</h5>
                            <div class="ms-auto">
                                <i class="bx bx-group fs-3 text-white"></i>
                            </div>
                        </div>

                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Author</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">

        </div>

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Riwayat Postingan</h5>
                    </div>
                    <div class="font-22 ms-auto">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
                <hr />
                <div class="table-responsive">
                    <table id="example" class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Judul</th>
                                <th>Content</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postingan as $posting)
                                    <tr>
                                        <td>{{ $posting->title }}</td>
                                        <td>{{ $posting->content }}</td>
                                        <td>{{ $posting->date }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
