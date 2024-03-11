<x-layout title="Register">
    @section('navbar')
        <x-navbar></x-navbar>
    @endsection

    <x-form-bubble action="signup" method="post">
        <div class="flex flex-col mt-4">
            <div style="display: inline-block;margin-right: 34%">
                <label for="dp" style="width: 10em">Profile Image</label>
                <input class=".f-input-field" type="file" name="dp" id="dp" onchange="loadImage()" required
                    oninvalid="this.setCustomValidity('Every account must have a profile image')" value="{{ old('dp') }}">
                @error('dp')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div
                style="position: relative; display: inline-block; max-height: 100px; max-width: 100px; min-width: 100px; min-height: 100px; border-radius: 50%;">
                <img id="output" src="{{ asset('img/profile.jpg') }}" alt="Upload Image"
                    style="max-height: 100%; max-width: 100%; border-radius: 50%;">
            </div>
            <script>
                function loadImage() {
                    var output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                        URL.revokeObjectURL(output.src);
                    }
                };
            </script>
        </div>

        <div class="flex flex-col mt-4">
            <label for="first_name" class="flex flex-col" style="width: 10em">First Name</label>
            <input class=".f-input-field" type="text" name="first_name" id="first_name" placeholder="Enter First Name"
                style="padding-left: .3rem;padding-right: .3rem;width: 30em"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500" required
                oninvalid="this.setCustomValidity('Provide First Name')" value="{{ old('first_name') }}">
            @error('first_name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col mt-4">
            <label for="last_name" style="width: 10em">Last Name</label>
            <input class=".f-input-field" type="text" name="last_name" id="last_name" placeholder="Enter Last Name"
                style="padding-left: .3rem;padding-right: .3rem;width: 30em"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500" required
                oninvalid="this.setCustomValidity('Provide Last Name')" value="{{ old('last_name') }}">
            @error('last_name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col mt-4">
            <label for="username" class="flex flex-col" style="width: 10em">Username</label>
            <input class=".f-input-field" type="text" name="username" id="username" placeholder="Username must be unique"
                style="padding-left: .3rem;padding-right: .3rem;width: 30em"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500" required
                oninvalid="this.setCustomValidity('Provide a unique username')" value="{{ old('username') }}">
            @error('username')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col mt-4">
            <label for="gender_id" class="flex flex-col" style="width: 10em">Username</label>
            <select type="text" name="gender_id" id="gender_id" placeholder="Username must be unique"
                style="padding-left: .3rem;padding-right: .3rem;width: 30em"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500" required
                oninvalid="this.setCustomValidity('Provide a unique username')">
            </select>
            @error('gender_id')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <script>
                // use ajax GET request to fetch listof gender from the database
                let ajax = new XMLHttpRequest();
                ajax.open("GET", "genders", true);
                ajax.onload = function() {
                    let responseJSON = JSON.parse(this.responseText);
                    let genders = responseJSON["genders"];
                    let options = "";
                    for (let i = 0; i < genders.length; i++) {
                        options += "<option value='" + genders[i].id + "'>" + genders[i].gender + "</option>";
                    }
                    document.getElementById("gender_id").innerHTML = options;
                }
                ajax.send();
            </script>
        </div>

        <div class="flex flex-col mt-4">
            <label for="phone" class="flex flex-col" style="width: 10em">Mobile Number</label>
            <input class=".f-input-field" type="tel" name="phone" id="phone" placeholder="07xxxxxxxx"
                style="padding-left: .3rem;padding-right: .3rem;width: 30em"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500" required
                oninvalid="this.setCustomValidity('Provide phone number')" value="{{ old('phone') }}">
            @error('phone')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col mt-4">
            <label for="email" style="width: 10em">Email</label>
            <input class=".f-input-field" type="email" name="email" id="email" placeholder="someone@domain.com"
                style="padding-left: .3rem;padding-right: .3rem;width: 30em"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500" required
                oninvalid="this.setCustomValidity('Provide email')" value="{{ old('email') }}">
            @error('email')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col mt-4">
            <label for="password" style="width: 10em">Password</label>
            <input class=".f-input-field" type="password" name="password" id="password" placeholder="Enter a strong password"
                style="padding-left: .3rem;padding-right: .3rem;width: 30em"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500" required>
            @error('password')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col mt-4">
            <label for="password_confirmation" style="width: 10em">Confirm Password</label>
            <input class=".f-input-field" type="password" name="password_confirmation" id="password_confirmation"
                placeholder="Confirm your password" style="padding-left: .3rem;padding-right: .3rem;width: 30em"
                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500" required>
            @error('password_confirmation')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col mt-4">
            <p>Already have an account? <i><a href="login">login</a></i></p>
        </div>

        <div style="display: flex;align-items: flex-end">
            <button class="btn btn-primary bg-secondary" type="submit">Register</button>
        </div>
    </x-form-bubble>
</x-layout>
