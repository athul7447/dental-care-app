@extends('admin.layout')
@section('content')
@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctors </span></h4>
    <div class="row">
        <div class="card">
            <div class="table-head p-3">
                @if (session('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <a href="{{ route('admin.portal.doctors.create') }}">
                    <button class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i>
                        Add Doctor
                    </button>
                </a>
            </div>
            <div class="table-responsive text-nowrap ">
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Qualification</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Verified</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td><img class="avatar mr-2 avatar-sm rounded-circle"
                                @if ($doctor->getImage())
                                    src="{{ asset('/storage/doctors/'.$doctor->image) }}"
                                @else
                                    src="{{ asset('doctor_assets/img/avatar/avatar-3.png') }}"
                                @endif
                                alt="image"></td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->qualification }}</td>
                            <td>{{ $doctor->address }}</td>
                            <td>{{ $doctor->phone }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input float-center verify" data-action="{{ route('admin.portal.doctors.verify',$doctor->id) }}" type="checkbox" role="switch"
                                    {{ $doctor->isVerified()?'checked':'' }}>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input float-center status" data-action="{{ route('admin.portal.doctors.status',$doctor->id) }}" type="checkbox" role="switch"
                                    {{ $doctor->isActive()?'checked':'' }}>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.portal.doctors.edit',$doctor->id) }}">
                                    <button class="btn btn-primary btn-sm"><i class="bx bx-edit-alt me-1"></i> </button>
                                </a>
                                <button data-action="{{ route('admin.portal.doctors.delete',$doctor->id) }}" class="btn btn-danger btn-sm delete-data"><i class="bx bx-trash me-1"></i></i> </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
    </div>
</div>
@push('scripts')
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready( function () {
        $('.datatable').DataTable();
        $('.delete-data').on('click', function(e){
            e.preventDefault();
            var url = $(this).data('action');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
        $('.verify').on('click', function(e){
            e.preventDefault();
            if($(this).prop('checked')){
                var url = $(this).data('action');
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, verify it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        });
        $('.status').on('click', function(e){
            e.preventDefault();
            var url = $(this).data('action');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endpush


@endsection
