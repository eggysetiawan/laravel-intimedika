@switch($offer->is_approved)
    @case(1)
        <x-dropdown>
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item" title="Lihat detail penawaran.">
                <i class="far fa-eye nav-icon"></i>
                Detail
            </a>

            @can('approval')
                @if ($offer->isPurchaseReadyToApprove())

                    <a href="{{ route('verify.purchase.approve', $offer->slug) }}" class="dropdown-item"
                        title="Setujui PO ini."> <i class="far fa-check-circle nav-icon"></i> Approve Purchase.
                    </a>

                    <a href="{{ route('verify.purchase.reject', $offer->slug) }}" class="dropdown-item"
                        title="Tolak PO ini."><i class="far fa-times-circle nav-icon"></i> Reject Purchase.
                    </a>

                @endif
            @endcan

            @if ($offer->isPurchaseReadyToUpdate())
                @unlessrole('director')
                <a href="{{ route('progresses.create', $offer->slug) }}" class="dropdown-item"
                    title="Update progress penawaran ini."><i class="far fa-edit nav-icon"></i> Update Purchase
                </a>
                @endunlessrole
            @endif


            @can('openworld')
                <form action="{{ route('offers.destroy', $offer->slug) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="dropdown-item" name="approval" type="submit" onclick="return confirm('apakah anda yakin?')"
                        title="Hapus Penawaran. (only superadmin does)">
                        <i class="far fa-trash-alt nav-icon"></i>
                        Hapus
                    </button>
                </form>
            @endcan

        </x-dropdown>
    @break

    @case(2)
        <x-dropdown>
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item"
                title="Lihat detail penawaran ini."><i class="far fa-eye nav-icon"></i> Detail
            </a>
        </x-dropdown>
    @break


    @default
        <x-dropdown>
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item" title="Lihat detail penawaran ini."><i
                    class="far fa-eye nav-icon"></i>
                Detail
            </a>

            <a href="{{ route('offers.edit', $offer->slug) }}" class="dropdown-item" title="Edit data penawaran ini.">
                <i class="fas fa-edit nav-icon"></i> Edit
            </a>

            @can('approval')

                {{-- approve button --}}
                <a href="{{ route('verify.offer.approve', $offer->slug) }}" class="dropdown-item" title="Setujui Penawaran ini.">
                    <i class="far fa-check-circle nav-icon"></i> Approve.
                </a>

                {{-- hold button --}}
                @if ($offer->is_approved != 3)
                    {{-- 3 = On Hold --}}
                    <a href="{{ route('revisions.edit', $offer->slug) }}" class="dropdown-item"
                        title="Minta sales lakukan perubahan pada penawaran ini.">
                        <i class="far fa-pause-circle nav-icon"></i>
                        Hold.
                    </a>
                @endif

                {{-- reject --}}
                <a href="{{ route('verify.offer.reject', $offer->slug) }}" class="dropdown-item" title="Tolak penawaran ini.">
                    <i class="far fa-times-circle nav-icon"></i>
                    Reject.
                </a>

            @endcan


            @can('view', $offer)
                <form action="{{ route('offers.destroy', $offer->slug) }}" method="POST">
                    @csrf
                    @method('delete')

                    <button class="dropdown-item" name="approval" type="submit" onclick="return confirm('apakah anda yakin?')"
                        title="Hapus penawaran dari tabel."><i class="far fa-trash-alt nav-icon"></i>
                        Delete
                    </button>
                </form>
            @endcan
        </x-dropdown>


@endswitch

@include('offers.modals.pin')
