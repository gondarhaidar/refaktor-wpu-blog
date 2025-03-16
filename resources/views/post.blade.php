<x-Layout>

    <x-slot:title>{{$title}}</x-slot> 
    <div class="bg-white p-2 rounded mb-2 shadow-sm shadow-slate-400">
        <h1 class="text-3xl font-bold">{{$post->title}}</h1>
        <p class="text-sm text-slate-500">{{$post->created_at->diffForHumans()}}</p>
        <article class="font-sans">
            {!!$post->body!!}
        </article>
    </div>

    <div>
        <form action="/comment" class="grid grid-cols-[1fr_80px] mb-2" method="post">
            @csrf
            <input type="text" placeholder="Tulis komentar" name="body" required
            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 transition duration-300 rounded-r-none">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <button class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 rounded-l-none">
                Kirim
            </button>
        </form>
    </div>
@foreach($comments as $comment)
    <div class="bg-white p-2 rounded shadow-sm shadow-slate-400 mb-2">
        <h1 class="font-bold text-md">{{$comment->user->name}}</h1>
        <p class="text-slate-600 text-sm">{{$comment->updated_at->diffForHumans()}}</p>
        <p class="text-sm">{{$comment->body}}</p>
        <div>
            <a href="" class="text-blue-700">Balas</a>
        </div>
    </div>
@endforeach
</x-Layout> 

