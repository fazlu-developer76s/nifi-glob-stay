<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Enquiry</title>
</head>
<body>
    <h1>New Career Enquiry</h1>
    <p>You have received a new career enquiry from your website's career form:</p>

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
            <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Position Applied For:</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $req['job_info']['title'] }}</td>
        </tr>
        <!-- New fields for job title, experience, and description -->
        <tr>
            <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Job Title:</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $req['job_info']['title'] }}</td>
        </tr>
        <tr>
            <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Experience:</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $req['job_info']['exp'] }}</td>
        </tr>
        <tr>
            <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Job Description:</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $req['job_info']['description'] }}</td>
        </tr>


    </table>

    <p>Please review this enquiry and respond at your earliest convenience.</p>
</body>
</html>
