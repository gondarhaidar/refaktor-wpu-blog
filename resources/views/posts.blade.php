<x-Layout>
    <x-slot:title>{{$title}}</x-slot>
    @can('admin')
    <h1>You are admin</h1>
    @endcan
    <form action="" class="grid grid-cols-[1fr_80px] max-w-[800px] mx-auto mb-3">
      <input type="search" placeholder="Cari" name="search" required
      class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 transition duration-300 rounded-r-none" value="{{request('search')}}">
      <button class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 rounded-l-none">
      Cari
      </button>
    </form>
    @if(count($posts) < 1)
      <div class="bg-white p-2 rounded mb-2">
        <h1 class="text-2xl font-bold m-0">Hasil pencarian <span class="text-blue-700 underline">{{request('search')}}</span> tidak ditemukan</h1>
      </div>
    @endif
    @foreach($posts as $post)
    <a class="bg-white p-2 rounded mb-2 block" href="/posts/{{$post->slug}}">
      <h1 class="text-2xl font-bold m-0 text-blue-700">{{$post->title}}</h1>
      <p class="text-gray-700 m-0 text-sm">{{$post->created_at->diffForHumans()}}</p>
      <hr class="h-[2px] bg-slate-400">
      <p class="text-sm">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus, illum temporibus. Tempora cumque qui quod consequatur nobis est provident possimus odio obcaecati veritatis! Possimus ad nihil quia ratione voluptatem voluptas!</p>
    </a>
    @endforeach
</x-Layout>2