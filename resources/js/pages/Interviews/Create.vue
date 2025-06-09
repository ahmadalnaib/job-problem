<template>
    <AppLayout>
        <Head title="Create Interview" />
        <div class="mt-10 rounded-lg bg-white p-6 shadow-md">
            <h1 class="mb-6 text-2xl font-bold text-gray-800">Schedule New Interview</h1>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="mb-2 block font-medium text-gray-700" for="job_application_id">Job Application</label>
                    <select
                        v-model="form.job_application_id"
                        id="job_application_id"
                        class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                        <option value="" disabled>Select a job application</option>
                        <option v-for="application in jobApplications" :key="application.id" :value="application.id">
                            {{ application.company }} - {{ application.position }}
                        </option>
                    </select>
                    <p v-if="form.errors.job_application_id" class="mt-1 text-sm text-red-600">{{ form.errors.job_application_id }}</p>
                </div>

                <div class="mb-4">
                    <label class="mb-2 block font-medium text-gray-700" for="scheduled_at">Interview date</label>
                    <input
                        v-model="form.scheduled_at"
                        id="scheduled_at"
                        type="datetime-local"
                        :min="minDateTime"
                        class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    />
                    <p v-if="form.errors.scheduled_at" class="mt-1 text-sm text-red-600">
                        {{ form.errors.scheduled_at }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="mb-2 block font-medium text-gray-700" for="remind_me">Remind me</label>
                    <input
                        v-model="form.remind_me"
                        id="remind_me"
                        type="date"
                        :min="minDate"
                        class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    />
                    <p v-if="form.errors.remind_me" class="mt-1 text-sm text-red-600">{{ form.errors.remind_me }}</p>
                </div>

                <div class="mb-6">
                    <label class="mb-2 block font-medium text-gray-700" for="location">Location</label>
                    <input
                        v-model="form.location"
                        id="location"
                        type="text"
                        class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter location"
                    />
                    <p v-if="form.errors.location" class="mt-1 text-sm text-red-600">{{ form.errors.location }}</p>
                </div>
                <div class="mb-6">
                    <label class="mb-2 block font-medium text-gray-700" for="meeting_link">Meeting Link</label>
                    <input
                        v-model="form.meeting_link"
                        id="meeting_link"
                        type="text"
                        class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter meeting link"
                    />
                    <p v-if="form.errors.meeting_link" class="mt-1 text-sm text-red-600">{{ form.errors.meeting_link }}</p>
                </div>

                <button type="submit" class="rounded bg-gray-900 px-6 py-2 text-white shadow-lg transition duration-200 hover:bg-gray-700">
                    Schedule Interview
                </button>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    jobApplications: Array,
});
const pad = (n) => (n < 10 ? '0' + n : n);
const now = new Date();
const minDate = `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())}`;

const form = useForm({
    job_application_id: '',
    remind_me: '',
    scheduled_at: '',
    location: '',
    meeting_link: '',
});

const submit = () => {
    form.post('/interviews');
};
</script>

<style >
/* Shared styles for date and datetime-local inputs */
input[type="datetime-local"],
input[type="date"] {
  position: relative;
}

/* Make the entire input field open the picker, and hide the icon */
input[type="datetime-local"]::-webkit-calendar-picker-indicator,
input[type="date"]::-webkit-calendar-picker-indicator {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}
</style>

