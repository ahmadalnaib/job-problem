<x-mail::message>
# Interview Reminder

This is a reminder for your upcoming interview.

- **Position:** {{ $interview->jobApplication->position }}
- **Company:** {{ $interview->jobApplication->company }}
- **Scheduled At:** {{ \Carbon\Carbon::parse($interview->scheduled_at)->format('Y-m-d H:i') }}
- **Location:** {{ $interview->location }}

<x-mail::button :url="url('/')">
Go to Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
