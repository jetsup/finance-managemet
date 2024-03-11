<form action="" method=""
    class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
    @csrf
    <div class="flex flex-col mt-4">
        <label for="username" class="flex flex-col" style="width: 6em">Username</label>
        <input type="text" name="username" id="username" style="padding-left: .3rem;padding-right: .3rem;"
            class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500">
    </div>

    <div class="flex flex-col mt-4">
        <label for="username" style="width: 6em">Password</label>
        <input type="password" name="password" id="password" style="padding-left: .3rem;padding-right: .3rem;"
            class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-blue-500">
    </div>

    <div class="flex flex-col mt-4">
        <p>Don't have an account? <i><a href="register">register</a></i></p>
    </div>

    <div class="flex flex-col mt-4" style="justify-content: right;">
        <button type="submit">Login</button>
    </div>
</form>
