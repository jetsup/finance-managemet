<!-- When there is no desire, all things are at peace. - Laozi -->
<div class="form-bubble form-div">
    {{-- <form action="" method="post" > --}}
    <form method="{{ $method ?? 'post' }}" action="{{ $action ?? '' }}" enctype="multipart/form-data" class="f-form">
        @csrf
        {{ $slot }}
    </form>
</div>
