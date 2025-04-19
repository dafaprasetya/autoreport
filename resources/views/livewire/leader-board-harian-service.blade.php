<div class="col-xxl-12 col-lg-12">
    <div class="text-center">
        <p>Leaderboard {{ \Carbon\Carbon::parse(now())->format('F Y') }}</p>
    </div>
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4" wire:poll>
        @foreach ($poin as $item)
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-1 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">{{ $item->user->name }}</p>
                            <h6 class="mb-0">
                                {{ $item->total_poin }}
                            </h6>
                            @if ($item->total_poin <= 10)
                            <span class="badge bg-danger mt-3">Tidak Produktif</span>
                            @elseif ($item->total_poin >= 20)
                            <span class="badge bg-success mt-3">Over Produktif</span>
                            @elseif ($item->total_poin >=15)
                            <span class="badge bg-success mt-3">Produktif</span>
                            @endif
                        </div>
                            <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                            <div class="text-white fw-bold">{{ $loop->iteration }}</div>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
        @endforeach
    </div>
</div>
