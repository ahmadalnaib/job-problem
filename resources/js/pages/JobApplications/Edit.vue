<template>
  <AppLayout>
    <div class="mt-10 p-6 bg-white shadow-md rounded-lg">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Job Application</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-2" for="company">Company</label>
          <input
            v-model="form.company"
            id="company"
            type="text"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Enter company name"
          />
          <p v-if="form.errors.company" class="text-red-600 text-sm mt-1">{{ form.errors.company }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-2" for="position">Position</label>
          <input
            v-model="form.position"
            id="position"
            type="text"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Enter position"
          />
          <p v-if="form.errors.position" class="text-red-600 text-sm mt-1">{{ form.errors.position }}</p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-2" for="applied_at">Applied At</label>
          <input
            v-model="form.applied_at"
            id="applied_at"
            type="date"
            :min="today"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <p v-if="form.errors.applied_at" class="text-red-600 text-sm mt-1">{{ form.errors.applied_at }}</p>
        </div>

        <div class="mb-6">
          <label class="block text-gray-700 font-medium mb-2" for="status">Status</label>
          <select
            v-model="form.status"
            id="status"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="pending">Pending</option>
            <option value="accepted">Accepted</option>
            <option value="rejected">Rejected</option>
          </select>
          <p v-if="form.errors.status" class="text-red-600 text-sm mt-1">{{ form.errors.status }}</p>
        </div>

        <button
          type="submit"
          class="bg-gray-900 text-white px-6 py-2 rounded hover:bg-gray-700 transition duration-200 shadow-lg"
        >
          Update
        </button>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
  jobApplication: Object,
})

const today = new Date().toISOString().split('T')[0]

const form = useForm({
  company: props.jobApplication.company,
  position: props.jobApplication.position,
  applied_at: props.jobApplication.applied_at,
  status: props.jobApplication.status,
})

const submit = () => {
  form.put(`/job-applications/${props.jobApplication.id}`)
}
</script>