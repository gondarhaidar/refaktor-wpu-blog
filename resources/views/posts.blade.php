<x-Layout>
    <x-slot:title>{{$title}}</x-slot>
    <div class="relative">
      @if(session('success'))
      <x-Alert type="success">{{session('success')}}</x-Alert>
      @endif
      <div class="relative">
        @if(request()->has('search'))
        <a href="/" class="hidden md:block">
            <x-back></x-back>
        </a>
        @endif
        <form action="" class="grid grid-cols-[1fr_80px] max-w-[800px] mx-auto mb-3">
          <input type="search" placeholder="Cari" name="search" required
          class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 transition duration-300 rounded-r-none" value="{{request('search')}}">
          <button class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 rounded-l-none">
            Cari
          </button>
        </form>
      </div>
      @if(count($posts) < 1)
      <div class="bg-white p-2 rounded mb-2">
        <h1 class="text-2xl font-bold m-0">Hasil pencarian <span class="text-blue-700 underline">{{request('search')}}</span> tidak ditemukan</h1>
      </div>
      @endif
      @can('admin')
      <a href="/blogs/create" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mb-2 inline-block">Buat postingan</a>
      @endcan
      @foreach($posts as $post)
      <a class="relative bg-white p-2 rounded mb-2 block shadow-sm shadow-slate-400" href="/posts/{{$post->slug}}">
        <h1 class="text-1xl lg:text-2xl font-bold m-0 text-blue-700">{{$post->title}}</h1>
        <p class="text-gray-700 m-0 text-sm">{{$post->created_at->diffForHumans()}}</p>
        <p class="hidden md:block text-sm">{{ Str::limit($post->body, 350) }}</p>
        <p class="text-sm block md:hidden">{{ Str::limit($post->body, 200) }}</p>
      </a>
    
      @endforeach
  </div>
</x-Layout>2