<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Terms of Service" />
    <div class="container mx-auto p-8 bg-white rounded-lg shadow-lg space-y-8">
        <Link :href="route('home')" class="text-blue-500 hover:underline mb-4 inline-block">
            <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Website
        </Link>
        <h1 class="text-4xl font-extrabold mb-6 text-gray-800">Terms of Service</h1>
        <div class="prose lg:prose-xl space-y-6">
            <h2>1. Introduction</h2>
            <p>Welcome to humanhup.com. These Terms of Service ("Terms") govern your use of our website and services. By accessing or using HumanHup.com, you agree to comply with and be bound by these Terms. If you do not agree to these Terms, please do not use our services.</p>
            
            <h2>2. Services</h2>
            <p>HumanHup is a job application and interview management platform available on Web, iOS, and Android. It helps users track applications, schedule interviews, and efficiently manage the entire job search process in one place.</p>
            
            <h2>3. User Responsibilities</h2>
            <ul>
                <li>You must be at least 12 years old to use our services.</li>
                <li>You are responsible for maintaining the confidentiality of your account and password.</li>
                <li>You agree not to use our services for any illegal or unauthorized purpose.</li>
                <li>You agree not to reproduce, duplicate, copy, sell, resell, or exploit any portion of our services without express written permission.</li>
            </ul>

            <h2>4. Intellectual Property</h2>
            <p>All content and materials provided by HumanHup.com are protected by intellectual property laws. You may not use, copy, or distribute any content from our services without our express written permission.</p>
            
            <h2>5. Termination</h2>
            <p>We reserve the right to terminate or suspend your account at our sole discretion, without notice, for conduct that we believe violates these Terms or is harmful to other users of our services.</p>
            
            <h2>6. Limitation of Liability</h2>
            <p>HumanHup.com is provided on an "as is" and "as available" basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties. In no event shall HumanHup.com be liable for any damages arising out of the use or inability to use our services.</p>
            
            <h2>7. Changes to Terms</h2>
            <p>We reserve the right to modify these Terms at any time. We will notify you of any changes by posting the new Terms on our website. Your continued use of our services after any changes constitutes your acceptance of the new Terms.</p>
            
            <h2>8. Contact Information</h2>
            <p>If you have any questions about these Terms, please contact us at info@humanhup.com.</p>
        </div>
    </div>
</template>
