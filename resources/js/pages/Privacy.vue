<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Privacy Policy" />
    <div class="container mx-auto p-8 bg-white rounded-lg shadow-lg space-y-8">
        <Link :href="route('home')" aria-label="Back to Website" class="text-blue-500 hover:underline mb-4 inline-block">
            <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Website
        </Link>
        <h1 class="text-4xl font-extrabold mb-6 text-gray-800">Privacy Policy</h1>
        <div class="prose lg:prose-xl space-y-6">
            <h2>1. Introduction</h2>
            <p>Welcome to Humanhup.com. This Privacy Policy explains how we handle your information when you visit our website and use our services. By accessing or using humanhup.com, you agree to the terms of this Privacy Policy.</p>
            
            <h2>2. Information We Collect</h2>
            <p>We collect personal information that you provide to us when you register for an account, such as your name, email address, and password. We do not use any analytics services.</p>
            
            <h2>3. Security</h2>
            <p>We implement reasonable security measures to protect your information from unauthorized access, use, or disclosure. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.</p>
            
            <h2>4. Data Retention</h2>
            <p>We retain your personal information for as long as your account is active or as needed to provide you with our services.</p>
            
            
            <h2>5. Changes to This Privacy Policy</h2>
            <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on our website. Your continued use of our services after any changes constitutes your acceptance of the new Privacy Policy.</p>
            
            <h2>6. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us at <a href="mailto:info@humanhup.com" class="text-blue-500 hover:underline">info@humanhup.com</a>.</p>
        </div>
    </div>
</template>