<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';
const props = defineProps({
  note: Object,
  applications: Array
})

const form = useForm({
  job_application_id: props.note.job_application_id,
  content: props.note.content
})

const submit = () => {
  form.put(`/notes/${props.note.id}`)
}
</script>

<template>
<AppLayout>
  <div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Edit Note</h1>
    <form @submit.prevent="submit" class="space-y-4" autocomplete="off">
      <div>
        <label class="block mb-1 font-medium" for="job_application_id">Job Application</label>
        <select
          id="job_application_id"
          v-model="form.job_application_id"
          class="w-full border rounded p-2"
          required
          :disabled="form.processing"
        >
          <option value="">Select...</option>
          <option v-for="app in applications" :value="app.id" :key="app.id">
            {{ app.position }} @ {{ app.company }}
          </option>
        </select>
        <div v-if="form.errors.job_application_id" class="text-red-600 text-sm">{{ form.errors.job_application_id }}</div>
      </div>

      <div>
        <label class="block mb-1 font-medium" for="content">Note</label>
        <textarea
          id="content"
          v-model="form.content"
          class="w-full border rounded p-2"
          rows="4"
          required
          :disabled="form.processing"
        ></textarea>
        <div v-if="form.errors.content" class="text-red-600 text-sm">{{ form.errors.content }}</div>
      </div>

      <div class="flex justify-between items-center">
        <Link href="/notes" class="text-gray-600 hover:underline">Cancel</Link>
        <button
          type="submit"
          class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-200 shadow-lg"
          :disabled="form.processing"
        >
          Update
        </button>
      </div>
    </form>
  </div>
</AppLayout>
</template>