<x-layout title="Dashboard">
    @section('title', 'Dashboard')
    @section('navbar')
        <x-navbar notifications="{{ $notifications }}"></x-navbar>
    @endsection
    {{--
    Overview of the school's financial health.
    Key financial metrics and charts.
    Quick links to essential features.
    --}}

    <x-chart-bubble width="600px" height="200px">
        <canvas id="myChart"></canvas>
    </x-chart-bubble>

    @section('javascript')
        <script></script>
    @endsection


</x-layout>
