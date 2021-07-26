@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Cars
            </h1>
        </div>

        <div class="pt-10">
            <a 
                href="{{ route('cars.create') }}"
                class="border-b-2 pb-2 border-dotted italic text-gray-500">
                Add a new car &rarr;
            </a>
        </div>

        <div class="w-5/6 py-10">
            @forelse ($cars as $car )
                <div class="m-auto">
                    <div class="float-right">
                        <a 
                            href="{{ route('cars.edit', $car['id']) }}"
                            class="border-b-2 pb-2 border-dotted italic text-green-500"
                            >
                            Edit Car &rarr;
                        </a>

                        <form class="pt-3" action="{{ route('cars.destroy',$car['id']) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="border-b-2 pb-2 border-dotted italic text-red-500">
                                Delete &rarr;
                            </button>
                        </form>
                    </div>
                    <span class="uppercase text-blue-500 font-bold text-xs italic">
                        Founded : {{ $car['founded'] }}
                    </span>

                    <h2 class="text-gray-700 text-5xl hover:text-gray-500">
                        <a href="{{ route('cars.show',$car['id']) }}">
                            {{ $car['name'] }}
                        </a>
                    </h2>

                    <p class="text-lg text-gray-700 py-6">
                        {{ $car['description'] }}
                    </p>

                    <hr class="mt-4 mb-8">
                </div>
            @empty
                No available data
            @endforelse
            

        </div>
    </div>
@endsection