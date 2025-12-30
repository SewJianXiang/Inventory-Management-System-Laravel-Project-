@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-6xl overflow-x-auto">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">
                @if(isset($product))
                    History for: <span class="text-blue-600">{{ $product->product_name }}</span>
                @else
                    <h1 class="font-semibold text-3xl"> Product Histories</h1>
                @endif
            </h1>
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-200">Back</a>
        </div>

        @if($histories->isEmpty())
            <div class="p-4 bg-white rounded-full shadow text-gray-600">
                No history records {{ isset($product) ? 'found for this product.' : 'found.' }}
            </div>
        @else
            <table class="min-w-full bg-white rounded border border-gray-200">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-3 text-left text-gray-600 font-medium">Date</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-medium">Action</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-medium">User</th>
                        @if(!isset($product))
                            <th class="px-6 py-3 text-left text-gray-600 font-medium">Product</th>
                        @endif
                        <th class="px-6 py-3 text-left text-gray-600 font-medium">Changes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4">
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
                            <td class="px-6 py-4">{{ $history->user_name ?? 'System' }}</td>
                            @if(!isset($product))
                                <td class="px-6 py-4">
                                    @if($history->product)
                                        <a href="{{ route('products.show', $history->product->id) }}" class="text-blue-600 hover:underline">
                                            {{ $history->product->product_name }}
                                        </a>
                                    @else
                                        —
                                    @endif
                                </td>
                            @endif
                            <td class="px-6 py-4">
                                <ul class="space-y-1">
                                    @if($history->action === 'created')
                                        @foreach($history->new_values as $field => $value)
                                            <li class="flex items-center gap-2">
                                                <span class="font-medium capitalize">{{ $field }}:</span>
                                                <span class="text-gray-700">{{ is_null($value) ? '—' : $value }}</span>
                                            </li>
                                        @endforeach
                                    @else
                                        @foreach($history->new_values as $field => $new)
                                            <li class="flex items-center gap-2">
                                                <span class="font-medium capitalize">{{ $field }}:</span>
                                                <span class="line-through text-gray-400">{{ $history->previous_values[$field] ?? '—' }}</span>
                                                <span class="text-blue-600 font-semibold">&rarr; {{ $new }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
