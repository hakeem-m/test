
<table id="{{ $id }}" class="{{ $class }} " width="100%">
    <colgroup>
        @for ($i = 0; $i < count($columns); $i++)
        <col class="con{{ $i }}" />
        @endfor
    </colgroup>
    <thead>
        <tr >
            <?php $class = ''; ?>
            @foreach($columns as $i => $c)
            <!--<?php
            switch ($c) {
                case "#":
                    //$class = 'all';
                    //break;
                case "WMJ Job#":
                case "Channel":
                    //$class = 'desktop';
                    //break;
                case "Date Created":
                case "Short URL":
                case "URL":
                    //$class = 'min-mobile-p';
                    //break;
                case "Campaign Name":
                case "Source":
                case "Medium":
                case "Campaign Content":
                case "Partner":
                case "Subject Line":
                    //$class = 'min-tablet';
                    //break;
                case "Long URL":
                case "Notes":
                    //$class = 'none';
                    //break;
                default :
                    $class = 'dummy';
            }
            ?>-->
            <th align="center" valign="middle" class="head{{ $i }} {{$class}}">{{ $c }}</th>
            @endforeach
        </tr>
    </thead>
    <tfoot>
        <tr>
            @foreach($columns as $i => $c)
                <th >{{$c}}</th>
            @endforeach
        </tr>
    </tfoot>
    <tbody>

        @foreach($data as $d)
        <tr>
            @foreach($d as $dd)
            <td class="abc">{{ $dd }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>

</table>

@if (!$noScript)
@include('datatable::javascript', array('id' => $id, 'options' => $options, 'callbacks' =>  $callbacks))
@endif