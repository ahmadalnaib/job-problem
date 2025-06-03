<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
  interview: Object,
})
</script>



<template>
  <Head title="Interview Details" />
  <AppLayout>
    <div class="container mx-auto py-10 px-4">
      <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Interview Details</h1>
        <Link href="/interviews" class="text-gray-600 hover:text-gray-900 underline text-sm">Back</Link>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white dark:bg-gray-900 shadow p-6">
        <div class="mb-6">
          <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2 flex items-center gap-2">
            {{ interview.job_application?.position }}
            <span class="text-gray-400 font-normal">@</span>
            {{ interview.job_application?.company }}
          </h2>
          <div class="flex flex-wrap gap-3 items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 dark:bg-gray-800 px-3 py-1 font-semibold text-xs text-gray-700 dark:text-gray-300">
              📅 {{ new Date(interview.remind_me).toLocaleString() }}
            </span>
            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 dark:bg-gray-800 px-3 py-1 font-semibold text-xs text-gray-700 dark:text-gray-300">
              📍 {{ interview.location }}
            </span>
          </div>
        </div>
        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-2">
          <li>
            <span class="font-semibold">Company:</span>
            {{ interview.job_application?.company }}
          </li>
          <li>
            <span class="font-semibold">Position:</span>
            {{ interview.job_application?.position }}
          </li>
          <li>
            <span class="font-semibold">Location:</span>
            {{ interview.location }}
          </li>
          <li>
            <span class="font-semibold">User:</span>
            {{ interview.job_application?.user?.name || 'Unknown' }}
          </li>
          <li>
            <span class="font-semibold">Scheduled At:</span>
            {{ new Date(interview.remind_me).toLocaleString() }}
          </li>
        </ul>
      </div>
    </div>
  </AppLayout>
</template>