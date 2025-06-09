<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  interview: Object,
})

function formatDate(dateString, showTime = true) {
    // Convert "YYYY-MM-DD HH:mm:ss" → "YYYY-MM-DDTHH:mm:ssZ"
    const isoUtcString = dateString.replace(' ', 'T') + 'Z';
    const date = new Date(isoUtcString); // now correctly treated as UTC

    const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        ...(showTime && { hour: '2-digit', minute: '2-digit' }),
    };

    return date.toLocaleString(undefined, options); // uses user's local time and locale
}

</script>

<template>
  <Head title="Interview Details" />
  <AppLayout>
    <div class="container mx-auto flex h-[70vh] overflow-hidden rounded-xl bg-white px-2 py-10 shadow dark:bg-gray-900">
      <!-- Timeline Card Style -->
      <div class="relative flex h-full flex-1 flex-col overflow-y-auto p-8">
        <div class="flex items-center justify-between mb-8">
          <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Interview Details</h1>
          <Link href="/interviews" class="text-gray-600 hover:text-gray-900 underline text-sm">Back</Link>
        </div>
        <div class="relative mb-8 flex flex-col overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-white md:flex-row dark:border-blue-900 dark:from-blue-950 dark:to-gray-900">
          <!-- Timeline & Date -->
          <div class="flex flex-col items-center justify-center border-r border-blue-100 bg-white px-8 py-10 md:w-1/3 dark:border-blue-800 dark:bg-gray-900">
            <div class="flex flex-col items-center">
              <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-600 text-white shadow">
                <!-- Calendar Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10m-9 4h6m-7 4h8a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <div class="text-center">
                <div class="mb-1 text-xs font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-200">Scheduled</div>
                <div class="text-lg font-bold text-gray-900 dark:text-gray-100">
                  {{ formatDate(interview.scheduled_at) }}
                </div>
                <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                  {{ interview.job_application?.company }}
                </div>
              </div>
            </div>
          </div>
          <!-- Details -->
          <div class="flex flex-1 flex-col p-8">
            <div class="mb-4 flex items-center gap-4">
              <h2 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">
                {{ interview.job_application?.position }}
                <span class="font-normal text-gray-400">@</span>
                {{ interview.job_application?.company }}
              </h2>
            </div>
            <div class="mb-4 grid grid-cols-1 gap-x-8 gap-y-2 text-sm text-gray-700 md:grid-cols-2 dark:text-gray-300">
              <div>
                <span class="font-semibold">Company:</span>
                <span>{{ interview.job_application?.company }}</span>
              </div>
              <div>
                <span class="font-semibold">Position:</span>
                <span>{{ interview.job_application?.position }}</span>
              </div>
              <div>
                <span class="font-semibold">Location:</span>
                <span>{{ interview.location }}</span>
              </div>
              <div>
                <span class="font-semibold">User:</span>
                <span>{{ interview.job_application?.user?.name || 'Unknown' }}</span>
              </div>
              <div>
                <span class="font-semibold">Scheduled At:</span>
                <span>{{ formatDate(interview.scheduled_at) }}</span>
              </div>
              <div>
                <span class="font-semibold">Reminder At:</span>
                <span>{{ formatDate(interview.remind_me,false) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>