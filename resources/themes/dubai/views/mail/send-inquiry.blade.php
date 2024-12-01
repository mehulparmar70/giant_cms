
<style>
th,td{
    padding:10px 13px;
}

</style>
<h3>Hello Admin,</h3>

<p style="font-size: 15px;color: #862424;"><strong>{{$name}}</strong> has contacted Giant Inflatables, via the enquiry form, their details are as follows:</p style="
    font-size: 15px;color: #862424;"
>

<table style="margin-bottom:6px; text-align:left;font-size: 16px;border-collapse: collapse; width:700px;margin-top: 20px"
 bordercolor="silver" border=1>

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
        <th style="padding: 5px 10px;width: 30%;">Inflatable Requirement</th> 
        <td style="padding: 5px 10px;width: 70%;">{{$msg}}</td>
    </tr>
    <tr>
        <th style="padding: 5px 10px;width: 30%;">Inquiry from</th> 
        <td style="padding: 5px 10px;width: 70%;"><a target="_blank" href="{{$page_url}}">{{$page_url}}</a></td>
    </tr>
    
    <!-- <tr>
        <th style="padding: 5px 10px;width: 30%;">Inflatable Name</th>
        
        <td style="padding: 5px 10px;width: 70%;">{{$title}}</td>
    </tr>

    <tr>
        <th style="padding: 5px 10px;width: 30%;">Inflatable Page</th> 
        <td style="padding: 5px 10px;width: 70%;"><a target="_blank" href="{{$product_url}}">{{$product_url}}</a></td>
    </tr>
    
    <tr>
        <th style="padding: 5px 10px;width: 30%;">Inflatable Image</th> 
        <td style="padding: 5px 10px;width: 70%;"><img height="50" src="{{$image}}"></td>
    </tr>
     -->
</table>
<strong style="font-size: 14px;color: #656363;">Warm Regards,</strong><br>
<strong style="font-size: 14px;color: #656363;">Web Master</strong>


