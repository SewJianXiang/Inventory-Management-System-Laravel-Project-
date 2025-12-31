@extends('layouts.app')

@section('content')

<div class="flex flex-col items-center min-h-screen bg-gray-100 p-8 ">
    <div class="w-full max-w-6xl overflow-x-auto">
        <div class="mb-6 flex justify-center items-center">
            <h1 class="text-2xl font-semibold text-gray-800">
                @if(isset($product))
                    History for: <span class="text-blue-600">{{ $product->product_name }}</span>
                @else
                    <h1 class="font-bold text-3xl text-slate-800"> Product Histories</h1>
                @endif
            </h1>
        </div>

        @if($histories->isEmpty())
            <div class="p-4 bg-white rounded-full shadow text-gray-600">
                No history records {{ isset($product) ? 'found for this product.' : 'found.' }}
            </div>
        @else
        <div class="bg-white rounded-xl overflow-hidden border border-gray-200 shadow ">
            <table class="w-full table-fixed bg-white">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-3 text-left text-slite-800 font-bold w-40 max-w-[120px]">Date</th>
                        <th class="px-6 py-3 text-left text-slite-800 font-bold w-32 max-w-[100px] ">Action</th>
                        <th class="px-6 py-3 text-left text-slite-800 font-bold w-40 max-w-[150px]">User</th>
                        @if(!isset($product))
                            <th class="px-6 py-3 text-left text-slite-800 font-bold max-w-[150px] w-48">Product</th>
                        @endif
                        <th class="px-6 py-3 text-left text-slite-800 font-bold max-w-[480px] w-96">Changes</th>
                        <th></th><th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="text-sm px-6 py-4 w-40 whitespace-normal break-words max-w-[120px]">{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="text-sm px-6 py-4 w-32 whitespace-normal  max-w-[100px]">
                                @if($history->action === 'created')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-sm">{{ ucfirst($history->action) }}</span>
                                @elseif($history->action === 'updated')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">{{ ucfirst($history->action) }}</span>
                                @elseif($history->action === 'deleted')
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-sm">{{ ucfirst($history->action) }}</span>
                                @else
                                    {{ ucfirst($history->action) }}
                                @endif
                            </td>
                            <td class="text-sm px-6 py-4 w-40 whitespace-normal break-words max-w-[150px]">{{ $history->user_name ?? 'System' }}</td>
                            @if(!isset($product))
                                <td class="text-sm px-6 py-4 max-w-[150px] w-48 whitespace-normal overflow-hidden break-words">
                                    @if($history->product)
                                        <a href="{{ route('products.show', $history->product->id) }}" class="text-blue-600 hover:underline break-words">
                                            {{ $history->product->product_name }}
                                        </a>
                                    @else
                                        —
                                    @endif
                                </td>
                            @endif
                            <td class="text-sm px-6 py-4 max-w-[480px] w-96 whitespace-normal break-words">
                                <ul class="space-y-1">
                                    @if($history->action === 'created')
                                        @foreach($history->new_values as $field => $value)
                                            <li class="flex items-center gap-2">
                                                <span class="font-medium capitalize break-words">{{ $field }}:</span>
                                                <span class="text-gray-700 break-words">{{ is_null($value) ? '—' : $value }}</span>
                                            </li>
                                        @endforeach
                                    @else
                                        @foreach($history->new_values as $field => $new)
                                            <li class="flex items-center gap-2 ">
                                                <span class="font-medium capitalize break-words">{{ $field }}:</span>
                                                <span class="line-through text-gray-400 break-words">{{ $history->previous_values[$field] ?? '—' }}</span>
                                                <span class="text-blue-600 font-semibold break-words">&rarr; {{ $new }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                            <td></td><td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($histories->hasPages())
        <div class="flex justify-center mt-6">
            <div class="flex items-center">
                {{-- Previous Page --}}
                <a href="{{ $histories->previousPageUrl() ?? '#' }}"
                class="w-full p-4 border text-base rounded-l-xl text-gray-600 bg-white hover:bg-gray-100 {{ $histories->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                    <svg width="9" fill="currentColor" height="8" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1427 301l-531 531 531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19l-742-742q-19-19-19-45t19-45l742-742q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z"></path>
                    </svg>
                </a>

                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $histories->lastPage(); $i++)
                    <a href="{{ $histories->url($i) }}"
                    class="w-full px-4 py-2 border-t border-b text-base {{ $histories->currentPage() == $i ? 'text-indigo-500 bg-white' : 'text-gray-600 bg-white hover:bg-gray-100' }}">
                        {{ $i }}
                    </a>
                @endfor

                {{-- Next Page --}}
                <a href="{{ $histories->nextPageUrl() ?? '#' }}"
                class="w-full p-4 border-t border-b border-r text-base rounded-r-xl text-gray-600 bg-white hover:bg-gray-100 {{ $histories->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                    <svg width="9" fill="currentColor" height="8" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z"></path>
                    </svg>
                </a>
            </div>
        </div>
        @endif
        @endif
    </div>
</div>
@endsection
