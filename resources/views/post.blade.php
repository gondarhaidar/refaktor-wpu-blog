<x-layout>

    <x-slot:title>{{$post->title}}</x-slot> 

    <div class="hidden alert" x-show="show">
        <x-alert type="error" errorComment="{{true}}">Fitur belum tersedia</x-alert>
    </div>
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

    <hr class="h-[2px] bg-black mb-2 shadow shadow-gray-600">

    <div>
        <form action="/comment" class="grid grid-cols-[1fr_auto] w-full mx-auto mb-3 z-0 overflow-hidden" method="post">
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
        <div x-data="{showComment: true, showEdit: false}">
            <div class="bg-white p-2 rounded shadow-sm shadow-slate-400 mb-2" x-show=showComment>
                <div class="flex justify-between">
                <h1 class="font-bold text-md">{{$comment->user->name}}</h1>
                @auth
                @if(auth()->user()->email === $comment->user->email)
                <svg xmlns="http://www.w3.org/2000/svg" @click="showComment = false; showEdit=true" class="hover:transform hover:scale-[1.3] rounded" x="0px" y="0px" width="13" height="13" viewBox="0 0 50 50">
                    <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z"></path>
                </svg>
                @endif
                @endauth
            </div>
            <p class="text-slate-600 text-sm">{{$comment->updated_at->diffForHumans()}}</p>
            <p class="text-sm">{{$comment->body}}</p>
            <div>
                <a class="text-blue-700 cursor-pointer replyComment">Balas</a>
            </div>
        </div>
        <form action="/comment" method="post" class="bg-white p-2 rounded shadow-sm shadow-slate-400 mb-2" x-show=showEdit @submit="showComment=true; showEdit=false">
            @csrf
            @method('put')
            <textarea name="body" required
            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 transition duration-300 rounded-r-none w-full" name="body" required>{{$comment->body}}</textarea>
            <input type="hidden" name="id" value="{{$comment->id}}">
            <button type="submit" class="rounded px-5 py-2 bg-slate-800 text-white block">Edit</button>
        </form>
    </div>
@endforeach

<script>
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.classList.add('mx-auto mx-2');
    });

    const replyComments = document.querySelectorAll('.replyComment');
    const alert = document.querySelector('.alert');
    console.log(replyComments);
    console.log(alert)
    replyComments.forEach(replyComment => {
        replyComment.addEventListener('click', (e) => {
            alert.classList.remove('hidden');
            alert.classList.add('relative');
            setTimeout(() => {
                alert.classList.add('hidden');
            }, 2000);
        })
    })
</script>
</x-Layout> 

