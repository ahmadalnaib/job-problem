<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';
defineProps({
  note: Object
})
</script>

<template>
<AppLayout>
  <div class=" py-10 px-4">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold">Note Details</h1>
      <Link href="/notes" class="text-blue-600 hover:underline">← Back</Link>
    </div>

    <div class="rounded-xl bg-white p-6 shadow dark:bg-gray-900">
      <div class="mb-2 text-sm text-gray-500 dark:text-gray-400">
        Related to: <strong>{{ note.job_application?.position }}</strong>
        @ <strong>{{ note.job_application?.company }}</strong>
      </div>
      <p class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ note.content }}</p>
    </div>
  </div>
  </AppLayout>
</template>
