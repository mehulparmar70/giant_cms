
<h3>Hello Admin,</h3>
<p style="font-size: 15px;color: #862424;">Invalid Form Entry Caught.

<table style="/* color: white; */text-align: left;font-size: 16px;border-collapse: collapse;width: 700px;margin-top: 20px;background: #e8acac;"
 bordercolor="red" border=2>

     <tr>
        <th style="padding: 5px 10px;width: 30%;background: #9c0000;color: white;" colspan="2">Alert: Form Error</th>
    </tr>
    <tr>
        <th style="padding: 5px 10px;width: 30%;">Name</th>
        <td style="padding: 5px 10px;width: 70%;">{{$name}}</td>
    </tr>
    <tr>
        <th style="padding: 5px 10px;width: 30%;">Phone</th> 
        <td style="padding: 5px 10px;width: 70%;">{{$phone}}</td>
    </tr>
    <tr>
        <th style="padding: 5px 10px;width: 30%;">Email</th> 
        <td style="padding: 5px 10px;width: 70%;">{{$email}}</td>
    </tr>
    <tr>
        <th style="padding: 5px 10px;width: 30%;">Country</th> 
        <td style="padding: 5px 10px;width: 70%;">{{$country}}</td>
    </tr>
    <tr>
        <th style="padding: 5px 10px;width: 30%;">Inflatables Requirement</th> 
        <td style="padding: 5px 10px;width: 70%;">{{$msg}}</td>
    </tr>
    <tr>
        <th style="padding: 5px 10px;width: 30%;">Inquiry from</th> 
        <td style="padding: 5px 10px;width: 70%;"><a target="_blank" href="{{$page_url}}">Page Link</a></td>
    </tr>
    @if(isset($title))
        <tr>
            <th style="padding: 5px 10px;width: 30%;">Inflatables Name</th>
            <td style="padding: 5px 10px;width: 70%;">{{$title}}</td>
        </tr>
    @endif

    @if(isset($product_url))
        <tr>
            <th style="padding: 5px 10px;width: 30%;">Inflatables Page</th> 
            <td style="padding: 5px 10px;width: 70%;"><a target="_blank" href="{{$product_url}}">Inflatables Link</a></td>
        </tr>
    @endif
    @if(isset($image))
        <tr>
            <th style="padding: 5px 10px;width: 30%;">Inflatables Image</th> 
            <td style="padding: 5px 10px;width: 70%;"><img height="50" src="{{$image}}"></td>
        </tr>
    @endif
</table>

<br><br>
<strong style="font-size: 14px;color: #656363;">Warm Regards,</strong><br>
<strong style="font-size: 14px;color: #656363;">Web Master</strong>


