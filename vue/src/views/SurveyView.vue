<template>
    <div>
        <pageComponent>
            <template v-slot:header>
                <div class="flex items-center justify-center">
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ model.id ? model.title: 'create a survey' }}
                    </h1>
                </div>
            </template>
            <form @submit.prevent="saveSurvey">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div>
                            <label for="" class="block text-sm font-medium text-gray-700">Image</label>
                            <div class="mt-1 flex items-center">
                                <img :src="model.image" :alt="model.image" v-if="model.image" class="w-64 h-48 object-cover"/>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        </pageComponent>
    </div>
</template>
<script setup>
import pageComponent from '../components/pageComponent.vue';
import { ref } from 'vue';
import store from '../store';
import { useRoute } from 'vue-router';

const route = useRoute();
let model = ref({
    title:'',
    status:false,
    description:null,
    image: null,
    expire_date: null,
    question:[]
});
if(route.params.id ){
    model.value =store.state.surveys.find(
        (s)=>s.id === parseInt(route.params.id)
    )
}
</script>