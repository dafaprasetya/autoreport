@extends('admin.layouts.core')
@section('body')
@livewire('SidebarService')


<main class="dashboard-main">
    @include('admin.layouts.topbar')
    <div class="dashboard-main-body">
        <div class="card basic-data-table">
            <div class="card-header">
              <h5 class="card-title mb-0">Data Master GA Service</h5>

            </div>
            <div class="card-body">
                <div class="row mt-3 mb-3">
                    <div class="col-lg-12">
                        <button class="btn btn-outline-primary-600 radius-8 px-20 py-11 w-100 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#tambahReportHarianModal">
                            <span class="me-2">Tambah</span>
                            <iconify-icon icon="formkit:add" width="20" height="20"></iconify-icon>
                        </button>
                        <div class="modal fade" id="tambahReportHarianModal" tabindex="-1" aria-labelledby="tambahReportHarianModal" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master G.A</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @livewire('FormMasterGa')

                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                @livewire('ReportServiceTable')

            </div>

        </div>
    </div>
</main>

@endsection
@push('script')
<script>
     window.addEventListener('badak', () => {
        // Mendapatkan elemen modal
        // var modal = new bootstrap.Modal(document.getElementById('tambahReportHarianModal'));
        // // Menutup modal
        // modal.hide();
        $('#tambahReportHarianModal').modal('hide');
        // console.log("badak");


     })

</script>
@endpush
