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
    <div class=" py-10 px-4">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">Interview Details</h1>

      <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
        <p class="mb-4 text-sm text-gray-500">Scheduled At:</p>
        <p class="text-lg font-semibold mb-4">{{ new Date(interview.scheduled_at).toLocaleString() }}</p>

        <p class="mb-4 text-sm text-gray-500">Company:</p>
        <p class="text-md font-medium mb-4">{{ interview.job_application?.company }}</p>

        <p class="mb-4 text-sm text-gray-500">Position:</p>
        <p class="text-md font-medium mb-4">{{ interview.job_application?.position }}</p>

        <p class="mb-4 text-sm text-gray-500">Location:</p>
        <p class="text-md font-medium mb-4">📍 {{ interview.location }}</p>

        <p class="mb-4 text-sm text-gray-500">User:</p>
        <p class="text-md">{{ interview.job_application?.user?.name || 'Unknown' }}</p>
      </div>
    </div>
  </AppLayout>
</template>
