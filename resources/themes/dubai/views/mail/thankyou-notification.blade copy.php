
<h3>Hello {{$name}},</h3>
<p style="font-size: 15px;color: #862424;">Thank you for contacting us.Your contact details has been sent to admin.We will get back to you soon.
<table style="text-align:left;font-size: 16px;border-collapse: collapse; width:700px;margin-top: 20px"
 bordercolor="silver" border=1>

     <tr>
        <th style="padding: 5px 10px;width: 30%; background:whitesmoke; color:red;" colspan="2">Your Details:</th>
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
        <td style="padding: 5px 10px;width: 70%;"><a target="_blank" href="{{$page_url}}">{{$page_url}}</a></td>
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

</p style="
    font-size: 16px;color: #862424;"
>
<br>
<p><img src="https://www.giantinflatables.in/sardar/img/logo.png" width="213" height="84"></p><br>

<p><strong><span style="color: #e31212; font-size: 11pt">Mob No: </span>
<a href="tel:+91 9737101589" target="_blank" 
rel="noreferrer"><span style="font-size: 11pt; color: #000000">+91 9737101589</span></a></strong></p>

<p><strong><span style="color: #e31212; font-size: 11pt">Web: </span>
<a href="http://www.GiantInflatables.in" target="_blank" 
rel="noreferrer"><span style="font-size: 11pt; color: #000000">www.GiantInflatables.in</span></a></strong></p>

<p><strong><span style="color: #e31212; font-size: 11pt">Email: </span>
<a href="mailto:sales@giantinflatables.in" target="_blank" 
rel="noreferrer"><span style="font-size: 11pt; color: #000000">sales@GiantInflatables.in</span></a></strong></p>
<br>


<strong>Thanks,</strong><br>
<strong>Giant Inflatables Asia</strong>