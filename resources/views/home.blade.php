
<x-Layout>
  <x-slot:title>{{$title}}</x-slot>
  @for($i=0;$i<10;$i++)
  <a class="bg-white p-2 rounded mb-2 block" href="/post">
    <h1 class="text-2xl font-bold m-0 text-blue-700">Judul content</h1>
    <p class="text-gray-700 m-0 text-sm">2 hours ago</p>
    <hr class="h-[2px] bg-slate-400">
    <p class="text-sm">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus, illum temporibus. Tempora cumque qui quod consequatur nobis est provident possimus odio obcaecati veritatis! Possimus ad nihil quia ratione voluptatem voluptas!</p>
  </a>
  @endfor
</x-Layout>