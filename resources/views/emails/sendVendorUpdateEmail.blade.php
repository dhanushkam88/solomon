<!DOCTYPE html>
<html>
<head>
    <title>My Tracker - Vendor Reply Email</title>
</head>
<body>

<center>
<h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
    This is a follow-up to your request #{{ $reference_number }}
</h2>
</center>

<p>Dear {{ $customerName }}</p>
<p>Please find our Vendor feedback below..</p>
<table>
    <tr>
        <td>Reference Number</td>
        <td>{{ $reference_number }}</td>
    </tr>
    <tr>
        <td>Invoice Number</td>
        <td>{{ $invoice_number }}</td>
    </tr>
    <tr>
        <td>Description</td>
        <td>{{ $description }}</td>
    </tr>
    <tr>
        <td>Vendor Reply</td>
        <td>{{ $reply }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>{{ $status }}</td>
    </tr>
</table>
<strong>Thank you<br> Team My Tarcker</strong>
</body>
</html>
