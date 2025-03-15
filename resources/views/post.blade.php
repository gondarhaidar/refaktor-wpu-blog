<x-Layout>

    <x-slot:title>{{$title}}</x-slot> 
    <div class="bg-white p-2 rounded mb-2">
        <h1 class="text-3xl font-bold">{{$post->title}}</h1>
        <p class="text-sm text-slate-500">{{$post->created_at->diffForHumans()}}</p>
        <article class="font-sans">
            {{$post->body}}
        </article>
    </div>

    <div>
        <form action="" class="grid grid-cols-[1fr_80px] mb-2">
            <input type="textarea" placeholder="Tulis komentar"
            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 rounded-r-none">
            <button class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 rounded-l-none">
                Kirim
            </button>
            
        </form>
    </div>
@for($i=0;$i<15;$i++)
    <div class="bg-white p-2 rounded shadow shadow-slate-400 mb-2">
        <h1 class="font-bold text-lg">User ganteng</h1>
        <p class="text-slate-600 text-sm">2 years ago</p>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate, hic. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis, quidem!</p>
    </div>
@endfor
</x-Layout> 

