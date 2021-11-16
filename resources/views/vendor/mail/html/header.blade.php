<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ public_path().'/img/logo/blackbox.png'}}" class="logo" alt="blackbox Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
