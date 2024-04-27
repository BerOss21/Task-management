<template>
    <div class="hero min-h-screen bg-base-200 md:col-span-4">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="">
                <h1 class="text-5xl font-bold">Login now!</h1>
            </div>
            <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form class="card-body" @submit.prevent="login">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text" >Email</span>
                        </label>
                        <input type="email" v-model="form.email" placeholder="email" class="input input-bordered"/>
                        <div class="text-red-600" v-if="errors.email">
                            {{ errors.email }}
                        </div>
                        <div class="text-red-600" v-else-if="form.invalid('email')">
                            {{ form.errors.email }}
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input v-model="form.password" type="password" placeholder="password" class="input input-bordered"/>
                        <div class="text-red-600" v-if="errors.password">
                            {{ errors.password }}
                        </div>
                        <div class="text-red-600" v-else-if="form.invalid('password')">
                            {{ form.errors.password }}
                        </div>
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref} from 'vue';
import { useRouter } from 'vue-router';

import { storeToRefs } from 'pinia';
import { useUserStore } from '../stores/user';

import useValidation from "../services/validation";

const {errors, validateLoginForm} = useValidation();

const userStore = useUserStore();

const { user }=storeToRefs(userStore);

const { updateUser } = userStore;

import { useForm } from 'laravel-precognition-vue';

const router=useRouter();

const form=useForm('post','/login',{
    email:null,
    password:null
})

const login=async()=>{
    if(validateLoginForm(form))
    {
        errors.value={};

        try {
            await axios.get('/sanctum/csrf-cookie');
            const response = await form.submit();
            localStorage.setItem('user',JSON.stringify(response.data));
            updateUser();
            router.push({name:'home'})
        } catch (error) {
            console.log('error',error);
        }
    }
    
}
</script>

