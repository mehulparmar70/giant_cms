
<style>
th, td {
    padding: 10px 6px;
    text-align: left;
}
td{
    overflow-wrap: anywhere;
}
.enquiry_form, .sub_categories_padding2 {
    min-width: 310px;
    max-width: 310px;
}
.enquiry_form {
    border-radius: 6px;
    box-shadow: 0 0px 10px #e6e6e6;
}
.enquiry_form form {
    padding: 20px 4px;
    margin-left: 10px;
}
.enquiry_form input, .enquiry_form input:focus, .enquiry_form select, .enquiry_form textarea {
    border: 0;
    border-bottom: 1px solid #000;
    font-size: 14px;
    color: #000;
    font-weight: 400;
    outline: none;
    width: 100%;
    font-size: 12px;
    margin-bottom: 10px;
    appearance: none;
    padding-bottom: 5px;
    background: white;
}
body {
    background-color: #fff !important;
    font-family: sans-serif;
    min-width: 300px;
}
body, h1, h2, h3, table, td {
    font-family: sans-serif;
}
.enquiry_form .form-group {
    display: flex;
    align-items: start;
    margin-bottom: 10px;
}
.form_header {
    background: url(https://www.giantinflatables.in/sardar/images/send_enq_title_bg.png);
    background-position: center top;
    background-size: 100% 100%;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 5px 20px;
    color: #fff;
}

.form_header h2{
    font-family: sans-serif;
    font-size: 18px;
    margin: 5px;
}
</style>
<h3>Hello Admin,</h3>

<p style="font-size: 15px;color: #862424;"><strong>{{$name}}</strong> has contacted Giant Inflatables, via the enquiry form, their details are as follows:</p style="
    font-size: 15px;color: #862424;"
>

<table style="text-align:left;font-size: 16px;border-collapse: collapse; width:700px;margin-top: 20px"
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
    
    <tr>
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
    
</table>
<br><br>
<strong style="font-size: 14px;color: #656363;">Warm Regards,</strong><br>
<strong style="font-size: 14px;color: #656363;">Web Master</strong>




<div class="enquiry_form bg-white">
						<div class="form_header">
							<img src="{{url('sardar')}}/images/email_icon.png" class="img-fluid">
					
							<h2>Your Details:</h2>
						</div>	
						<form class="m-0 contact-submission" action="{{route('send-contact')}}" method="post">

						<table class="table">
							<tr>
								<th>Name</th>
								<td>{{$name}}</td>
							</tr>
							<tr>
								<th>Phone No</th>
								<td>{{$phone}}</td>
							</tr>
							<tr>
								<th>Email Id</th>
								<td>{{$email}}</td>
							</tr>
							<tr>
								<th>Country</th>
								<td>{{$country}}</td>
							</tr>
							<tr>
								<th>Requirement</th>
								<td>{{$msg}}</td>
							</tr>

							<tr>
								<th>Inquiry from</th>
								<td><a target="_blank" href="{{$page_url}}">{{$page_url}}</a></td>
							</tr>

                            
						</table>
                        
						</form>

					</div>		


