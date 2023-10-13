@extends('backendlayouts.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Registered Managers</h1>
        <div class="card mb-4">
            <div class="card-header text-end">
                <button class="btn btn-primary" onclick="fn.addUserModal()"><i class="fas fa-plus-circle"></i> Add Manager</i></button>
            </div>

            <div class="card-body table-responsive">
                <table class="table-centered display" id="usersTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Information</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->information }}</td>
                            <td>
                                <button class="btn btn-success btn-sm w-75p me-2" onclick="fn.editUserModal({{ $user->id }})"><i class="fas fa-edit"></i> Edit</button>
                                <button class="btn btn-danger btn-sm w-75p" onclick="fn.deleteUserModal({{ $user->id }})"><i class="fas fa-trash-alt"></i> Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection

@push('modals')
<!-- User Modal -->
<div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('user.save') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" style="margin: 0 auto">User Information</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="userName" class="form-label">User Name <span class="text-danger">*</span></label>
                    <input type="text" id="userName" name="name" class="form-control mb-3" required>
                    @if($errors->has('name'))
                        <p><small class="text-danger">{{$errors->first('name')}}</small></p>
                        <input type="hidden" class="errorMsg" value="{{$errors->first('name')}}">
                    @endif
                    <label for="userEmail" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" id="userEmail" name="email" class="form-control mb-3" required>
                    @if($errors->has('email'))
                        <p><small class="text-danger">{{$errors->first('email')}}</small></p>
                        <input type="hidden" class="errorMsg" value="{{$errors->first('email')}}">
                    @endif
                    <label for="userPhone" class="form-label">Phone <span class="text-danger">*</span></label>
                    @if($errors->has('phone'))
                        <p><small class="text-danger">{{$errors->first('phone')}}</small></p>
                        <input type="hidden" class="errorMsg" value="{{$errors->first('phone')}}">
                    @endif
                    <input type="text" id="userPhone" name="phone" class="form-control mb-3" required>
                    <label for="userAddress" class="form-label">Address</label>
                    <input type="text" id="userAddress" name="address" class="form-control mb-3" required>
                    <label for="userInfo" class="form-label">Information</label>
                    <input type="text" id="userInfo" name="information" class="form-control mb-3">
                    <input type="hidden" id="userId" name="id">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-base me-3" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" id="userSave" class="btn btn-success btn-base"><i class="fas fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="GET" action="{{ route('user.delete') }}" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="margin: 0 auto">Confirm</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure delete this user account?</p>
                <input type="hidden" id="userConfirmId" name="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-base me-3" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
                <button type="submit" class="btn btn-danger btn-base"><i class="fas fa-check-circle"></i> OK</button>
            </div>
        </form>
    </div>
</div>
@endpush

@push('styles')
    <link href="{{asset('assets/backend/plugins/datatable@1.13.2/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('assets/backend/plugins/datatable@1.13.2/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/admin/users.js')}}"></script>
@endpush
