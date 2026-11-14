@props([
    'title',
    'icon' => null
])

<div class="content-card h-100">

    <div class="d-flex align-items-center gap-2 mb-3">

        @if($icon)

            <i class="{{ $icon }} fs-4"
               style="color:#692386">
            </i>

        @endif

        <h5 class="fw-bold mb-0">
            {{ $title }}
        </h5>

    </div>

    <div>
        {{ $slot }}
    </div>

</div>