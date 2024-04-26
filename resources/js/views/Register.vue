<template>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Register now!</h1>
                <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
                    exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
            </div>
            <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form class="card-body" @submit.prevent="register">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text" >First name</span>
                        </label>
                        <input type="firstname" v-model="form.firstname" placeholder="First name" class="input input-bordered"/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text" >Last name</span>
                        </label>
                        <input type="lastname" v-model="form.lastname" placeholder="Last name" class="input input-bordered"/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text" >Email</span>
                        </label>
                        <input type="email" v-model="form.email" placeholder="Email" class="input input-bordered"/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input v-model="form.password" type="password" placeholder="Password" class="input input-bordered"/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password confirmation</span>
                        </label>
                        <input v-model="form.password_confirmation" type="Password confirmation" placeholder="password" class="input input-bordered"/>
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
import { reactive} from 'vue';
import { useRouter } from 'vue-router';

import { storeToRefs } from 'pinia';
import { useUserStore } from '../stores/user';

const userStore = useUserStore();

const { user }=storeToRefs(userStore);
const { updateUser }=userStore;

const router=useRouter();

const form=reactive({
    firstname:null,
    lastname:null,
    email:null,
    password:null,
    password_confirmation:null
})


const register=async()=>{
    try {
        await axios.get('/sanctum/csrf-cookie');
        const response = await axios.post('/register',form);
        localStorage.setItem('user',JSON.stringify(response.data))
        updateUser()
        router.push({name:'home'})
    } catch (error) {
        console.log('error',error);
    }
}
</script>

