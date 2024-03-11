<x-layout title="Home">
    @section('title', 'Home')
    @section('navbar')
        <x-navbar></x-navbar>
    @endsection
    {{-- Everything related to home of the webpage --}}
    {{-- For now display login --}}
    <h1>Homepage</h1>

    @section("footer")
        <x-footer />
    @endsection

</x-layout>
