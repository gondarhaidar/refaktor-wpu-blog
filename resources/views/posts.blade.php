<x-Layout>
    <x-slot:title>{{$title}}</x-slot>
        <div class="py-1 px-4 mx-auto max-w-screen-xl lg:py-2 lg:px-0 ">
            <form class="flex justify-center mb-4">
                @if(request('user'))
                <input type="hidden" name="user" value="{{request('user')}}">
                @endif
                <input type="search" name="search" class="rounded lg:w-[70%] md:w-[80%] w-full rounded-r-none" placeholder="Search">
                <button type="submit" class="rounded rounded-l-none border border-black px-3 font-semibold hover:bg-slate-800 hover:text-white">Search</button>
            </form>
            {{$posts->links()}}
            <div class="grid gap-3 lg:grid-cols-4 md:grid-cols-3 grid-cols-1 xl:6">
    @forelse ($posts as $post)    
                <article class="p-3 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between">

                    <img src="{{$post->main_img}}" alt="">
                    <h2 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white hover:underline"><a href="/posts/{{$post->slug}}">{{Str::limit($post->title, 150)}}</a></h2>
                    <span class="text-sm">{{$post->created_at->diffForHumans()}}</span>

                </article>     
                @empty
                <div>
                    <p class="text-2xl font-semibold">Articel not found</p>
                    <a href="/posts" class="text-blue-500 hover:underline">&laquo; back to all post</a>          
                </div>
                @endforelse
            </div>  
            <div class="my-2">
                {{$posts->links()}}
            </div>
        </div>
</x-Layout>