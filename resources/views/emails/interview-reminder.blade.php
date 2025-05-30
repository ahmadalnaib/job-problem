<h1>Interview Reminder</h1>

<p>Hello,</p>
<p>This is a reminder for your upcoming interview:</p>

<ul>
    <li><strong>Position:</strong> {{ $interview->jobApplication->position }}</li>
    <li><strong>Company:</strong> {{ $interview->jobApplication->company }}</li>
<li><strong>Scheduled at:</strong> {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('Y-m-d H:i') }}</li>

    <li><strong>Location:</strong> {{ $interview->location }}</li>
</ul>

<p>We wish you the best of luck!</p>
