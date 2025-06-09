<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  interview: Object,
})

function formatDate(dateString, showTime = true) {
    if (!dateString) return ''; // Prevents error if dateString is null/undefined
    const isoUtcString = dateString.replace(' ', 'T') + 'Z';
    const date = new Date(isoUtcString);
    const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        ...(showTime && { hour: '2-digit', minute: '2-digit' }),
    };
    return date.toLocaleString(undefined, options);
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
              <div class="flex items-center gap-2">
                <!-- Office Building Icon -->
                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 21V7a2 2 0 012-2h2a2 2 0 012 2v14m0-14h6a2 2 0 012 2v14m0-14h2a2 2 0 012 2v14M9 21V9a2 2 0 012-2h2a2 2 0 012 2v12" />
                </svg>
                <span class="font-semibold">Company:</span>
                <span>{{ interview.job_application?.company }}</span>
              </div>
              <div class="flex items-center gap-2">
                <!-- Briefcase Icon -->
                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 6V4a3 3 0 016 0v2m2 0a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V8a2 2 0 012-2h10z" />
                </svg>
                <span class="font-semibold">Position:</span>
                <span>{{ interview.job_application?.position }}</span>
              </div>
              <div class="flex items-center gap-2">
                <!-- Location Icon -->
                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                  <circle cx="12" cy="11" r="3" />
                </svg>
                <span class="font-semibold">Location:</span>
                <span>{{ interview.location }}</span>
              </div>
              <div class="flex items-center gap-2">
                <!-- User Icon -->
                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="font-semibold">User:</span>
                <span>{{ interview.job_application?.user?.name || 'Unknown' }}</span>
              </div>
              <div class="flex items-center gap-2">
                <!-- Calendar Icon -->
                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="font-semibold">Scheduled At:</span>
                <span>{{ formatDate(interview.scheduled_at) }}</span>
              </div>
              <div class="flex items-center gap-2">
                <!-- Bell/Reminder Icon -->
                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
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