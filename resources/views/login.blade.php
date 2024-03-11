<x-layout title="Login">
    @section('navbar')
        <x-navbar></x-navbar>
    @endsection

    <x-form-bubble action="signin" method="post">
        <div class="flex flex-col mt-4">
            <label for="username" class="flex flex-col" style="width: 6em">Username</label>
            <input type="text" name="username" id="username" placeholder="Your Username"
                style="padding-left: .3rem;padding-right: .3rem;"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500">
        </div>

        <div class="flex flex-col mt-4">
            <label for="password" style="width: 6em">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password"
                style="padding-left: .3rem;padding-right: .3rem;"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500">
        </div>

        <div class="flex flex-col mt-4">
            <p>Don't have an account? <i><a href="register">register</a></i></p>
        </div>

        <div style="display: flex;align-items: flex-end">
            <button class="btn btn-primary bg-secondary" type="submit">Login</button>
        </div>
    </x-form-bubble>
</x-layout>
