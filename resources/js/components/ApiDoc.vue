<template>
    <div class="flex flex-col md:mx-auto gap-2 w-full bg-neutral-200 rounded-lg hover:shadow-lg">
        <div class="max-w-xl mx-auto py-8">
            <div class="mb-8 border rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">User Registration</h2>
                <p><span class="font-semibold">Method:</span> POST</p>
                <p><span class="font-semibold">URL:</span> http://localhost:8989/api/register</p>
                <p class="font-semibold">Body:</p>
                <ul class="list-disc pl-6">
                    <li>firstname (text)</li>
                    <li>lastname (text)</li>
                    <li>email (text)</li>
                    <li>password (text)</li>
                    <li>password_confirmation (text)</li>
                </ul>
            </div>

            <div class="mb-8 border rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">Login</h2>
                <p><span class="font-semibold">Method:</span> POST</p>
                <p><span class="font-semibold">URL:</span> http://localhost:8989/api/login</p>
                <p class="font-semibold">Body:</p>
                <ul class="list-disc pl-6">
                    <li>email (text)</li>
                    <li>password (text)</li>
                </ul>
            </div>

            <div class="mb-8 border rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">Get Tasks</h2>
                <p><span class="font-semibold">Method:</span> GET</p>
                <p><span class="font-semibold">URL:</span> http://localhost:8989/api/tasks?page=2</p>
                <p class="font-semibold">Authentication:</p>
                <p>Bearer Token</p>
            </div>

            <div class="mb-8 border rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">Get Single Task</h2>
                <p><span class="font-semibold">Method:</span> GET</p>
                <p><span class="font-semibold">URL:</span> http://localhost:8989/api/tasks/{task_id}</p>
                <p class="font-semibold">Authentication:</p>
                <p>Bearer Token</p>
            </div>

            <div class="mb-8 border rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">Create Task</h2>
                <p><span class="font-semibold">Method:</span> POST</p>
                <p><span class="font-semibold">URL:</span> http://localhost:8989/api/tasks</p>
                <p class="font-semibold">Body:</p>
                <ul class="list-disc pl-6">
                    <li>title (text)</li>
                    <li>description (text)</li>
                    <li>due_date (date:d-m-Y)</li>
                    <li>status (text)</li>
                </ul>
                <p class="font-semibold">Authentication:</p>
                <p>Bearer Token</p>
            </div>

            <div class="mb-8 border rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">Update Task</h2>
                <p><span class="font-semibold">Method:</span> PATCH</p>
                <p><span class="font-semibold">URL:</span> http://localhost:8989/api/tasks/{task_id}</p>
                <p class="font-semibold">Body:</p>
                <ul class="list-disc pl-6">
                    <li>title (text)</li>
                    <li>description (text)</li>
                    <li>due_date (date:d-m-Y)</li>
                    <li>status (text)</li>
                </ul>
                <p class="font-semibold">Authentication:</p>
                <p>Bearer Token</p>
            </div>

            <div class="mb-8 border rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">Delete Task</h2>
                <p><span class="font-semibold">Method:</span> DELETE</p>
                <p><span class="font-semibold">URL:</span> http://localhost:8989/api/tasks/{task_id}</p>
                <p class="font-semibold">Authentication:</p>
                <p>Bearer Token</p>
            </div>
        </div>
    </div>
</template>
