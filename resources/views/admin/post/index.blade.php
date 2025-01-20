@extends('admin.layout.app')
@section('title')
    posts
@endsection
@section('content')
    <div class="w-full h-[88%] bg-gray-200 flex items-center justify-center">
        <div class="w-[90%] h-5/6 bg-white rounded-xl pt-3 flex flex-col items-center">
            <div class="w-[90%] h-1/5 flex justify-between items-center border-b">
{{--                <a href="{{route('posts.create')}}" class="px-10 py-3 rounded-xl font-light text-white bg-gray-800">add post +</a>--}}
                <h2 class="text-xl">posts</h2>
            </div>
            <div class="w-[90%] h-3/5 flex flex-col justify-center">
                <table class="w-full min-h-full border border-gray-400">
                    <thead>
                    <tr class="h-12 border border-gray-400 border-b-2 border-b-gray-400">
                        <td class="text-center">publish</td>
                        <td class="text-center">description</td>
                        <td class="text-center">title</td>
                        <td class="text-center">id</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td class="text-center">
                                @if($post->is_published==1)
                                    yes
                                @elseif($post->is_published==0)
                                    <form action="{{route('admin.posts.update',compact('post'))}}" method="get">
                                        @csrf
                                        <button type="submit" class="text-red-600 font-semibold">no</button>
                                    </form>
                                @endif
                            </td>
                            <td class="text-center">{{$post->description}}</td>
                            <td class="text-center">{{$post->title}}</td>
                            <td class="text-center">{{$post->id}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            <div class="mt-5">{{$lessons->links()}}</div>--}}
        </div>
@endsection
