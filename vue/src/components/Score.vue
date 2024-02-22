<template>
      <pageComponent>
        <div class=" items-center text-black justify-center mt-4 hover:bg-gray-500">
           Your test score is {{ score }}%  
        </div>
        <button @click="finish" class="mt-4 bg-green-500 hover:bg-gray-500 justify-center">Finish</button>
    </pageComponent>
</template>
<script>
import store from '../store';
export default {
  data(){
    return{
      score: this.$route.query.score  
    }
  },
  methods:{
    finish(){
      store.dispatch('signOut')
      .then(()=>{
        localStorage.setItem('answerArray',null);
        this.$router.push({
          name:'Login'
        });
      })
    }
  },
  mounted() {
  }
}
</script>