<div>

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">View Profile</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">View Profile</li>
        </ul>
    </div>
    <div class="row gy-4">
        <div class="col-lg-4">
            <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                <div class="bbb" style="width: 320px; height: 120px;"></div>
                <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        <img src="{{ asset('storage/profile_picture/' . $user->picture) }}" alt=""  class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover" >
                        <h6 class="mb-0 mt-16">{{ $user->name }}</h6>
                        <span class="text-secondary-light mb-16">{{ $user->email }}</span>
                    </div>
                    <div class="mt-24">
                        <h6 class="text-xl mb-16">Personal Info</h6>
                        <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Full Name</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->name }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Email</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->email }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Jabatan</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->jabatan }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Bagian</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->bagian }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8" wire:ignore>
            <div class="card h-100">
                <div class="card-body p-24">
                    <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab" aria-controls="pills-edit-profile" aria-selected="true">
                            Edit Profile
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab" data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab" aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                            Ubah Password
                          </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent" wire:ignore>
                        <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                            <h6 class="text-md text-primary-light mb-16">Profile Image</h6>
                            <div class="mb-24 mt-16">
                                <div class="avatar-upload">
                                    <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" wire:model="picture" hidden>
                                        <button onclick="document.getElementById('imageUpload').click()" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                            <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                        </button>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" class="rounded-circle overflow-hidden" style="width: 150px; height: 150px;">
                                            @if ($picture)
                                            <img id="previewImg" src="{{ $picture->temporaryUrl() }}" class="w-100 h-100 object-fit-cover">
                                            @else
                                            <img id="previewImg" src="{{ asset('storage/profile_picture/' . $user->picture) }}" class="w-100 h-100 object-fit-cover">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Upload Image End -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span class="text-danger-600">*</span></label>
                                        <input type="text" wire:model="name" class="form-control radius-8" value="{{ $user->name }}" placeholder="Enter Full Name">
                                        <div>
                                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                        <input type="email" wire:model="email" class="form-control radius-8" value="{{ $user->email }}" placeholder="Enter email address">
                                        @error('email') <span class="error text-danger">{{ $message }}</span> @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center gap-3">
                                <button wire:click="editUser" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                    Save
                                </button>
                                @if (session()->has('message'))
                                <div class="d-flex align-items-center">
                                        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    {{ session('message') }}
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel" aria-labelledby="pills-change-passwork-tab" tabindex="0">
                            <div class="mb-20">
                                <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">New Password <span class="text-danger-600">*</span></label>
                                <div class="position-relative">
                                    <input type="password" name="password" class="form-control radius-8" id="your-password" placeholder="Enter New Password*">
                                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                                </div>
                            </div>
                            <div class="mb-20">
                                <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmed Password <span class="text-danger-600">*</span></label>
                                <div class="position-relative">
                                    <input type="password" name="password_confirmation" class="form-control radius-8" id="confirm-password" placeholder="Confirm Password*">
                                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center gap-3">
                                <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
