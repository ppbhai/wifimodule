@include('masterlayout.masterlayout', ['title' => 'Wifi'])

<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Wifi</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wifi</li>
                    </ol>
                </div>
            </div>

            @if (Session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session('success') }}
                </div>
            @endif

            @if (Session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session('error') }}
                </div>
            @endif

            <!-- Wifi name form -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="row g-3" action="{{ route('wifisave') }}" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Wifi Name" value="{{ $admin->wifiname }}" required>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>

        </div> <!-- container-fluid -->

        <!-- Usage table -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Usage</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable"
                                class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Password</th>
                                        <th>Created Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $co = 1; ?>
                                    @foreach ($usages as $usage)
                                        <tr>
                                            <td>{{ $co }}</td>
                                            <td>{{ $usage->name }}</td>
                                            <td>{{ $usage->password }}</td>
                                            <td>{{ $usage->created_at }}</td>
                                            <td>
                                                <a aria-label="anchor"
                                                    class="btn btn-icon btn-sm bg-danger-subtle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete-modal-{{ $usage->id }}">
                                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                </a>

                                                <!-- Delete Confirmation Modal -->
                                                <div class="modal fade" id="delete-modal-{{ $usage->id }}"
                                                    tabindex="-1" aria-labelledby="standard-modalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="standard-modalLabel">Confirm Delete?</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>Are you sure you want to delete this usage
                                                                    record?</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <a href="{{ route('usagedelete', ['usage' => $usage->id]) }}"
                                                                    class="btn btn-danger">Yes, Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $co++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
