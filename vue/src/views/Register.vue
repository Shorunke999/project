<template>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" @submit.prevent="register">
            <div>
                <label
                    for="fullname"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Full Name</label
                >
                <div class="mt-2">
                    <input
                        id="fullname"
                        name="fullname"
                        v-model="user.name"
                        type="text"
                        autocomplete="fullname"
                        required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                </div>
            </div>
            <div>
                <label
                    for="email"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Email address</label
                >
                <div class="mt-2">
                    <input
                        id="email"
                        name="email"
                        v-model="user.email"
                        type="email"
                        autocomplete="email"
                        required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label
                        for="password"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Password</label
                    >
                </div>
                <div class="mt-2">
                    <input
                        id="password"
                        name="password"
                        v-model="user.password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Password Confirmation
                    </label>
                </div>
                <div class="mt-2">
                    <input
                        id="password_confirmation"
                        v-model="user.password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="current-password_confirmation"
                        required
                        class="block w-full border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                </div>
            </div>
            <div>
                <button
                    type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Sign in
                </button>
            </div>
        </form>
        <div v-if="errorMessage" class="justify-center bg-red-500">
            {{ errorMessage }}
        </div>

        <p class="mt-10 text-center text-sm text-gray-500">
            Not a member?
            {{ " " }}
            <router-link
                :to="{ name: 'Login' }"
                class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
            >
                Login to your account
            </router-link>
        </p>
    </div>
</template>

<script>
import store from "../store/index";
import axiosClient from "../axios/axios";
export default {
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            errorMessage: null,
        };
    },
    methods: {
        register() {
            axiosClient
                .post("http://127.0.0.1:8000/api/register", this.user)
                .then((res) => {
                    console.log(res.token);
                    store.dispatch("authAction", res).then(() => {
                        this.$router.push({
                            name: "Dashboard",
                        });
                    });
                })
                .catch((e) => {
                    this.errorMessage = e.response.data.message;
                });
        },
    },
};
</script>
