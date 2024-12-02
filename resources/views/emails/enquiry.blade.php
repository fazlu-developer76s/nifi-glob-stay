<!-- resources/views/emails/contact_enquiry.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Enquiry</title>
</head>
<body>
    <h1>New Contact Form Enquiry</h1>
    <p>You have received a new enquiry from your website's contact form:</p>

    <table style="border-collapse: collapse; width: 100%;">
        <tr>
            <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Name:</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $req->name }}</td>
        </tr>
        <tr>
            <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Email:</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $req->email }}</td>
        </tr>
        <tr>
            <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Phone:</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $req->mobile_no }}</td>
        </tr>
        <tr>
            <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Message:</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $req->message }}</td>
        </tr>
    </table>

    <p>Please respond to this enquiry at your earliest convenience.</p>
</body>
</html>
