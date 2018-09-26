@foreach($wallet->items as $item)
    <tr>
        <td>{{$item->name}}</td>
        <td>{{$item->balance}} BTC</td>
        <td>
            {{$item->balance * isset(${mb_strtolower($wallet->symbol)}['last']) ? ${mb_strtolower($wallet->symbol)}['last'] : 0}} $
        </td>
        <td><a href="#">@lang('generic.manage')</a></td>
    </tr>
@endforeach
