<!DOCTYPE html>
<html>
<head>
    <title>Interview Reminder</title>
</head>
<body>
<p>Dear {{ $interview->jobApplication->user->name }},</p>
<p>This is a reminder that you have an interview scheduled in {{ $timeFrame }}.</p>
<p><strong>Company:</strong> {{ $interview->jobApplication->company }}</p>
<p><strong>Position:</strong> {{ $interview->jobApplication->position }}</p>
<p><strong>Scheduled At:</strong> {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('F j, Y, g:i A') }}</p>
<p><strong>Location:</strong> {{ $interview->location }}</p>
<p>Best regards,<br>Your Application Tracker</p>


</body>
</html>
