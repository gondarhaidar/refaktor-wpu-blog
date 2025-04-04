@props(['type' => 'success', 'errorComment' => false])

@if($type === 'success')
<div x-data="{ show: true }" x-show="show" class="bg-green-100 z-10 border border-green-400 text-green-700 px-4 py-3 rounded fixed max-w-xl" role="alert">
    <strong class="font-bold">{{$type}}!</strong>
    <span class="block sm:inline">{{$slot}}</span>
    <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z"/>
        </svg>
    </button>
</div>

@elseif($type === 'error')
<div x-data="{ show: true }" x-show="show" class="bg-red-100 border z-10 border-red-400 text-red-700 px-4 py-3 rounded fixed max-w-xl w-full" role="alert">
    <strong class="font-bold">{{$type}}!</strong>
    <span class="block sm:inline">{{$slot}}</span>
    <button @click="show = false" class="{{!$errorComment?'absolute top-0 bottom-0 right-0 px-4 py-3' : 'hidden'}}">
        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z"/>
        </svg>
    </button>
</div>
@endif
<script>
</script>