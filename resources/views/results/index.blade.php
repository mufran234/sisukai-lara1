@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">My Results</h1>

    @if($results->isEmpty())
        <p class="text-gray-600">No attempts yet. Start a practice exam from your dashboard.</p>
    @else
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($byCert as $certId => $summary)
                <div class="bg-white p-5 rounded-lg shadow">
                    <h2 class="font-semibold text-lg mb-3">
                        {{ optional($summary['last']->certification)->name ?? 'Certification' }}
                    </h2>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">First attempt:</span> {{ $summary['first']->score }}% ({{ $summary['first']->created_at->format('Y-m-d') }})</p>
                        <p><span class="font-medium">Last attempt:</span> {{ $summary['last']->score }}% ({{ $summary['last']->created_at->format('Y-m-d') }})</p>
                        <p><span class="font-medium">Best score:</span> {{ $summary['best']->score }}%</p>
                    </div>
                    <a href="{{ route('certifications.show', optional($summary['last']->certification)->slug) }}"
                       class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                       Practice again
                    </a>
                </div>
            @endforeach
        </div>

        <h2 class="text-xl font-semibold mt-10 mb-3">All Attempts</h2>
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left p-3">Date</th>
                        <th class="text-left p-3">Certification</th>
                        <th class="text-left p-3">Score</th>
                        <th class="text-left p-3">Total</th>
                        <th class="text-left p-3">Time Taken</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $r)
                        <tr class="border-t">
                            <td class="p-3">{{ $r->created_at->format('Y-m-d H:i') }}</td>
                            <td class="p-3">{{ optional($r->certification)->name }}</td>
                            <td class="p-3">{{ $r->score }}%</td>
                            <td class="p-3">{{ $r->total }}</td>
                            <td class="p-3">{{ $r->time_taken ? $r->time_taken.' min' : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
