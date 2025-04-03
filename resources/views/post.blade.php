<x-layout>

    <x-slot:title>{{$post->title}}</x-slot> 
    <div class="bg-white p-2 rounded mb-2 shadow-sm shadow-slate-400">
        <h1 class="text-3xl font-bold">{{$post->title}}</h1>
        <p class="text-sm text-slate-500">{{$post->created_at->diffForHumans()}}</p>
        @can('admin')
        <div class="my-1 flex gap-1">
            <a href="/blogs/edit/{{$post->slug}}" class="text-sm bg-green-600 text-white rounded hover:bg-green-500 px-3 py-1 my-2">Edit</a>

            <form action="/blogs/{{$post->slug}}" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" name="slug" value="{{$post->slug}}">
                <button class="text-sm bg-red-600 text-white rounded hover:bg-red-500 px-3 py-1 my-2">Hapus</button>
            </form>
        </div>
        @endcan
        <article class="font-sans mx-2 text-sm">
            {!!$post->body!!}
        </article>
    </div>

    <div>
        <hr class="h-[4px] bg-slate-600 mb-2 shadow shadow-gray-600">
        <form action="/comment" class="grid grid-cols-[1fr_80px] mb-2" method="post">
            @csrf
            <input type="text" placeholder="Tulis komentar" name="body" required
            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 transition duration-300 rounded-r-none">
            @auth
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
            @endauth
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <button class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 rounded-l-none">
                Kirim
            </button>
        </form>
    </div>
    @if(count($post->comment) < 1)
        <div class="">
             <h1 class="text-center text-gray-700">belum ada komentar</h1>
        </div>
    @endif
@foreach($post->comment as $comment)
    <div class="bg-white p-2 rounded shadow-sm shadow-slate-400 mb-2">
        <h1 class="font-bold text-md mb-2">{{$comment->user->name}}</h1>
        <p class="text-slate-600 text-sm">{{$comment->updated_at->diffForHumans()}}</p>
        <p class="text-sm">{{$comment->body}}</p>
        <div>
            <a href="" class="text-blue-700">Balas</a>
        </div>
    </div>
@endforeach
<script>
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.classList.add('mx-auto mx-2');
    });
</script>
</x-Layout> 

