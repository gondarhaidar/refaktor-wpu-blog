<x-Layout>
    <x-slot:title>{{$title}}</x-slot>
    @foreach($posts as $post)
    <a class="bg-white p-2 rounded mb-2 block" href="/posts/{{$post->slug}}">
      <h1 class="text-2xl font-bold m-0 text-blue-700">{{$post->title}}</h1>
      <p class="text-gray-700 m-0 text-sm">{{$post->created_at->diffForHumans()}}</p>
      <hr class="h-[2px] bg-slate-400">
      <p class="text-sm">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus, illum temporibus. Tempora cumque qui quod consequatur nobis est provident possimus odio obcaecati veritatis! Possimus ad nihil quia ratione voluptatem voluptas!</p>
    </a>
    @endforeach
</x-Layout>