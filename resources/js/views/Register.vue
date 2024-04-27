<template>
    <div class="hero min-h-screen bg-base-200 md:col-span-4">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Register now!</h1>
            </div>
            <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form class="card-body" @submit.prevent="register">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text" >First name</span>
                        </label>
                        <input type="firstname" v-model="form.firstname" placeholder="First name" class="input input-bordered"/>
                        <div class="text-red-600" v-if="errors.firstname">
                            {{ errors.firstname }}
                        </div>
                        <div class="text-red-600" v-else-if="form.invalid('firstname')">
                            {{ form.errors.firstname }}
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text" >Last name</span>
                        </label>
                        <input type="lastname" v-model="form.lastname" placeholder="Last name" class="input input-bordered"/>
                        <div class="text-red-600" v-if="errors.lastname">
                            {{ errors.lastname }}
                        </div>
                        <div class="text-red-600" v-else-if="form.invalid('lastname')">
                            {{ form.errors.lastname }}
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text" >Email</span>
                        </label>
                        <input type="email" v-model="form.email" placeholder="Email" class="input input-bordered"/>
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
                        <input v-model="form.password" type="password" placeholder="Password" class="input input-bordered"/>
                        <div class="text-red-600" v-if="errors.password">
                            {{ errors.password }}
                        </div>
                        <div class="text-red-600" v-else-if="form.invalid('password')">
                            {{ form.errors.password }}
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password confirmation</span>
                        </label>
                        <input v-model="form.password_confirmation" type="password" placeholder="Password confirmation"  class="input input-bordered"/>
                        <div class="text-red-600" v-if="errors.password_confirmation">
                            {{ errors.password_confirmation }}
                        </div>
                        <div class="text-red-600" v-else-if="form.invalid('password_confirmation')">
                            {{ form.errors.password_confirmation }}
                        </div>
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">register</button>
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

import { useForm } from 'laravel-precognition-vue';

import useValidation from "../services/validation";

const {errors, validateRegisterForm} = useValidation();

const userStore = useUserStore();

const { user }=storeToRefs(userStore);
const { updateUser }=userStore;

const router=useRouter();

const form=useForm('post','/register',{
    firstname:null,
    lastname:null,
    email:null,
    password:null,
    password_confirmation:null
})

const register=async()=>{
    console.log('errrrrrr',errors.value);

    if(validateRegisterForm(form))
    {
        errors.value={};

        try {
            await axios.get('/sanctum/csrf-cookie');
            const response = await form.submit();
            localStorage.setItem('user',JSON.stringify(response.data));
            updateUser();
            router.push({name:'home'});
        } catch (error) {
            console.log('error',error);
        }
    }
    
}
</script>

