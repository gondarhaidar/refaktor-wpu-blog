
<x-Layout>
    <x-slot:title>{{$title}}</x-slot>
    <form class="max-w-lg mx-auto bg-white p-5 shadow-md rounded" action="/register" method="post">
        @csrf
        <div class="w-full max-w-md my-2">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" required placeholder="Name" name="name"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 ease-in-out">
         </div>
        <div class="w-full max-w-md my-2">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" required placeholder="Email" name="email"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 ease-in-out">
         </div>
        <div class="w-full max-w-md my-2">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" required placeholder="*******" name="password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 ease-in-out">
         </div>
         <button class="px-5 py-2 w-full bg-slate-700 text-slate-50 rounded max-w-md my-2 hover:bg-slate-400 hover:text-slate-900">Register</button>
         <p class="text-sm mt-2 text-center">
            Already register? <a href="/login" class="text-blue-600 hover:underline">login here</a>
         </p>
    </form>
</x-Layout>
