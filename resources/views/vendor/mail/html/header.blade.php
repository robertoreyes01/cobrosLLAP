@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/logollap.png') }}" alt="LLAP" height="48">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>