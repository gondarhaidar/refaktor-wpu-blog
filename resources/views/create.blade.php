<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100"> 
    <div class="container mx-auto p-1 md:p-0">
        <form action="/blogs" method="POST""> 
            @csrf
            <div class="w-full my-4 bg-white shadow-sm rounded-md p-3 border border-gray-300">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                <input autocomplete="off" type="text" required placeholder="Title" name="title" id="title"
                class="w-full px-3 py-2 border border-gray-300 rounded-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-blue-300 transition-all duration-300 ease-in-out">
            </div>
            <div class="w-full my-4 bg-white shadow-sm rounded-md p-3 border border-gray-300">
                <label for="slug" class="block text-gray-700 font-semibold mb-2">Slug</label>
                <input autocomplete="off" type="text" required placeholder="Slug" name="slug" id="slug"
                    class="w-full px-3 py-2 border border-gray-300 rounded-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-blue-300 transition-all duration-300 ease-in-out">
             </div>
            <div class="w-full my-4 bg-white shadow-sm rounded-md p-3 border border-gray-300">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Content</label>
                <div id="editor"></div>
             </div>
             <input autocomplete="off" type="hidden" name="user_id" value="{{auth()->user()->id}}">
            <input autocomplete="off" type="hidden" name="body" id="hiddenContent">
            <button type="submit" class="bg-gray-800 text-gray-50 px-4 py-2 rounded sm:max-w-sm w-full font-semibold hover:bg-gray-600">Save</button>       
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    const quill = new Quill('#editor', {
        modules: {
            toolbar: {
                container: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                ],
                handlers: {
                    image: imageHandler
                }
            }
        },
        placeholder: 'Write content',
        theme: 'snow',
    });

    function imageHandler() {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = async () => {
            var file = input.files[0];
            var formData = new FormData();
            formData.append('image', file);

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const res = await fetch('/upload-image', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await res.json();
                if (data.success) {
                    var range = quill.getSelection();
                    quill.insertEmbed(range.index, 'image', data.image_url);
                } else {
                    alert('Gagal mengupload gambar');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan!');
            }
        };
    }

    const form = document.querySelector("form");
    const hiddenContent = document.querySelector('#hiddenContent');

    form.addEventListener('submit', function (e) {
        if (!quill.root.innerHTML.trim()) {
            e.preventDefault();
            alert("Konten tidak boleh kosong!");
        } else {
            hiddenContent.value = quill.root.innerHTML;
        }
    });

    const title = document.getElementById('title');
    const slug = document.getElementById('slug');
    title.addEventListener('change', function(){
        const textSlug = title.value.split(' ').join('-');
        slug.value = textSlug;
    })
</script>
</html>

